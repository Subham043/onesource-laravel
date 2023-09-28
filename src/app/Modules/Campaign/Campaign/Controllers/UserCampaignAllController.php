<?php

namespace App\Modules\Campaign\Campaign\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaign\Campaign\Resources\UserCampaignCollection;
use App\Modules\Campaign\Campaign\Services\CampaignService;

class UserCampaignAllController extends Controller
{
    private $campaignService;

    public function __construct(CampaignService $campaignService)
    {
        $this->campaignService = $campaignService;
    }

    public function get(){
        $campaign = $this->campaignService->all_main();
        return response()->json([
            'message' => "Campaign recieved successfully.",
            'campaigns' => UserCampaignCollection::collection($campaign),
        ], 200);
    }
}
