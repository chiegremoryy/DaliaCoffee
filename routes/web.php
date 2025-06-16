<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\OrderController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk Katalog Menu
Route::get('/katalog', [MenuController::class, 'index'])->name('katalog');

// Route untuk CRUD Menu
Route::prefix('menu')->name('menu.')->group(function () {
    Route::get('/', [MenuController::class, 'index'])->name('index');
    Route::get('/create', [MenuController::class, 'create'])->name('create');
    Route::get('/{menu}', [MenuController::class, 'show'])->name('show');
    Route::post('/', [MenuController::class, 'store'])->name('store');
    Route::get('/{menu}/edit', [MenuController::class, 'edit'])->name('edit');
    Route::put('/{menu}', [MenuController::class, 'update'])->name('update');
    Route::delete('/{menu}', [MenuController::class, 'destroy'])->name('destroy');
});

// Route untuk Admin Dashboard
Route::get('/karyawan', [AdminDashboardController::class, 'index'])->name('karyawan.index');
Route::get('/karyawan/create', [AdminDashboardController::class, 'create'])->name('karyawan.create');
Route::post('/karyawan', [AdminDashboardController::class, 'store'])->name('karyawan.store');
Route::get('/karyawan/{id}/edit', [AdminDashboardController::class, 'edit'])->name('karyawan.edit');
Route::put('/karyawan/{id}', [AdminDashboardController::class, 'update'])->name('karyawan.update');
Route::delete('/karyawan/{id}', [AdminDashboardController::class, 'destroy'])->name('karyawan.destroy');

// Route Stock
Route::get('/ingredients', [IngredientController::class, 'index'])->name('ingredients.index');
Route::get('/ingredients/create', [IngredientController::class, 'create'])->name('ingredients.create');
Route::post('/ingredients', [IngredientController::class, 'store'])->name('ingredients.store');
// Route Stock
Route::get('/stocks', [StockController::class, 'index'])->name('stocks.index');
Route::get('/stocks/create', [StockController::class, 'create'])->name('stocks.create');
Route::post('/stocks', [StockController::class, 'store'])->name('stocks.store');
Route::delete('/stocks/{stock}', [StockController::class, 'destroy'])->name('stocks.destroy');

Route::get('/stocks', [StockController::class, 'index'])->name('stocks.index');
Route::get('/ingredients', [IngredientController::class, 'index'])->name('ingredients.index');

// Route untuk Order
Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/orders/print/{order}', [OrderController::class, 'print'])->name('orders.print');
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

// Route Laporan Order
Route::get('/laporan', [OrderController::class, 'report'])->name('orders.report');
Route::get('/laporan/export/pdf', [OrderController::class, 'exportPDF'])->name('orders.export.pdf');

// Contoh: halaman dashboard setelah login
Route::get('/', function () {
    return view('welcome');
})->middleware('auth');
