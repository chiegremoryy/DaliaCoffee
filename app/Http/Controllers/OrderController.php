<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Menu;
use App\Models\ingredients;
use App\Models\stock_histories;
use App\Models\menu_ingredient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrderExport;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class OrderController extends Controller
{
    //
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
        return view('orders.print', compact('order'));
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
