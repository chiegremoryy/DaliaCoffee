<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;

Route::get('/', [MenuController::class, 'katalog'])->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Route untuk CRUD Menu
Route::prefix('menu')->name('menu.')->middleware('auth', 'role:owner')->group(function () {
    Route::get('/', [MenuController::class, 'index'])->name('index');
    Route::get('/create', [MenuController::class, 'create'])->name('create');
    Route::get('/{menu}', [MenuController::class, 'show'])->name('show');
    Route::post('/', [MenuController::class, 'store'])->name('store');
    Route::get('/{menu}/edit', [MenuController::class, 'edit'])->name('edit');
    Route::put('/{menu}', [MenuController::class, 'update'])->name('update');
    Route::delete('/{menu}', [MenuController::class, 'destroy'])->name('destroy');
});

// Route untuk Admin Dashboard
Route::get('/karyawan', [AdminDashboardController::class, 'index'])->name('karyawan.index')->middleware('auth', 'role:owner');
Route::get('/karyawan/create', [AdminDashboardController::class, 'create'])->name('karyawan.create')->middleware('auth', 'role:owner');
Route::post('/karyawan', [AdminDashboardController::class, 'store'])->name('karyawan.store')->middleware('auth', 'role:owner');
Route::get('/karyawan/{id}/edit', [AdminDashboardController::class, 'edit'])->name('karyawan.edit')->middleware('auth', 'role:owner');
Route::put('/karyawan/{id}', [AdminDashboardController::class, 'update'])->name('karyawan.update')->middleware('auth', 'role:owner');
Route::delete('/karyawan/{id}', [AdminDashboardController::class, 'destroy'])->name('karyawan.destroy')->middleware('auth', 'role:owner');

// Route Stock
Route::get('/ingredients', [IngredientController::class, 'index'])->name('ingredients.index')->middleware('auth', 'role:owner');
Route::get('/ingredients/create', [IngredientController::class, 'create'])->name('ingredients.create')->middleware('auth', 'role:owner');
Route::post('/ingredients', [IngredientController::class, 'store'])->name('ingredients.store')->middleware('auth', 'role:owner');
// Route Stock
Route::get('/stocks', [StockController::class, 'index'])->name('stocks.index')->middleware('auth', 'role:owner');
Route::get('/stocks/create', [StockController::class, 'create'])->name('stocks.create')->middleware('auth', 'role:owner');
Route::post('/stocks', [StockController::class, 'store'])->name('stocks.store')->middleware('auth', 'role:owner');
Route::delete('/stocks/{stock}', [StockController::class, 'destroy'])->name('stocks.destroy')->middleware('auth', 'role:owner');

// Route untuk Order
Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create')->middleware('auth', 'role:kasir');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store')->middleware('auth', 'role:kasir');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show')->middleware('auth', 'role:kasir');
Route::get('/orders/print/{order}', [OrderController::class, 'print'])->name('orders.print')->middleware('auth', 'role:kasir');
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index')->middleware('auth', 'role:kasir');

// Route Laporan Order
Route::get('/laporan', [OrderController::class, 'report'])->name('orders.report')->middleware('auth', 'role:kasir,owner');
Route::get('/laporan/export/pdf', [OrderController::class, 'exportPDF'])->name('orders.export.pdf')->middleware('auth', 'role:kasir,owner');

// Route Categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index')->middleware('auth', 'role:owner');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create')->middleware('auth', 'role:owner');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store')->middleware('auth', 'role:owner');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit')->middleware('auth', 'role:owner');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update')->middleware('auth', 'role:owner');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy')->middleware('auth', 'role:owner');
