<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\TransactionController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get("/", [BarangController::class, 'index'])->middleware('auth')->name('dashboard');

// Route Keranjang
Route::get('/keranjang', [KeranjangController::class, "index"])->name('keranjang');
Route::get('/keranjang-hapus', [KeranjangController::class, 'destroy'])->name('keranjang.delete');
Route::get('/keranjang/{id}', [KeranjangController::class, 'store'])->name('keranjang.store');

// Route Transaction
Route::get('/buat-pesanan', [KeranjangController::class, 'buat_pesanan'])->name('order.create');
Route::get('/transacrion', [TransactionController::class, 'index'])->name('transaction');

// Midtrans
Route::post('/generate-snap-token', [TransactionController::class, 'index'])->name('token.generate');

// Route Alert
Route::get("/success", function () {
    return view("alert-success");
})->name("alert.success");

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
