<?php

namespace App\Modules\Event\Specification\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Specification\Requests\SpecificationRequest;
use App\Modules\Event\Specification\Services\SpecificationService;

class SpecificationUpdateController extends Controller
{
    private $specificationService;

    public function __construct(SpecificationService $specificationService)
    {
        $this->middleware('permission:edit events', ['only' => ['get','post']]);
        $this->specificationService = $specificationService;
    }

    public function get($event_id, $id){
        $data = $this->specificationService->getByEventIdAndId($event_id, $id);
        return view('admin.pages.event.specification.update', compact(['data', 'event_id']));
    }

    public function post(SpecificationRequest $request, $event_id, $id){
        $specification = $this->specificationService->getByEventIdAndId($event_id, $id);
        try {
            //code...
            $this->specificationService->update(
                $request->validated(),
                $specification
            );
            return response()->json(["message" => "Event Specification updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
