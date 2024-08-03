<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\ProgramStudiController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\PenjadwalanController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PeminjamanKelasController;
use App\Http\Controllers\TelegramWebhookController;
use App\Models\PeminjamanKelas;
use Faker\Guesser\Name;
use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Http\Controllers\NotificationController;
use App\Models\MataKuliah;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\TahunAkademikController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::get('/registrasi', [AuthController::class, 'registrasi'])->name('registrasi');
Route::post('/registrasi', [AuthController::class, 'saveregistrasi'])->name('registrasi');

Route::get('/setwebhook', [TelegramWebhookController::class,'setWebHook']);



Route::post('/validate-user', [AuthController::class, 'validateUser'])->name('check-user');
Route::get('/log-out', [AuthController::class, 'logout'])->name('logout');
Route::get('/data-prodi', [ProgramStudiController::class, 'index'])->name('data.prodi');
Route::middleware(['islogin'])->group(function () {
    
    Route::get('/kelas-kosong', [KelasController::class, 'getKelasKosong'])->name('kelas-kosong');
    Route::get('/dashboard', [AuthController::class, 'home'])->name('home');

    Route::resource('/semester', SemesterController::class, ['as' => 'master', 'except' => ['create', 'edit']]);
    Route::resource('/prodi', ProgramStudiController::class, ['as' => 'master', 'except' => ['create', 'edit']]);
    Route::resource('/matakuliah', MataKuliahController::class, ['as' => 'master', 'except' => ['create', 'edit']]);
    Route::resource('/kelas', KelasController::class, ['as' => 'master', 'except' => ['create', 'edit']]);
    Route::resource('/dosen', DosenController::class, ['as' => 'master', 'except' => ['create', 'edit']]);
    Route::resource('/mahasiswa', MahasiswaController::class, ['as' => 'master', 'except' => ['create', 'edit']]);
    Route::resource('/penjadwalan', PenjadwalanController::class, ['as' => 'trx', 'except' => ['create', 'edit']]);
    Route::resource('/pengguna', PenggunaController::class, ['as' => 'user', 'except' => ['create', 'edit']]);
    Route::resource('/peminjaman', PeminjamanKelasController::class, ['as' => 'trx', 'except' => ['create', 'edit']]);
    Route::resource('/tahunakademik', TahunAkademikController::class, ['as' => 'master', 'except' => ['create', 'edit']]);
    Route::get('/peminjaman/create/new', [PeminjamanKelasController::class, 'create'])->name('trx.peminjaman.new');
    Route::get('/peminjaman/create/{peminjaman}', [PeminjamanKelasController::class, 'create'])->name('trx.peminjaman.create');
    Route::get('/pengguna/{id}/{type}/delete', [PenggunaController::class, 'deleteUser'])->name('user.pengguna.deactive');
    Route::get('/pengguna/{id}/{type}', [PenggunaController::class, 'createUser'])->name('user.pengguna.create');
    Route::get('/kelas/{group}/grouped', [KelasController::class, 'getRuanganGrouped'])->name('master.kelas.getgrouped');
    Route::get('/matakuliah/{group}/grouped', [MataKuliahController::class, 'getGrouped'])->name('master.matakuliah.getgrouped');

    Route::resource('/notif', NotificationController::class, ['except' => ['create', 'edit']]);

    Route::get('/card-data', [StatistikController::class, 'carddata'])->name('statistik.card');

    Route::get('/telegram/getme', function (Request $request) {
        $response = Telegram::bot('mybot')->getMe();
        return $response;
    });

    Route::get('/telegram/sendmessage', function (Request $request) {
        $telegram = new Telegram();
        $response = Telegram::bot('mybot')->sendMessage([
            'chat_id' => '6416627168',
            'text' => 'Hello World'
        ]);

        $messageId = $response->getMessageId();
    });

    Route::get('/telegram/getupdate', function (Request $request) {
        $response = Telegram::bot('mybot')->getUpdates();
        return $response;
    });
});
