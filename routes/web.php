<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeranjangController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get("/", [BarangController::class, 'index'])->middleware('auth')->name('dashboard');

// Route Keranjang
Route::get('/keranjang', [KeranjangController::class, "index"])->name('keranjang');
Route::get('/keranjang-hapus', [KeranjangController::class, 'destroy'])->name('keranjang.delete');
Route::get('/keranjang/{id}', [KeranjangController::class, 'store'])->name('keranjang.store');

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
