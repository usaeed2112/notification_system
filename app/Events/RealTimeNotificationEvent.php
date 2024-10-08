<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RealTimeNotificationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message = '';
    public $sender = '';
    public $type;
    /**
     * Create a new event instance.
     */
    public function __construct($message, $sender, $type)
    {
        $this->message = $message;
        $this->sender = $sender;
        $this->type = $type;
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('testing'),
        ];
    }


    public function broadcastWith(): array
    {

        return ['message' => $this->message, 'sender' => $this->sender, 'type' => $this->type];
    }
}
