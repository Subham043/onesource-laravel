<?php

namespace App\Modules\Enquiry\ScholarForm\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\RateLimitService;
use App\Modules\Enquiry\ScholarForm\Requests\ScholarFormRequest;
use App\Modules\Enquiry\ScholarForm\Resources\ScholarFormCollection;
use App\Modules\Enquiry\ScholarForm\Services\ScholarFormService;

class ScholarFormCreateController extends Controller
{
    private $scholarFormService;

    public function __construct(ScholarFormService $scholarFormService)
    {
        $this->scholarFormService = $scholarFormService;
    }

    public function post(ScholarFormRequest $request){

        try {
            //code...
            $scholarForm = $this->scholarFormService->create(
                [
                    ...$request->validated(),
                ]
            );
            (new RateLimitService($request))->clearRateLimit();
            return response()->json([
                'message' => "Enquiry created successfully.",
                'scholarForm' => ScholarFormCollection::make($scholarForm),
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Something went wrong. Please try again",
            ], 400);
        }

    }
}
