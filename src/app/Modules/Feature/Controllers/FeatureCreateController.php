<?php

namespace App\Modules\Feature\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Feature\Requests\FeatureCreateRequest;
use App\Modules\Feature\Services\FeatureService;

class FeatureCreateController extends Controller
{
    private $featureService;

    public function __construct(FeatureService $featureService)
    {
        $this->middleware('permission:create features', ['only' => ['get','post']]);
        $this->featureService = $featureService;
    }

    public function get($page){
        return view('admin.pages.feature.create', compact('page'));
    }

    public function post(FeatureCreateRequest $request, $page){

        try {
            //code...
            $feature = $this->featureService->create(
                $request->except('image'),
                $page
            );
            if($request->hasFile('image')){
                $this->featureService->saveImage($feature);
            }
            return response()->json(["message" => "Feature created successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
