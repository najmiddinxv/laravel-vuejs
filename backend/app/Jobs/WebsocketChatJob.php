<?php

namespace App\Jobs;

use App\Models\Message;
use App\Notifications\SendMessageNotif;
use App\Notifications\WebSocketChatNotif;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification as FacadesNotification;

class WebsocketChatJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

     public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // print_r($this->data);
        Message::create([
            'from_id' => $this->data['from_id'],
            'to_id' => $this->data['to_id'],
            'message' => $this->data['message'],
        ]);

    }
}
