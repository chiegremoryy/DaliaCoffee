<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Menu;
use App\Models\stock_histories;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItems')->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $menus = Menu::where('status', 'active')->get();
        return view('orders.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:cash,qris',
            'items.*.menu_id' => 'required|exists:menus,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            $total = 0;
            $items = [];

            // Hitung total dan siapkan data item
            foreach ($request->items as $item) {
                $menu = Menu::with('menuIngredients.ingredient')->findOrFail($item['menu_id']);
                $subtotal = $menu->price * $item['quantity'];
                $total += $subtotal;

                $items[] = [
                    'menu' => $menu,
                    'quantity' => $item['quantity'],
                    'price' => $menu->price,
                    'subtotal' => $subtotal,
                ];
            }

            // Simpan Order
            $order = Order::create([
                'invoice_code' => 'INV-' . time(),
                'total_amount' => $total,
                'payment_method' => $request->payment_method,
                'order_date' => now(),
                'cashier_id' => 1, // sementara tanpa auth
            ]);

            // Simpan tiap item dan kurangi stok
            foreach ($items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $item['menu']->id,
                    'quantity' => $item['quantity'],
                    'price_per_item' => $item['price'],
                    'subtotal' => $item['subtotal'],
                ]);

                foreach ($item['menu']->menuIngredients as $mi) {
                    $ingredient = $mi->ingredient;
                    $totalUsed = $mi->quantity * $item['quantity'];

                    if ($ingredient->stock < $totalUsed) {
                        throw new \Exception("Stok tidak cukup untuk " . $ingredient->name);
                    }

                    $ingredient->stock -= $totalUsed;
                    $ingredient->save();

                    stock_histories::create([
                        'ingredient_id' => $ingredient->id,
                        'quantity' => $totalUsed,
                        'type' => 'out',
                        'description' => 'Digunakan untuk order ' . $order->invoice_code,
                    ]);
                }
            }

            DB::commit();

            // ✅ Redirect ke halaman print invoice
            return redirect()->route('orders.print', $order->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function show(Order $order)
    {
        $order->load('orderItems.menu'); // Eager load
        return view('orders.show', compact('order'));
    }

    public function print(Order $order)
    {
        $order->load('orderItems.menu');

        $qrBase64 = null;

        if ($order->payment_method === 'qris') {
            $payload = [
                "qrisCode" => "00020101021126760024ID.CO.SPEEDCASH.MERCHANT01189360081530001471020215ID10240014710270303UKE51440014ID.CO.QRIS.WWW0215ID10243551171010303UKE5204481653033605802ID5912NR CREATIONZ6008SEMARANG61055018962410509S244071850117202506172030177620703A016304354A",
                "nominal" => (string)$order->total_amount,
                "feeType" => "r",
                "fee" => "0",
                "includeFee" => false
            ];

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://qris-statis-to-dinamis.vercel.app/generate-qris',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => json_encode($payload),
                CURLOPT_HTTPHEADER => [
                    'User-Agent: Laravel',
                    'Content-Type: application/json',
                ],
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);
            curl_close($curl);

            if (!$error) {
                $data = json_decode($response, true);
                $qrBase64 = $data['qrCode'] ?? null;
            }
        }

        return view('orders.print', compact('order', 'qrBase64'));
    }

    public function report(Request $request)
    {
        // Ambil tanggal dari request atau pakai default
        $start = $request->start_date ?? now()->startOfMonth()->toDateString();
        $end = $request->end_date ?? now()->toDateString();

        // Ambil data order beserta relasi menu dari order items
        $orders = Order::with('orderItems.menu')
            ->whereBetween('order_date', [$start, $end])
            ->orderBy('order_date', 'desc')
            ->get();

        // Hitung total penjualan
        $total = $orders->sum('total_amount');

        return view('orders.report', compact('orders', 'start', 'end', 'total'));
    }

    public function exportPDF(Request $request)
    {
        $start = $request->start_date ?? now()->startOfMonth()->toDateString();
        $end = $request->end_date ?? now()->toDateString();

        $orders = Order::with('orderItems.menu')
            ->whereBetween('order_date', [$start, $end])
            ->get();

        $total = $orders->sum('total_amount');

        $pdf = PDF::loadView('orders.report_pdf', compact('orders', 'start', 'end', 'total'));
        return $pdf->download('laporan_penjualan.pdf');
    }
}
