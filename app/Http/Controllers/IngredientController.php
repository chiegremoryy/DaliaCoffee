<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ingredients;

class IngredientController extends Controller
{
    //
    public function index()
    {
        $ingredients = ingredients::all();
        return view('ingredients.index', compact('ingredients'));
    }

    public function create()
    {
        return view('ingredients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'unit' => 'required|string',
            'stock' => 'required|numeric|min:0',
        ]);

        ingredients::create([
            'name' => $request->name,
            'unit' => $request->unit,
            'stock' => $request->stock,
        ]);

        return redirect()->route('ingredients.index')->with('success', 'Bahan baku berhasil ditambahkan.');
    }
}
