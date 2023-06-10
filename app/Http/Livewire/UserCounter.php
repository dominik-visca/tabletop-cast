<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Pusher\Pusher;

class UserCounter extends Component
{
    public $usersCount = 0;
    public $users = [];

    protected $listeners = ['refreshUserCount' => '$refresh'];

    public function mount()
    {
        $this->fetchUserCount();
    }

    public function fetchUserCount()
    {
        $pusher = new Pusher("app-key", "app-secret", "app-id", ["cluster" => "mt1", "scheme" => "http", "host" => "soketi", "port" => 6001]);
        $info = $pusher->getChannelInfo('presence-audio', ['info' => 'subscription_count']);

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
