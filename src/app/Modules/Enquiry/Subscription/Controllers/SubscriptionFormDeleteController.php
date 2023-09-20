<?php

namespace App\Modules\Enquiry\SubscriptionForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\SubscriptionForm\Services\SubscriptionFormService;

class SubscriptionFormDeleteController extends Controller
{
    private $subscriptionFormService;

    public function __construct(SubscriptionFormService $subscriptionFormService)
    {
        $this->middleware('permission:delete enquiries', ['only' => ['get']]);
        $this->subscriptionFormService = $subscriptionFormService;
    }

    public function get($id){
        $subscription = $this->subscriptionFormService->getById($id);

        try {
            //code...
            $this->subscriptionFormService->delete(
                $subscription
            );
            return redirect()->back()->with('success_status', 'Subscription Form deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
