<?php

namespace App\Http\Controllers;

use App\Exceptions\CampaignServiceException;
use App\Http\Requests\Campaign\StoreRequest;
use App\Http\Requests\Campaign\UpdateRequest;
use App\Models\Campaign;
use App\Services\CampaignService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    protected CampaignService $campaignService;

    public function __construct(CampaignService $campaignService)
    {
        $this->campaignService = $campaignService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        try {
            $campaigns = $this->campaignService->getAllCampaignsWhereUserHasRoles($request);
            return view('campaigns.index', compact('campaigns'));
        } catch (CampaignServiceException $e) {
            return view('errors.custom', ['message' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        try {
            $this->campaignService->createCampaign($request);
            return redirect(route('campaigns.index'));
        } catch (CampaignServiceException $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Campaign $campaign): View
    {
        try {
            return view('campaigns.show', compact('campaign'));
        } catch (CampaignServiceException $e) {
            return view('errors.custom', ['message' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Campaign $campaign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Campaign $campaign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Campaign $campaign)
    {
        //
    }
}
