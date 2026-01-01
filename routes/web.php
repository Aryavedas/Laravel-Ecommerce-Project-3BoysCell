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
        Artisan::call('migrate', ['--force' => true]);
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

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

Route::get('/debug-storage', function () {
    // Path file yang Anda sebutkan
    $path = 'products/01KDX5FBHJFN3HFYH56G20SG1C.jpg';
    $disk = 's3'; // Pastikan ini sesuai nama disk di config/filesystems.php

    try {
        // 1. Cek apakah Laravel bisa KONEK ke Supabase dan MENEMUKAN file
        $exists = Storage::disk($disk)->exists($path);

        // 2. Ambil URL yang digenerate oleh Laravel
        $url = Storage::disk($disk)->url($path);

        // 3. Cek Status HTTP dari URL tersebut (Apakah bisa dibuka browser?)
        $httpStatus = null;
        if ($url) {
            $response = Http::get($url);
            $httpStatus = $response->status();
        }

        return response()->json([
            '1_path_file' => $path,
            '2_file_ditemukan_di_storage' => $exists ? 'YA (Koneksi OK)' : 'TIDAK (Cek path/koneksi)',
            '3_url_yang_dihasilkan' => $url,
            '4_status_akses_url' => $httpStatus . ' ' . ($httpStatus == 200 ? '(Bisa Diakses)' : '(Gagal Diakses)'),
            '5_analisa_singkat' => match (true) {
                !$exists => 'Laravel tidak menemukan file di bucket. Cek folder upload atau nama bucket.',
                $httpStatus == 403 => 'File ada, tapi akses DITOLAK. Cek "Public Bucket" di Supabase atau Policy.',
                $httpStatus == 404 => 'File ada di storage, tapi URL salah (Not Found). Cek AWS_URL di .env.',
                $httpStatus == 200 => 'Semua normal. Seharusnya gambar muncul.',
                default => 'Error tidak diketahui.'
            }
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'error' => $e->getMessage(),
            'hint' => 'Cek konfigurasi credentials di .env anda'
        ]);
    }
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
