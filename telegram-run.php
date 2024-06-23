<?php

// Include autoload untuk mengakses class Artisan dan dependensi Laravel lainnya
require __DIR__.'/vendor/autoload.php';
use Illuminate\Contracts\Console\Kernel;

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();
// Panggil class Artisan dari Laravel
use Illuminate\Support\Facades\Artisan;

// Jalankan perintah Artisan (contoh: telegram:polling)
Artisan::call('telegram:polling');

// Ambil output dari perintah (opsional)
$output = Artisan::output();

// Tampilkan hasilnya (opsional)
echo "Output dari perintah telegram:polling:\n";
echo $output;