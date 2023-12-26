<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WebSocketChatNotif extends Notification implements ShouldQueue
{
    use Queueable;

    private $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function via(object $notifiable): array
    {
        // return ['mail','database'];
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'from_id' => $this->message['from_id'],
            'to_id' => $this->message['to_id'],
            'message' => $this->message['message'],
        ];
    }
}
