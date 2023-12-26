<?php

namespace App\Modules\Notification\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Document\Models\DocumentNotification;
use App\Modules\Notification\Requests\NotificationRequest;
use App\Modules\Notification\Services\CronService;
use App\Modules\Notification\Services\NotificationService;

class NotificationUpdateController extends Controller
{
    private $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->middleware('permission:edit notifications', ['only' => ['get','post']]);
        $this->notificationService = $notificationService;
    }

    public function get($id){
        $notification = $this->notificationService->getById($id);
        return view('notifications.edit', compact(['notification']))->with([
            'page_name' => 'Notification Setting',
            'notifications' => DocumentNotification::filterByRoles()->latest()->limit(4)->get()
        ]);
    }

    public function post(NotificationRequest $request, $id){

        $notification = $this->notificationService->getById($id);

        try {
            //code...
            $this->notificationService->update(
                $request, $notification
            );
            return response()->json(["message" => "Notification updated successfully."], 200);
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json(["message" => "Something went wrong. Please try again."], 400);
        }

    }
}
