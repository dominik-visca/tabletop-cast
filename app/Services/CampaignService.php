<?php

namespace App\Services;

use App\Exceptions\CampaignServiceException;
use App\Models\Campaign;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class CampaignService
{
    /**
     * @throws CampaignServiceException
     */
    public function getAllCampaignsWhereUserHasRoles($request): Collection
    {
        try {
            return $request->user()->campaigns;
        } catch (Exception $e) {
            Log::error('Failed to retrieve campaigns: ' . $e->getMessage());
            throw new CampaignServiceException('Failed to retrieve campaigns.', 0, $e);
        }
    }
}
