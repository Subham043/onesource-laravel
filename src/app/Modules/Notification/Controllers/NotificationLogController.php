<?php

namespace App\Modules\Notification\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Document\Models\DocumentNotification;
use App\Modules\Notification\Services\NotificationLogService;
use Illuminate\Http\Request;

class NotificationLogController extends Controller
{
    private $notificationLogService;

    public function __construct(NotificationLogService $notificationLogService)
    {
        $this->middleware('permission:list notifications', ['only' => ['get','post']]);
        $this->notificationLogService = $notificationLogService;
    }

    public function get(Request $request){
        $data = $this->notificationLogService->paginate($request->total ?? 10);
        return view('notifications.log', compact(['data']))->with([
            'page_name' => 'Notification Setting',
            'notifications' => DocumentNotification::filterByRoles()->latest()->limit(4)->get()
        ])
        ->with('search', $request->query('filter')['search'] ?? '');
    }

}
