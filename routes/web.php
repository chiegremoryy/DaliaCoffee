<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminDashboardController;

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

// Contoh: halaman dashboard setelah login
Route::get('/', function () {
    return view('welcome');
})->middleware('auth');
