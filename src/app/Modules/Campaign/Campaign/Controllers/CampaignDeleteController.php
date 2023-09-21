<?php

namespace App\Modules\Campaign\Campaign\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaign\Campaign\Services\CampaignService;

class CampaignDeleteController extends Controller
{
    private $campaignService;

    public function __construct(CampaignService $campaignService)
    {
        $this->middleware('permission:delete campaigns', ['only' => ['get']]);
        $this->campaignService = $campaignService;
    }

    public function get($id){
        $campaign = $this->campaignService->getById($id);

        try {
            //code...
            $this->campaignService->delete(
                $campaign
            );
            return redirect()->back()->with('success_status', 'Campaign deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
