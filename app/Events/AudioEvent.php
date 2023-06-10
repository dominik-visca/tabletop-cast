<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AudioEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $action;
    public $slot;
    public $volume;

    public function __construct($action, $slot, $volume = 1)
    {
        $this->action = $action; // "play", "stop", or "volume"
        $this->slot = $slot;
        $this->volume = $volume;
    }

    public function broadcastOn()
    {
        return new PresenceChannel("audio");
    }

    public function broadcastAs()
    {
        return 'AudioEvent';
    }
}
