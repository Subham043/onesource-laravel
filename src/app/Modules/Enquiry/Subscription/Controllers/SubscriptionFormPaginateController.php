<?php

namespace App\Modules\Enquiry\SubscriptionForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\SubscriptionForm\Services\SubscriptionFormService;
use Illuminate\Http\Request;

class SubscriptionFormPaginateController extends Controller
{
    private $subscriptionFormService;

    public function __construct(SubscriptionFormService $subscriptionFormService)
    {
        $this->middleware('permission:list enquiries', ['only' => ['get']]);
        $this->subscriptionFormService = $subscriptionFormService;
    }

    public function get(Request $request){
        $data = $this->subscriptionFormService->paginate($request->total ?? 10);
        return view('admin.pages.enquiry.subscription_form', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
