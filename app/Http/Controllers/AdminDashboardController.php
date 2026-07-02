<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        $totalRevenue = (float) Order::sum('total_amount');
        $totalOrders = Order::count();
        $totalKaryawan = User::where('role', 'kasir')->count();
        $totalMenus = Menu::count();

        // Calculate Revenue growth (Current month vs Last month)
        $lastMonthRevenue = (float) Order::whereMonth('order_date', '=', now()->subMonth()->month)
            ->whereYear('order_date', '=', now()->subMonth()->year)
            ->sum('total_amount');
        $thisMonthRevenue = (float) Order::whereMonth('order_date', '=', now()->month)
            ->whereYear('order_date', '=', now()->year)
            ->sum('total_amount');
        $revenueGrowth = 0;
        if ($lastMonthRevenue > 0) {
            $revenueGrowth = (($thisMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100;
        }

        // Daily Revenue Data (Last 10 days)
        $dailyRevenue = Order::selectRaw('order_date, SUM(total_amount) as total')
            ->where('order_date', '>=', now()->subDays(9)->toDateString())
            ->groupBy('order_date')
            ->orderBy('order_date', 'asc')
            ->get()
            ->pluck('total', 'order_date');

        $labels = [];
        $revenueData = [];
        for ($i = 9; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $labels[] = now()->subDays($i)->format('d M');
            $revenueData[] = (float) ($dailyRevenue[$date] ?? 0);
        }

        // Payment Method breakdown
        $paymentBreakdown = Order::selectRaw('payment_method, COUNT(*) as count')
            ->groupBy('payment_method')
            ->get()
            ->pluck('count', 'payment_method');

        $cashCount = $paymentBreakdown['cash'] ?? 0;
        $qrisCount = $paymentBreakdown['qris'] ?? 0;

        // Recent Orders
        $recentOrders = Order::with('cashier')->latest()->limit(5)->get();

        return view('dashboard', compact(
            'totalRevenue',
            'totalOrders',
            'totalKaryawan',
            'totalMenus',
            'revenueGrowth',
            'labels',
            'revenueData',
            'cashCount',
            'qrisCount',
            'recentOrders'
        ));
    }

    public function index()
    {
        $users = User::where('role', 'kasir')->get();
        return view('karyawan.index', compact('users'));
    }

    public function create()
    {
        return view('karyawan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'kasir',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('karyawan.index');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('karyawan.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('karyawan.index');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('karyawan.index');
    }
}
