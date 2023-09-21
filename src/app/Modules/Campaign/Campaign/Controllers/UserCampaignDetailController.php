<?php

namespace App\Modules\Campaign\Campaign\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaign\Campaign\Resources\UserCampaignCollection;
use App\Modules\Campaign\Campaign\Services\CampaignService;

class UserCampaignDetailController extends Controller
{
    private $campaignService;

    public function __construct(CampaignService $campaignService)
    {
        $this->campaignService = $campaignService;
    }

    public function get($slug){
        $campaign = $this->campaignService->getBySlug($slug);
        return response()->json([
            'message' => "Campaign recieved successfully.",
            'campaign' => UserCampaignCollection::make($campaign),
        ], 200);
    }
}
