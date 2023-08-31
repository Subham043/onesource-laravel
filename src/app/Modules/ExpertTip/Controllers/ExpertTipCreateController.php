<?php

namespace App\Modules\ExpertTip\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\ExpertTip\Requests\ExpertTipCreateRequest;
use App\Modules\ExpertTip\Services\ExpertTipService;

class ExpertTipCreateController extends Controller
{
    private $expertTipService;

    public function __construct(ExpertTipService $expertTipService)
    {
        $this->middleware('permission:create expert tips', ['only' => ['get','post']]);
        $this->expertTipService = $expertTipService;
    }

    public function get(){
        return view('admin.pages.expertTip.create');
    }

    public function post(ExpertTipCreateRequest $request){

        try {
            //code...
            $expertTip = $this->expertTipService->create(
                $request->except(['image'])
            );
            return response()->json(["message" => "ExpertTip created successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
