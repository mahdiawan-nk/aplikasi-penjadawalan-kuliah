<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Api;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramWebhookController extends Controller
{
    function setWebHook()
    {
        // Inisialisasi objek Api dengan menggunakan token bot dari konfigurasi
        // $telegram = new Api('7234163337:AAE6AInFJwzC9e97TmwvC6npPr65GZR8iw4');

        // Menjalankan perintah setWebhook untuk menghubungkan bot dengan URL webhook
        // $response = Telegram::setWebhook(['url' => 'https://0038-125-165-106-119.ngrok-free.app/api/7234163337:AAE6AInFJwzC9e97TmwvC6npPr65GZR8iw4/webhook']);
        $response = Telegram::removeWebhook();
        // Memeriksa jika webhook berhasil diatur atau tidak
        // dd($response);
        echo $response;
    }
    public function handle(Request $request)
    {

        $updates = Telegram::commandsHandler(true);
        $chat_id = $updates->getChat()->getId();
        $username = $updates->getChat()->getFirstName();

        if (strtolower($updates->getMessage()->getText() === '/start')) return Telegram::sendMessage([
            'chat_id' => $chat_id,
            'text' => 'Halo ' . $username
        ]);
        if (strtolower($updates->getMessage()->getText() === '/infouser')) return Telegram::sendMessage([
            'chat_id' => $chat_id,
            'text' => 'info ' . $username
        ]);
    }
}
