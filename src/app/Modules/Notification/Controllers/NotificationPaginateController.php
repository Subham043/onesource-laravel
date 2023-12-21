<?php

namespace App\Modules\Notification\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Document\Models\DocumentNotification;
use App\Modules\Notification\Services\NotificationService;
use Illuminate\Http\Request;

class NotificationPaginateController extends Controller
{
    private $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->middleware('permission:list events', ['only' => ['get','post']]);
        $this->notificationService = $notificationService;
    }

    public function get(Request $request){
        $data = $this->notificationService->paginate($request->total ?? 10);
        return view('notifications.list', compact(['data']))->with([
            'page_name' => 'Notification',
            'notifications' => DocumentNotification::filterByRoles()->latest()->limit(4)->get()
        ])
        ->with('search', $request->query('filter')['search'] ?? '');
    }

}
