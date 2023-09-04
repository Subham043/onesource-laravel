<?php

namespace App\Modules\Event\Speaker\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Speaker\Services\SpeakerService;

class SpeakerDeleteController extends Controller
{
    private $speakerService;

    public function __construct(SpeakerService $speakerService)
    {
        $this->middleware('permission:delete events', ['only' => ['get']]);
        $this->speakerService = $speakerService;
    }

    public function get($id){
        $speaker = $this->speakerService->getById($id);

        try {
            //code...
            $this->speakerService->delete(
                $speaker
            );
            return redirect()->back()->with('success_status', 'Speaker deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
