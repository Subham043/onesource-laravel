<?php

namespace App\Modules\Campaign\Enquiry\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaign\Enquiry\Services\EnquiryService;

class EnquiryDeleteController extends Controller
{
    private $enquiryService;

    public function __construct(EnquiryService $enquiryService)
    {
        $this->middleware('permission:delete campaigns', ['only' => ['get']]);
        $this->enquiryService = $enquiryService;
    }

    public function get($campaign_id, $id){
        $enquiry = $this->enquiryService->getByCampaignIdAndId($campaign_id, $id);

        try {
            //code...
            $this->enquiryService->delete(
                $enquiry
            );
            return redirect()->back()->with('success_status', 'Campaign Enquiry deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
