<?php

namespace App\Modules\Event\Specification\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Event\Services\EventService;
use App\Modules\Event\Specification\Requests\SpecificationRequest;
use App\Modules\Event\Specification\Services\SpecificationService;

class SpecificationCreateController extends Controller
{
    private $specificationService;
    private $eventService;

    public function __construct(SpecificationService $specificationService, EventService $eventService)
    {
        $this->middleware('permission:create events', ['only' => ['get','post']]);
        $this->specificationService = $specificationService;
        $this->eventService = $eventService;
    }

    public function get($event_id){
        $this->eventService->getById($event_id);
        return view('admin.pages.event.specification.create', compact(['event_id']));
    }

    public function post(SpecificationRequest $request, $event_id){

        try {
            //code...
            $eventSpecification = $this->specificationService->create(
                [
                    ...$request->validated(),
                    'event_id' => $event_id
                ]
            );
            return response()->json(["message" => "Event Specification created successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
