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
        Gate::define('delete-campaign', function ($user, $campaign) {
            $userCampaign = $user->campaigns()->where('campaign_id', $campaign->id)->first();

            if ($userCampaign) {
                $role = $userCampaign->role_name;
                return $role === 'Eigentümer';
            }

            return false;
        });

        Gate::define('edit-campaign', function ($user, $campaign) {
            $userCampaign = $user->campaigns()->where('campaign_id', $campaign->id)->first();

            if ($userCampaign) {
                $role = $userCampaign->role_name;
                return $role === 'Eigentümer' || $role === 'Bearbeiter';
            }

            return false;
        });

        Gate::define('read-campaign', function ($user, $campaign) {
            $userCampaign = $user->campaigns()->where('campaign_id', $campaign->id)->first();

            if ($userCampaign) {
                $role = $userCampaign->role_name;
                return $role === 'Eigentümer' || $role === 'Bearbeiter' || $role === 'Leser' || $role === 'Spieler';
            }

            return false;
        });

    }
}
