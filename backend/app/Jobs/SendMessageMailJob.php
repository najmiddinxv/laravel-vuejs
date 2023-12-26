<?php

namespace App\Jobs;

use App\Mail\SendMessageMail;
use App\Models\User;
use App\Notifications\SendMessageEmailNotif;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class SendMessageMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    private $data;
    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Mail::to('bekdevz@gmail.com')->send(new SendMessageMail());
        $userSchema = User::limit(10)->get();
        Notification::send($userSchema, new SendMessageEmailNotif($this->data));
    }
}
