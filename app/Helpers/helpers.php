<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use App\Models\Notification as notif;
use Pusher\Pusher;

function encrypt($value)
{
    return Crypt::encryptString($value);
}

function decrypt($encryptedValue)
{
    return Crypt::decryptString($encryptedValue);
}

function infoUser($id = null)
{
    if ($id != null) {
        $uid = $id;
        $dataUser = User::where('id', $uid)->first();
    } else {
        $email = session('email');
        $dataUser = User::where('email', $email)->first();
    }

    return $dataUser;
}

function TelegramSend($idUSender, $idUReceiver, $role, $data = ['keterangan' => null, 'status_admin' => null, 'status_penggunaan' => null])
{
    // Token API Bot Telegram
    $tokenTelegram = '7234163337:AAE6AInFJwzC9e97TmwvC6npPr65GZR8iw4';

    // Dapatkan ID Telegram penerima
    $chatIdReceiver = infoUser($idUReceiver)->id_telegram;

    // Inisialisasi teks pesan
    $text = '';
    $title = '';
    $body = '';

    // Tentukan isi pesan berdasarkan peran dan status
    switch ($role) {
        case 4:
            $text .= '<b>Sistem Penjadwalan...</b>' . PHP_EOL;
            if ($data['status_admin'] == 1) {
                $text .= 'Konfirmasi Disetujui Pemakaian Ruangan' . PHP_EOL;
                $text .= 'Oleh: ' . infoUser($idUSender)->name . PHP_EOL;
                $text .= 'dengan Keterangan: Request Pemakaian disetujui, ruangan sudah bisa digunakan' . PHP_EOL;
                $title = 'Konfirmasi Disetujui';
                $body = 'Request Pemakaian disetujui, ruangan sudah bisa digunakan';
            } elseif ($data['status_admin'] == 2) {
                $text .= 'Konfirmasi Pemakaian Ruangan Ditolak' . PHP_EOL;
                $text .= 'Oleh: ' . infoUser($idUSender)->name . PHP_EOL;
                $text .= 'dengan Keterangan: Request Pemakaian ditolak' . PHP_EOL;
                $title = 'Konfirmasi Ditolak';
                $body = 'Request Pemakaian ditolak, ruangan tidak boleh digunakan';
            }
            break;

        default:
            $text .= 'Hii, <b>Operator Sistem Penjadwalan...</b>' . PHP_EOL;
            if ($data['status_penggunaan'] == 2) {
                $text .= 'Konfirmasi Selesai Pemakaian Ruangan' . PHP_EOL;
                $text .= 'Oleh: ' . infoUser($idUSender)->name . PHP_EOL;
                $text .= 'dengan Keterangan: Penggunaan Ruangan Kelas telah selesai digunakan' . PHP_EOL;
                $title = 'Konfirmasi Selesai';
                $body = 'Penggunaan Ruangan Kelas telah selesai digunakan oleh mahasiswa';
            } else {
                $text .= 'Request Pemakaian Ruangan telah dibuat' . PHP_EOL;
                $text .= 'Oleh: ' . infoUser($idUSender)->name . PHP_EOL;
                $text .= 'dengan Keterangan: ' . $data['keterangan'] . PHP_EOL;
                $title = 'Request Created';
                $body = 'Permintaan Konfirmasi penggunaan Ruangan telah dibuat oleh ' . infoUser($idUSender)->name;
            }
            break;
    }

    // Tambahkan catatan ke pesan
    $text .= 'NB: Pesan Dikirim Melalui Sistem Penjadwalan..';

    // Simpan notifikasi ke database
    $notif = new notif();
    $notif->id_user_sender = $idUSender;
    $notif->id_user_receiver = $idUReceiver;
    $notif->title = $title;
    $notif->body = $body;
    $notif->save();


    PusherEvent(['title' => $title, 'body' => $body], $idUReceiver);
    // Kirim pesan ke Telegram
    if ($chatIdReceiver != null || $chatIdReceiver != '' ) {
        // Siapkan data untuk permintaan cURL
        $data = [
            'chat_id' => urlencode($chatIdReceiver),
            'text' => $text,
            'parse_mode' => 'HTML',
        ];
        $url = "https://api.telegram.org/bot" . $tokenTelegram . "/sendMessage";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
    }


    return true;
}

function PusherEvent($message = ['title' => null, 'body' => null], $receiverUser=null)
{
    $pusher = new Pusher(
        "5485f0d7a988f8a9c610",
        "6d51f0df176fc26790b8",
        "1818988",
        array('cluster' => 'ap1')
    );
    $pusher->trigger('my-channel', 'my-event', array('message' => ['userId' => $receiverUser, 'title' => $message['title'], 'body' => $message['body']]));
}
