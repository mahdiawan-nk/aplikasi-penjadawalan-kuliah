<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Telegram\Bot\Api;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class TelegramPolling extends Command
{
    protected $signature = 'telegram:polling';
    protected $description = 'Start polling for Telegram bot updates';

    protected $telegram;

    public function __construct()
    {
        parent::__construct();
        $this->telegram = new Api('7234163337:AAE6AInFJwzC9e97TmwvC6npPr65GZR8iw4');
    }

    public function handle()
    {
        $lockKey = 'telegram_polling_lock';

        if (Cache::has($lockKey)) {
            $this->info('Another polling request is already running.');
            return;
        }

        Cache::put($lockKey, true, 60);
        $offset = 0;

        while (true) {
            $updates = $this->telegram->getUpdates(['offset' => $offset, 'timeout' => 30]);

            foreach ($updates as $update) {
                $message = $update->getMessage();
                $chatId = $message->getChat()->getId();
                $text = $message->getText();
                $textNext = explode('-', $text);
                if ($text === '/start') {
                    $this->telegram->sendMessage([
                        'chat_id' => $chatId,
                        'text' => 'Selamat datang di bot kami!' . PHP_EOL . 'silahkan ketikan nim anda di aplikasi penjadwalan kuliah di awali nim-nim_anda' . PHP_EOL . PHP_EOL . 'example nim-123456789'
                    ]);
                } else if ($text === '/daftar') {
                    $this->telegram->sendMessage([
                        'chat_id' => $chatId,
                        'text' => 'silahkan ketikan nim terdaftar di aplikasi penjadwalan kuliah di awali nim-nim_sudara' . PHP_EOL . PHP_EOL . 'example nim-12345678'
                    ]);
                } else if ($text === '/infouser') {
                    $data = User::where('id_telegram', $chatId);
                    if ($data->exists()) {
                        $message = '';
                        $inforUsers = DB::table('view_user_telegram')->where('nim', $data->first()->nidn_nim);
                        if($inforUsers->exists()){
                            $users = $inforUsers->first();
                            $message = "Data Mahasiswa:\n\n";
                            $message .= "Nama: " . $users->nama . "\n";
                            $message .= "Email: " . $users->email . "\n";
                            $message .= "NIM: " . $users->nim . "\n";
                            $message .= "Gender: " . $users->jenis_kelamin . "\n";
                            $message .= "Prodi: " . $users->nama_prodi . "\n";
                            $message .= "Semester: " . $users->semester . "\n";
                            $message .= "Jenjang: " . $users->jenjang_study . "\n";
                        }else{
                            $users = $data->first();
                            $message = "Info User:\n\n";
                            $message .= "Nama: " . $users->name . "\n";
                            $message .= "Email: " . $users->email . "\n";
                            $message .= "ID TELE: " . $users->id_telegram . "\n";
                        }
                        

                        $this->telegram->sendMessage([
                            'chat_id' => $chatId,
                            'text' => $message,
                            'parse_mode' => 'Markdown'
                        ]);
                    } else {
                        $this->telegram->sendMessage([
                            'chat_id' => $chatId,
                            'text' => 'Maaf Anda Belum Terdaftar Disistem Penjadwalan',
                            'parse_mode' => 'Markdown'
                        ]);
                    }
                } else if ($textNext[0] == 'nim') {
                    $this->telegram->sendMessage([
                        'chat_id' => $chatId,
                        'text' => 'Proses Pendaftaran sedang Berlangsung.......'
                    ]);

                    sleep(10); // Tambahkan delay 5 detik

                    $data = User::where('nidn_nim', $textNext[1]);

                    if ($data->exists()) {
                        User::where('nidn_nim', $textNext[1])->update(['id_telegram' => $chatId]);
                        $this->telegram->sendMessage([
                            'chat_id' => $chatId,
                            'text' => 'NIM anda adalah :' . $textNext[1] . ' Terima kasih, Telegram anda sudah terdaftar di sistem Kami'
                        ]);
                    } else {
                        $this->telegram->sendMessage([
                            'chat_id' => $chatId,
                            'text' => 'NIM anda adalah :' . $textNext[1] . ' NIM tidak terdaftar di sistem, silahkan coba lagi'
                        ]);
                    }
                } else {
                    $this->telegram->sendMessage([
                        'chat_id' => $chatId,
                        'text' => 'Comand tidak ditemukan'
                    ]);
                }

                $offset = $update->getUpdateId() + 1;
            }
        }
    }
}
