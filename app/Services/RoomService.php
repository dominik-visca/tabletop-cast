<?php

namespace App\Services;

use App\Exceptions\RoomServiceException;
use App\Models\Room;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RoomService
{
    /**
     * @throws RoomServiceException
     */
    public function getAllRooms(): Collection
    {
        try {
            return Room::all();
        } catch (Exception $e) {
            Log::error('Failed to retrieve all rooms: ' . $e->getMessage());
            throw new RoomServiceException('Failed to retrieve rooms.', 0, $e);
        }
    }

    /**
     * @throws RoomServiceException
     */
    public function getRoomAudios(Room $room)
    {
        try {
            return $room->audios;
        } catch (Exception $e) {
            Log::error('Failed to retrieve room audios: ' . $e->getMessage());
            throw new RoomServiceException('Failed to retrieve room audios.', 0, $e);
        }
    }

    /**
     * @throws RoomServiceException
     */
    public function createRoom($validatedData): void
    {
        try {
            $slug = Str::slug($validatedData['name']);
            Room::create(array_merge($validatedData, ['slug' => $slug]));
        } catch (Exception $e) {
            Log::error('Room creation failed: ' . $e->getMessage());
            throw new RoomServiceException('Failed to create room.', 0, $e);
        }
    }

    /**
     * @throws RoomServiceException
     */
    public function getSortedRoomAudios(Room $room): array
    {
        try {
            $audios = [];
            foreach ($room->audios as $audio) {
                $audios[$audio->slot] = $audio;
            }
            ksort($audios); // Sorts the audios by the slot number
            return $audios;
        } catch (Exception $e) {
            Log::error('Failed to sort room audios: ' . $e->getMessage());
            throw new RoomServiceException('Failed to sort room audios.', 0, $e);
        }
    }

    /**
     * @throws RoomServiceException
     */
    public function updateRoom($validatedData, Room $room): void
    {
        try {
            $room->update($validatedData);
        } catch (Exception $e) {
            Log::error('Room update failed: ' . $e->getMessage());
            throw new RoomServiceException('Failed to update room.', 0, $e);
        }
    }

    /**
     * @throws RoomServiceException
     */
    public function deleteRoom(Room $room): void
    {
        try {
            // First delete audio files
            foreach ($room->audios as $audio) {
                Storage::disk('public')->delete($audio->file);
            }

            $room->delete();
        } catch (Exception $e) {
            Log::error('Room deletion failed: ' . $e->getMessage());
            throw new RoomServiceException('Failed to delete room.', 0, $e);
        }
    }
}
