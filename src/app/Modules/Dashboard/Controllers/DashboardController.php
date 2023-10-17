<?php

namespace App\Modules\Dashboard\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Services\EventService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function get(Request $request){
        if(auth()->user()->current_role=='Super Admin'){
            return redirect(route('customer.paginate.get'));
        }
        $events = $this->eventService->paginate($request->total ?? 10);
        $current_month_events = $this->eventService->all(true);
        return view('dashboard', compact(['events', 'current_month_events']))->with([
            'page_name' => 'Dashboard'
        ]);
    }
}
