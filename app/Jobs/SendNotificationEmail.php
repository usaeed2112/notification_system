<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use App\Models\Notification;
use App\Models\User;

class SendNotificationEmail implements ShouldQueue
{
    use Queueable;


    protected $notification;
    protected $user;

    /**
     * Create a new job instance.
     */
    public function __construct(Notification $notification, User $user)
    {
        $this->notification = $notification;
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::html("
        <h1>{$this->notification->type} Notification</h1>
        <p>{$this->notification->message}</p>
    ", function ($message) {
            $message->to($this->user->email)
                ->subject($this->notification->type);
        });

        $this->notification->status = 'sent';
        $this->notification->save();
    }
}
