<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\NotifEvent;
use Illuminate\Events\Dispatcher;

class NotifEventSubscriber
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handleNotifSent(NotifEvent $event)
    {
        // Logika penanganan event di sini
    }

    public function subscribe(Dispatcher $events)
    {
        $events->listen(
            NotifEvent::class,
            NotifEventSubscriber::class . '@handleMessageSent'
        );
    }

}
