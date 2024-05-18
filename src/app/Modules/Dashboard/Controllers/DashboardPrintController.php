<?php

namespace App\Modules\Dashboard\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Services\EventService;

class DashboardPrintController extends Controller
{
    private $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function get(){
        if(auth()->user()->current_role=='Super Admin'){
            return redirect(route('customer.paginate.get'));
        }
        $events = $this->eventService->printAll();
        return view('print.print')->with([
            'print' => view('print.dashboard', compact(['events'])),
        ]);
    }
}