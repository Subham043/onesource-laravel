<?php

namespace App\Modules\ExpertTip\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\ExpertTip\Requests\ExpertTipUpdateRequest;
use App\Modules\ExpertTip\Services\ExpertTipService;

class ExpertTipUpdateController extends Controller
{
    private $expertTipService;

    public function __construct(ExpertTipService $expertTipService)
    {
        $this->middleware('permission:edit expert tips', ['only' => ['get','post']]);
        $this->expertTipService = $expertTipService;
    }

    public function get($id){
        $data = $this->expertTipService->getById($id);
        return view('admin.pages.expertTip.update', compact(['data']));
    }

    public function post(ExpertTipUpdateRequest $request, $id){
        $expertTip = $this->expertTipService->getById($id);
        try {
            //code...
            $this->expertTipService->update(
                $request->except(['image']),
                $expertTip
            );
            return response()->json(["message" => "ExpertTip updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
