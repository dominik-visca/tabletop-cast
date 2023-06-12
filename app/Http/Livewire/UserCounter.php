<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Pusher\Pusher;

class UserCounter extends Component
{
    public $usersCount = 0;
    public $roomSlug;

    protected $listeners = ['refreshUserCount' => '$refresh'];

    public function mount($roomSlug)
    {
        $this->roomSlug = $roomSlug;
        $this->fetchUserCount();
    }

    public function fetchUserCount()
    {
        $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), ["cluster" => env('PUSHER_APP_CLUSTER'), "scheme" => env('PUSHER_SCHEME'), "host" => env('PUSHER_HOST'), "port" => env('PUSHER_PORT')]);
        $info = $pusher->getChannelInfo('presence-audio.room.' . $this->roomSlug, ['info' => 'subscription_count']);

        $this->usersCount = $info->user_count;
    }

    public function userJoined()
    {
        $this->usersCount++;
    }

    public function userLeft()
    {
        $this->usersCount--;
    }

    public function render()
    {
        $this->fetchUserCount();
        return view('livewire.user-counter');
    }
}
