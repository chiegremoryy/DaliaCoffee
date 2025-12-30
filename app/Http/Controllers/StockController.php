<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\stock_histories;
use App\Models\ingredients;

class StockController extends Controller
{
    public function index()
    {
        // Riwayat stok dengan pagination
        $stocks = stock_histories::with('ingredient')->latest()->paginate(5);

        // Total stok dengan pagination juga
        $ingredients = ingredients::paginate(5);

        return view('stocks.index', compact('stocks', 'ingredients'));
    }

    public function create()
    {
        $ingredients = ingredients::all();
        return view('stocks.create', compact('ingredients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ingredient_id' => 'required|exists:ingredients,id',
            'quantity' => 'required|numeric|min:1',
            'type' => 'required|in:in,out',
            'description' => 'nullable|string',
        ]);

        $ingredient = ingredients::find($request->ingredient_id);

        if ($request->type === 'in') {
            $ingredient->stock += $request->quantity;
        } else {
            if ($ingredient->stock < $request->quantity) {
                return back()->withErrors(['quantity' => 'Stok tidak mencukupi untuk pengeluaran.']);
            }
            $ingredient->stock -= $request->quantity;
        }
        $ingredient->save();

        stock_histories::create($request->all());

        return redirect()->route('stocks.index')->with('success', 'Transaksi stok berhasil ditambahkan.');
    }

    public function destroy(stock_histories $stock)
    {
        // Rollback stok
        if ($stock->type === 'in') {
            $stock->ingredient->stock -= $stock->quantity;
        } else {
            $stock->ingredient->stock += $stock->quantity;
        }
        $stock->ingredient->save();

        $stock->delete();

        return back()->with('success', 'Histori stok berhasil dihapus.');
    }
}
