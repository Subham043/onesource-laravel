<?php

namespace App\Modules\Event\Specification\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Specification\Services\SpecificationService;

class SpecificationDeleteController extends Controller
{
    private $specificationService;

    public function __construct(SpecificationService $specificationService)
    {
        $this->middleware('permission:delete events', ['only' => ['get']]);
        $this->specificationService = $specificationService;
    }

    public function get($event_id, $id){
        $specification = $this->specificationService->getByEventIdAndId($event_id, $id);

        try {
            //code...
            $this->specificationService->delete(
                $specification
            );
            return redirect()->back()->with('success_status', 'Event Specification deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
