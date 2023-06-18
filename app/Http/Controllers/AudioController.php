<?php

namespace App\Http\Controllers;

use App\Http\Requests\Audio\StoreRequest;
use App\Http\Requests\Audio\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

use App\Models\Audio;
use App\Models\Room;
use App\Events\AudioEvent;

class AudioController extends Controller
{
    public function create(Room $room, int $slot): View
    {
        return view('audios.create', ['room' => $room, 'slot' => $slot]);
    }

    public function store(StoreRequest $request, Room $room): RedirectResponse
    {
        $audioPath = $request->file('file')->store('audios', 'public');

        $room->audios()->create(array_merge($request->validated(), ['file' => $audioPath]));

        return redirect()->route('rooms.edit', ['room' => $room]);
    }

    public function edit(Audio $audio): View
    {
        return view('audios.edit', ['audio' => $audio]);
    }

    public function update(UpdateRequest $request, Audio $audio): RedirectResponse
    {
        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($audio->file);
            $audioPath = $request->file('file')->store('audios', 'public');
        } else {
            $audioPath = $audio->file;
        }

        $audio->update(array_merge($request->validated(), ['file' => $audioPath]));

        return redirect()->route('rooms.edit', ['room' => $audio->room]);
    }

    public function audioAction(Request $request)
    {
        event(new AudioEvent($request->roomSlug, $request->action, $request->slot, $request->volume));
    }
}
