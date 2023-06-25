<?php

namespace App\Providers;

use App\Models\Audio;
use App\Models\Room;
use App\Policies\AudioPolicy;
use App\Policies\RoomPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Room::class => RoomPolicy::class,
        Audio::class => AudioPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Gate definitions
        Gate::define('delete-project', function ($user, $campaign) {
            $role = $user->campaigns()->where('campaign.id', $campaign->id)->first()->pivot->role->name;
            return $role === 'Eigentümer';
        });

        Gate::define('edit-project', function ($user, $campaign) {
            $role = $user->campaigns()->where('campaign.id', $campaign->id)->first()->pivot->role->name;
            return $role === 'Eigentümer' || $role === 'Bearbeiter';
        });

        Gate::define('read-project', function ($user, $campaign) {
            $role = $user->campaigns()->where('campaign.id', $campaign->id)->first()->pivot->role->name;
            return $role === 'Eigentümer' || $role === 'Bearbeiter' || $role === 'Leser' || $role === 'Spieler';
        });

    }
}
