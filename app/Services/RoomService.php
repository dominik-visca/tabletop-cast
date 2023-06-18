<?php

namespace App\Services;

use App\Models\Room;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RoomService
{
    public function getAllRooms()
    {
        return Room::all();
    }

    public function getRoomAudios(Room $room)
    {
        return $room->audios;
    }

    public function createRoom($validatedData)
    {
        $slug = Str::slug($validatedData['name']);
        Room::create(array_merge($validatedData, ['slug' => $slug]));
    }

    public function getSortedRoomAudios(Room $room)
    {
        $audios = [];
        foreach ($room->audios as $audio) {
            $audios[$audio->slot] = $audio;
        }
        ksort($audios); // Sorts the audios by the slot number
        return $audios;
    }

    public function updateRoom($validatedData, Room $room)
    {
        $room->update($validatedData);
    }

    public function deleteRoom(Room $room)
    {
        // First delete audio files
        foreach ($room->audios as $audio) {
            Storage::disk('public')->delete($audio->file);
        }

        $room->delete();
    }
}
