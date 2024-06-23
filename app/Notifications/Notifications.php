<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Notifications extends Notification
{
    use Queueable;

    protected $sender_user_id;
    protected $receiver_user_id;

    /**
     * Create a new notification instance.
     *
     * @param int $sender_user_id
     * @param int $receiver_user_id
     * @return void
     */
    public function __construct(Notification $notification)
    {

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toDatabase($notifiable)
    // {
    //     return [
    //         'sender_user_id' => $this->sender_user_id,
    //         'receiver_user_id' => $this->receiver_user_id,
    //         'data' => 'Notification Data'
    //     ];
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title'=>$this->notification->title,
            'body'=>$this->notification->body
        ];
    }

    /**
     * Set the sender user ID for the notification.
     *
     * @param int $sender_user_id
     * @return $this
     */
    public function senderUserId($sender_user_id)
    {
        $this->sender_user_id = $sender_user_id;

        return $this;
    }

    /**
     * Set the receiver user ID for the notification.
     *
     * @param int $receiver_user_id
     * @return $this
     */
    public function receiverUserId($receiver_user_id)
    {
        $this->receiver_user_id = $receiver_user_id;

        return $this;
    }
}
