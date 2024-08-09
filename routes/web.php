<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ReportController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Middleware untuk mengarahkan pengguna ke dashboard berdasarkan peran
Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'cashier') {
            return redirect()->route('cashier.dashboard');
        }
    }
    return redirect('/login'); // jika tidak ada user yang login, redirect ke halaman login
})->middleware('auth');


// Route untuk administrator
Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth');
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
});

// Route untuk laporan penjualan
Route::resource('sales', SaleController::class)->middleware('auth');
Route::post('sales/apply-discount', [SaleController::class, 'applyDiscount'])->name('sales.applyDiscount');
Route::get('sales/receipt/{id}', [SaleController::class, 'receipt'])->name('sales.receipt');
Route::get('sales/history', [SaleController::class, 'history'])->name('sales.history');
Route::get('reports/sales', [ReportController::class, 'salesReport'])->name('reports.sales')->middleware('auth');
Route::get('reports/inventory', [ReportController::class, 'inventoryReport'])->name('reports.inventory');

// Route untuk kasir melihat daftar produk
Route::get('/cashier/products', [ProductController::class, 'show'])->name('cashier.products')->middleware('auth');

// Route untuk dashboard admin dan kasir
Route::get('/cashier/dashboard', [CashierController::class, 'dashboard'])->name('cashier.dashboard')->middleware('auth');

// Route untuk autentikasi
Auth::routes();
