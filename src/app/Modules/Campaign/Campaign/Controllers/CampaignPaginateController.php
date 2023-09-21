<?php

namespace App\Modules\Campaign\Campaign\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaign\Campaign\Services\CampaignService;
use Illuminate\Http\Request;

class CampaignPaginateController extends Controller
{
    private $campaignService;

    public function __construct(CampaignService $campaignService)
    {
        $this->middleware('permission:list campaigns', ['only' => ['get']]);
        $this->campaignService = $campaignService;
    }

    public function get(Request $request){
        $data = $this->campaignService->paginate($request->total ?? 10);
        return view('admin.pages.campaign.campaign.paginate', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
