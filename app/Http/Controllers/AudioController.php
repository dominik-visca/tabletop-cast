<?php

namespace App\Http\Controllers;

use App\Http\Requests\Audio\StoreRequest;
use App\Http\Requests\Audio\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Models\Audio;
use App\Models\Room;
use App\Events\AudioEvent;
use App\Services\AudioService;
use App\Exceptions\AudioServiceException;

class AudioController extends Controller
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

    public function edit(Audio $audio): View
    {
        return view('audios.edit', compact('audio'));
    }

    public function update(UpdateRequest $request, Audio $audio): RedirectResponse
    {
        try {
            $this->audioService->updateAudio($request, $audio);
            return redirect()->route('rooms.edit', ['room' => $audio->room]);
        } catch (AudioServiceException $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request, Audio $audio): RedirectResponse
    {
        try {
            $this->audioService->deleteAudio($audio);
            return redirect()->route('rooms.edit', ['room' => $audio->room]);
        } catch (AudioServiceException $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function audioAction(Request $request)
    {
        event(new AudioEvent($request->roomSlug, $request->action, $request->slot, $request->volume));
    }
}
