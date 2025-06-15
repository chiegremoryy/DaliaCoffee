<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use App\Models\ingredients;
use App\Models\menu_ingredient;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Tampilkan semua menu untuk pembeli (katalog).
     */
    public function index(Request $request)
    {
        $menus = Menu::with('category', 'menuIngredients.ingredient')->get();
        // Jika rute yang dipanggil adalah 'katalog', tampilkan untuk pembeli
        if ($request->routeIs('katalog')) {
            return view('katalog', compact('menus'));
        }

        // Jika tidak, tampilkan view untuk admin
        return view('menu.index', compact('menus'));
    }

    /**
     * Form tambah menu baru.
     */
    public function create()
    {
        $categories = Category::all();
        $allIngredients =  ingredients::all();
        return view('menu.create', compact('categories', 'allIngredients'));
    }

    /**
     * Simpan menu baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'status' => 'required|in:active,inactive',
            'ingredients.*.ingredient_id' => 'required|exists:ingredients,id',
            'ingredients.*.quantity' => 'required|numeric|min:1',
        ]);

        // Simpan data menu (tanpa ingredients)
        $menu = Menu::create([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'status' => $request->status,
        ]);

        // Simpan data ingredients
        foreach ($request->ingredients as $ingredient) {
            menu_ingredient::create([
                'menu_id' => $menu->id,
                'ingredient_id' => $ingredient['ingredient_id'],
                'quantity' => $ingredient['quantity'],
            ]);
        }

        return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan.');
    }


    /**
     * Tampilkan detail 1 menu.
     */
    public function show(Menu $menu)
    {
        $menu->load('category', 'menuIngredients.ingredient');

        return view('menu.show', compact('menu'));
    }

    /**
     * Form edit menu.
     */
    public function edit(Menu $menu)
    {
        $categories = Category::all();
        $allIngredients = ingredients::all(); // Semua bahan tersedia
        $menuIngredients = $menu->menuIngredients()->with('ingredient')->get(); // Bahan yang sudah ditambahkan ke menu ini

        return view('menu.edit', compact('menu', 'categories', 'allIngredients', 'menuIngredients'));
    }

    /**
     * Update data menu.
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'status' => 'required|in:active,inactive',
            'ingredients.*.ingredient_id' => 'required|exists:ingredients,id',
            'ingredients.*.quantity' => 'required|numeric|min:1',
        ]);

        // Update data menu
        $menu->update([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'status' => $request->status,
        ]);

        // Hapus semua ingredients yang ada sebelumnya
        $menu->menuIngredients()->delete();

        // Simpan data ingredients baru
        foreach ($request->ingredients as $ingredient) {
            menu_ingredient::create([
                'menu_id' => $menu->id,
                'ingredient_id' => $ingredient['ingredient_id'],
                'quantity' => $ingredient['quantity'],
            ]);
        }

        return redirect()->route('menu.index')->with('success', 'Menu berhasil diupdate.');
    }

    /**
     * Hapus menu.
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus.');
    }
}
