<?php

namespace App\Modules\Event\Speaker\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Speaker\Services\SpeakerService;
use Illuminate\Http\Request;

class SpeakerPaginateController extends Controller
{
    private $speakerService;

    public function __construct(SpeakerService $speakerService)
    {
        $this->middleware('permission:list events', ['only' => ['get']]);
        $this->speakerService = $speakerService;
    }

    public function get(Request $request){
        $data = $this->speakerService->paginate($request->total ?? 10);
        return view('admin.pages.event.speaker.paginate', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
