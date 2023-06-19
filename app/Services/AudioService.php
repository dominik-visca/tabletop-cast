<?php

namespace App\Services;

use App\Models\Audio;
use App\Models\Room;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Exceptions\AudioServiceException;

class AudioService
{
    /**
     * @throws AudioServiceException
     */
    public function createAudio(Request $request, Room $room): void
    {
        try {
            $audioPath = $request->file('file')->store('audios', 'public');
            $room->audios()->create(array_merge($request->validated(), ['file' => $audioPath]));
        }  catch (Exception $e) {
            Log::error('Failed to create audio: ' . $e->getMessage());
            throw new AudioServiceException('Audio creation failed: ' . $e->getMessage());
        }
    }

    /**
     * @throws AudioServiceException
     */
    public function updateAudio(Request $request, Audio $audio): void
    {
        try {
            if ($request->hasFile('file')) {
                Storage::disk('public')->delete($audio->file);
                $audioPath = $request->file('file')->store('audios', 'public');
            } else {
                $audioPath = $audio->file;
            }

            $audio->update(array_merge($request->validated(), ['file' => $audioPath]));
        } catch (Exception $e) {
            Log::error('Failed to update audio: ' . $e->getMessage());
            throw new AudioServiceException('Audio update failed: ' . $e->getMessage());
        }
    }

    /**
     * @throws AudioServiceException
     */
    public function deleteAudio(Audio $audio): void
    {
        try {
            Storage::disk('public')->delete($audio->file);
            $audio->delete();
        } catch (Exception $e) {
            Log::error('Failed to delete audio: ' . $e->getMessage());
            throw new AudioServiceException('Audio deletion failed: ' . $e->getMessage());
        }
    }
}
