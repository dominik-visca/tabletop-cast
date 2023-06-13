<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

use App\Models\Audio;
use App\Models\Room;
use App\Events\AudioEvent;

class AudioController extends Controller
{
    // Show Audio Create Form
    public function create(Room $room, int $slot): View
    {
        return view('audios.create', ['room' => $room, 'slot' => $slot]);
    }

    // Save Audio to database
    public function store(Request $request, Room $room)
    {
        // Set checkboxes
        $request->merge([
            'loop' => $request->has('loop'),
            'pausable' => $request->has('pausable'),
            'music' => $request->has('music'),
            'ambience' => $request->has('ambience'),
        ]);

        $request->validate([
            'name' => 'required|max:255',
            'file' => 'required|file|mimetypes:audio/mpeg,audio/x-mpeg-3,audio/mpeg3,audio/mp3,mpga,mp3,wav,aac,audio/ogg,ogg,audio/mp4,audio/m4a|max:40960',
            'initial_volume' => 'required|numeric|between:0,1',
            'loop' => 'boolean',
            'pausable' => 'boolean',
            'music' => 'boolean',
            'ambience' => 'boolean',
            'slot' => 'required|integer|between:0,81'
        ]);

        $audioPath = $request->file('file')->store('audios', 'public');

        $audio = new Audio();
        $audio->room_id = $room->id;
        $audio->name = $request->name;
        $audio->file = $audioPath;
        $audio->initial_volume = $request->initial_volume;
        $audio->loop = $request->loop;
        $audio->pausable = $request->pausable;
        $audio->music = $request->music;
        $audio->ambience = $request->ambience;
        $audio->slot = $request->slot;
        $audio->save();

        return redirect()->route('rooms.edit', ['room' => $room]);
    }

    // Show edit Audio form
    public function edit(Audio $audio)
    {
        return view('audios.edit', ['audio' => $audio]);
    }

    // Update audio in database
    public function update(Request $request, Audio $audio)
    {
        // Set checkboxes
        $request->merge([
            'loop' => $request->has('loop'),
            'pausable' => $request->has('pausable'),
            'music' => $request->has('music'),
            'ambience' => $request->has('ambience'),
        ]);

        $request->validate([
            'name' => 'required|max:255',
            'file' => 'required|file|mimetypes:audio/mpeg,audio/x-mpeg-3,audio/mpeg3,audio/mp3,mpga,mp3,wav,aac,audio/ogg,ogg,audio/mp4,audio/m4a|max:40960',
            'initial_volume' => 'required|numeric|between:0,1',
            'loop' => 'boolean',
            'pausable' => 'boolean',
            'music' => 'boolean',
            'ambience' => 'boolean',
        ]);

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($audio->file);
            $audioPath = $request->file('file')->store('audios', 'public');
            $audio->file = $audioPath;
        }

        $audio->name = $request->name;
        $audio->initial_volume = $request->initial_volume;
        $audio->loop = $request->loop;
        $audio->pausable = $request->pausable;
        $audio->music = $request->music;
        $audio->ambience = $request->ambience;
        $audio->save();

        return redirect()->route('rooms.edit', ['room' => $audio->room]);
    }

    // Trigger Audio WebSocket Action
    public function audioAction(Request $request)
    {
        event(new AudioEvent($request->roomSlug, $request->action, $request->slot, $request->volume));
    }
}
