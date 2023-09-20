<?php

namespace App\Modules\Enquiry\SubscriptionForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\SubscriptionForm\Requests\SubscriptionFormRequest;
use App\Modules\Enquiry\SubscriptionForm\Resources\SubscriptionFormCollection;
use App\Modules\Enquiry\SubscriptionForm\Services\SubscriptionFormService;

class SubscriptionFormCreateController extends Controller
{
    private $subscriptionFormService;

    public function __construct(SubscriptionFormService $subscriptionFormService)
    {
        $this->subscriptionFormService = $subscriptionFormService;
    }

    public function post(SubscriptionFormRequest $request){

        try {
            //code...
            $subscriptionForm = $this->subscriptionFormService->create(
                [
                    ...$request->validated(),
                ]
            );

            return response()->json([
                'message' => "Subscribed successfully.",
                'subscriptionForm' => SubscriptionFormCollection::make($subscriptionForm),
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Something went wrong. Please try again",
            ], 400);
        }

    }
}
