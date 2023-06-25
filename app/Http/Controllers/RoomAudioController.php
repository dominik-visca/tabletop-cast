<?php

namespace App\Http\Controllers;

use App\Exceptions\AudioServiceException;
use App\Http\Requests\Audio\StoreRequest;
use App\Models\Audio;
use App\Models\Room;
use App\Services\AudioService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RoomAudioController extends Controller
{
    protected AudioService $audioService;

    public function __construct(AudioService $audioService)
    {
        $this->audioService = $audioService;
        $this->authorizeResource(Audio::class, 'audio');
    }

    public function create(Room $room, int $slot): View
    {
        return view('audios.create', compact('room', 'slot'));
    }

    public function store(StoreRequest $request, Room $room): RedirectResponse
    {
        try {
            $this->audioService->createAudio($request, $room);
            return redirect()->route('rooms.edit', ['room' => $room]);
        } catch (AudioServiceException $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }
}
