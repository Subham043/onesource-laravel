<?php

namespace App\Modules\AboutPage\Main\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\AboutPage\Main\Requests\MainRequest;
use App\Modules\AboutPage\Main\Services\MainService;

class AboutMainController extends Controller
{
    private $mainService;

    public function __construct(MainService $mainService)
    {
        $this->middleware('permission:edit about section content', ['only' => ['get','post']]);
        $this->mainService = $mainService;
    }

    public function get($slug){
        $data = $this->mainService->getBySlug($slug);
        return view('admin.pages.about.main', compact(['data', 'slug']));
    }

    public function post(MainRequest $request, $slug){
        try {
            //code...
            $main = $this->mainService->createOrUpdate(
                $request->except('image'),
                $slug
            );
            if($request->hasFile('image')){
                $this->mainService->saveImage($main);
            }
            if($request->hasFile('counter_image')){
                $this->mainService->saveCounterImage($main);
            }
            return response()->json(["message" => "About section updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
