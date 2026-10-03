<?php
// Tempel blok ini ke dalam routes/web.php yang sudah ada
// (setelah Breeze di-install, supaya middleware 'auth' sudah terdaftar).

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Semua user yang sudah login boleh lihat & kelola produknya sendiri
Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class);
});

// Hanya admin yang boleh buka halaman /admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});

// Admin & editor boleh mengelola semua kategori
Route::middleware(['auth', 'role:admin,editor'])->group(function () {
    Route::resource('categories', \App\Http\Controllers\CategoryController::class)
        ->except(['show']);
});
