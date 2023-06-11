<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use App\Models\Room;
use App\Models\Audio;

class RoomController extends Controller
{
    public function index(): View
    {
        return view("rooms.index", [
            "rooms" => Room::all()
        ]);
    }

    public function show(Room $room): View
    {
        $audios = $room->audios;

        return view('rooms.show', compact('room', 'audios'));
    }

    public function enter(Room $room)
    {
        return view('rooms.enter', ['room' => $room]);
    }

    public function authenticate(Request $request, Room $room)
    {
        if (!Hash::check($request->password, $room->password)) {
            return redirect()->route('rooms.enter', ['room' => $room])
                ->withErrors(['password' => 'Incorrect password']);
        }

        // Get the list of room IDs from the session, or initialize as an empty array
        $accessibleRooms = $request->session()->get('accessible_rooms', []);

        // Add the current room ID to the list
        $accessibleRooms[] = $room->id;

        // Store the updated list in the session
        $request->session()->put('accessible_rooms', $accessibleRooms);
        return redirect()->route('rooms.show', ['room' => $room]);
    }

    public function store(Request $request): RedirectResponse
    {
        $slug = Str::slug($request->name);

        $request->validate([
            "name" => "required|unique:rooms,slug,$slug",
            "password" => "required"
        ]);

        Room::create([
            "name" => $request->name,
            "slug" => $slug,
            "password" => Hash::make($request->password),
        ]);

        return redirect(route("rooms.index"));
    }

    public function edit(Room $room): View
    {
        $audios = [];
        foreach ($room->audios as $audio) {
            $audios[$audio->slot] = $audio;
        }
        ksort($audios); // Sorts the audios by the slot number
        return view('rooms.edit', ['room' => $room, 'audios' => $audios]);
    }

    public function update(Request $request, Room $room): RedirectResponse
    {
        $room->name = $request->input('name');
        $room->save();

        return redirect()->route('rooms.show', ['room' => $room]);
    }
}
