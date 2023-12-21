<?php

namespace App\Modules\Notification\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Notification\Services\NotificationService;

class NotificationDeleteController extends Controller
{
    private $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->middleware('permission:delete events', ['only' => ['get']]);
        $this->notificationService = $notificationService;
    }

    public function get($id){
        $user = $this->notificationService->getById($id);

        try {
            //code...
            $this->notificationService->delete(
                $user
            );
            return redirect()->back()->with('success_status', 'Notification deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
