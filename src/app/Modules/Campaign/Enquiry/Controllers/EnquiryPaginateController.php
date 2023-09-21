<?php

namespace App\Modules\Campaign\Enquiry\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaign\Enquiry\Services\EnquiryService;
use Illuminate\Http\Request;

class EnquiryPaginateController extends Controller
{
    private $enquiryService;

    public function __construct(EnquiryService $enquiryService)
    {
        $this->middleware('permission:list campaigns', ['only' => ['get']]);
        $this->enquiryService = $enquiryService;
    }

    public function get(Request $request, $campaign_id){
        $data = $this->enquiryService->paginate($request->total ?? 10, $campaign_id);
        return view('admin.pages.campaign.enquiry.paginate', compact(['data', 'campaign_id']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
