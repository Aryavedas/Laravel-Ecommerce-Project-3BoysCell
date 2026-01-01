<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';

// === TAMBAHKAN BAGIAN INI ===
// Vercel adalah lingkungan Read-Only.
// Kita harus memindahkan storage path ke /tmp (satu-satunya folder yang bisa ditulis).

$storagePath = '/tmp/storage';

// Cek apakah folder storage di /tmp sudah ada? Kalau belum, buat strukturnya.
if (!is_dir($storagePath)) {
    mkdir($storagePath, 0777, true);
    mkdir($storagePath . '/framework/views', 0777, true);
    mkdir($storagePath . '/framework/cache', 0777, true); // Ini untuk mengatasi error facade-...
    mkdir($storagePath . '/framework/sessions', 0777, true);
    mkdir($storagePath . '/app', 0777, true);
    mkdir($storagePath . '/logs', 0777, true);
}

// Perintahkan Laravel untuk menggunakan path baru ini sebagai 'storage'
$app->useStoragePath($storagePath);
// ============================

$request = Illuminate\Http\Request::capture();
$response = $app->handle($request);
$response->send();
$app->terminate();