<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = ["name", "description", "is_public"];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_campaign_role')
            ->withPivot('role_id');
    }
}
