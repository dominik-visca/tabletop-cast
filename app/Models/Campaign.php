<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected static function booted()
    {
        static::created(function ($campaign) {
            $ownerRoleId = Role::where('name', 'Eigentümer')->first()->id;
            $campaign->users()->attach(auth()->id(), ['role_id' => $ownerRoleId]);
        });
    }

    protected $fillable = ["name", "description", "is_public"];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_campaign_role')
            ->withPivot('role_id');
    }
}
