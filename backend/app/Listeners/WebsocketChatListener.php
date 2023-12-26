<?php

namespace App\Listeners;

use App\Jobs\WebsocketChatJob;
use App\Models\User;
use App\Notifications\WebSocketChatNotif;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class WebsocketChatListener
{

    public function __construct()
    {
        //
    }

    public function handle(object $event): void
    {
        dispatch(new WebsocketChatJob($event->messageData));
        Notification::send(User::find($event->messageData['to_id']), new WebSocketChatNotif($event->messageData));
    }
}
