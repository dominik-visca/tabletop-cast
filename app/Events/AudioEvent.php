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
    public $roomSlug;

    public function __construct($roomSlug, $action, $slot, $volume = 1)
    {
        $this->action = $action;
        $this->slot = $slot;
        $this->volume = $volume;
        $this->roomSlug = $roomSlug;
    }

    public function broadcastOn()
    {
        return new PresenceChannel("audio.room." . $this->roomSlug);
    }

    public function broadcastAs()
    {
        return 'AudioEvent';
    }
}
