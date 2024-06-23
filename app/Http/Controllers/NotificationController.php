<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

use function App\Helpers\infoUser;
use Carbon\Carbon;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = infoUser()->id;

        // Dapatkan notifikasi terbaru untuk user yang sedang login, limit 5, diurutkan dari yang terbaru
        $notifications = Notification::where('id_user_receiver', $userId)
            ->limit(5)
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($notification) {
                // Tambahkan atribut waktu relatif
                $notification->created_at_human = Carbon::parse($notification->created_at)->diffForHumans();
                return $notification;
            });

        // Hitung notifikasi yang belum dibaca
        $unreadCount = Notification::where('id_user_receiver', $userId)
            ->where('is_read', 0)
            ->count();

        // Buat respons JSON yang mencakup notifikasi dan penghitung notifikasi yang belum dibaca
        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $unreadCount,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        //
    }
}
