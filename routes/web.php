<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\MidtransController;
use Illuminate\Support\Facades\Artisan;

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
Route::post('/transaction-success', [TransactionController::class, 'payment_success_handler'])->name('payment.success');

// Midtrans
Route::post('/generate-snap-token', [MidtransController::class, 'generate_snap_token'])->name('token.generate');

// Route Alert
Route::get("/success", function () {
    return view("alert-success");
})->name("alert.success");

// Deploy App
Route::get('/install', function () {
    try {
        // 1. Jalankan Migrasi (Membuat Tabel)
        // force => true diperlukan karena env di vercel biasanya production
        Artisan::call('migrate:fresh', ['--force' => true]);
        $output = Artisan::output();

        // 2. Jalankan Seeder (Isi Data Awal / Admin)
        Artisan::call('db:seed', ['--force' => true]);
        $output .= "\n" . Artisan::output();

        // 4. (Opsional) Clear Cache agar konfigurasi fresh
        Artisan::call('config:clear');
        Artisan::call('cache:clear');

        return response()->make("<h1>Setup Berhasil!</h1><pre>$output</pre>", 200);
    } catch (\Exception $e) {
        return response()->make("<h1>Error!</h1><p>" . $e->getMessage() . "</p>", 500);
    }
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
