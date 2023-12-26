<?php

namespace App\Modules\Notification\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Document\Models\DocumentNotification;
use App\Modules\Notification\Requests\NotificationRequest;
use App\Modules\Notification\Services\NotificationService;

class NotificationCreateController extends Controller
{
    private $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->middleware('permission:add notifications', ['only' => ['get','post']]);
        $this->notificationService = $notificationService;
    }

    public function get(){
        return view('notifications.add')->with([
            'page_name' => 'Notification Setting',
            'notifications' => DocumentNotification::filterByRoles()->latest()->limit(4)->get()
        ]);
    }

    public function post(NotificationRequest $request){

        try {
            //code...
            $this->notificationService->create(
                $request
            );
            return response()->json(["message" => "Notification created successfully."], 201);
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json(["message" => "Something went wrong. Please try again."], 400);
        }

    }
}
