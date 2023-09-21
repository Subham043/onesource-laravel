<?php

namespace App\Modules\Enquiry\VrddhiForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\VrddhiForm\Requests\VrddhiFormRequest;
use App\Modules\Enquiry\VrddhiForm\Resources\VrddhiFormCollection;
use App\Modules\Enquiry\VrddhiForm\Services\VrddhiFormService;

class VrddhiFormCreateController extends Controller
{
    private $vrddhiFormService;

    public function __construct(VrddhiFormService $vrddhiFormService)
    {
        $this->vrddhiFormService = $vrddhiFormService;
    }

    public function post(VrddhiFormRequest $request){

        try {
            //code...
            $vrddhiForm = $this->vrddhiFormService->create(
                [
                    ...$request->except('card'),
                ]
            );
            if($request->hasFile('card')){
                $this->vrddhiFormService->saveImage($vrddhiForm);
            }

            return response()->json([
                'message' => "Vrddhi created successfully.",
                'vrddhiForm' => VrddhiFormCollection::make($vrddhiForm),
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Something went wrong. Please try again",
            ], 400);
        }

    }
}
