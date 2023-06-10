<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Audio;

class Room extends Model
{
    protected $fillable = ["name", "slug", "password"];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function audios()
    {
        return $this->hasMany(Audio::class);
    }
}
