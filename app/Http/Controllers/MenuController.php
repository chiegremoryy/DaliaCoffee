<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use App\Models\ingredients;
use App\Models\menu_ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Tampilkan katalog menu ke publik.
     */
    public function katalog()
    {
        $menus = Menu::where('status', 'active')->with('category')->get();
        return view('katalog', compact('menus'));
    }

    /**
     * Halaman utama daftar menu (admin).
     */
    public function index()
    {
        $menus = Menu::with('category', 'menuIngredients.ingredient')->get();
        $categories = Category::all();
        $allIngredients = ingredients::all();

        return view('menu.index', compact('menus', 'categories', 'allIngredients'));
    }

    /**
     * Tampilkan form tambah menu.
     */
    public function create()
    {
        $categories = Category::all();
        $allIngredients = ingredients::all();
        return view('menu.create', compact('categories', 'allIngredients'));
    }

    /**
     * Simpan menu baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'ingredients.*.ingredient_id' => 'required|exists:ingredients,id',
            'ingredients.*.quantity' => 'required|numeric|min:0.1',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('menu_images', 'public');
        }

        $menu = Menu::create($validated);

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
     * Tampilkan detail satu menu.
     */
    public function show(Menu $menu)
    {
        $menu->load('category', 'menuIngredients.ingredient');
        return view('menu.show', compact('menu'));
    }

    /**
     * Tampilkan form edit menu.
     */
    public function edit(Menu $menu)
    {
        $categories = Category::all();
        $allIngredients = ingredients::all();
        $menuIngredients = $menu->menuIngredients()->with('ingredient')->get();

        return view('menu.edit', compact('menu', 'categories', 'allIngredients', 'menuIngredients'));
    }

    /**
     * Perbarui menu.
     */
    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'ingredients.*.ingredient_id' => 'required|exists:ingredients,id',
            'ingredients.*.quantity' => 'required|numeric|min:0.1',
        ]);

        // Handle update image
        if ($request->hasFile('image')) {
            if ($menu->image && Storage::disk('public')->exists($menu->image)) {
                Storage::disk('public')->delete($menu->image);
            }
            $validated['image'] = $request->file('image')->store('menu_images', 'public');
        }

        $menu->update($validated);

        // Update ingredients
        $menu->menuIngredients()->delete();
        foreach ($request->ingredients as $ingredient) {
            menu_ingredient::create([
                'menu_id' => $menu->id,
                'ingredient_id' => $ingredient['ingredient_id'],
                'quantity' => $ingredient['quantity'],
            ]);
        }

        return redirect()->route('menu.index')->with('success', 'Menu berhasil diperbarui.');
    }

    /**
     * Hapus menu.
     */
    public function destroy(Menu $menu)
    {
        // Hapus gambar jika ada
        if ($menu->image && Storage::disk('public')->exists($menu->image)) {
            Storage::disk('public')->delete($menu->image);
        }

        $menu->menuIngredients()->delete();
        $menu->delete();

        return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus.');
    }
}
