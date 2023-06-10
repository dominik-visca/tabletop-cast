<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Room;

class Audio extends Model
{
    protected $fillable = ["room_id", "slot", "name", "file", "initial_volume", "loop", "pausable", "music", "ambience"];

    protected $table = "audios";

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
