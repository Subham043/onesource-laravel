<?php

namespace App\Modules\Notification\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Client\Services\ClientService;
use App\Modules\Document\Models\DocumentNotification;
use App\Modules\Notification\Requests\SendNotificationRequest;
use App\Modules\Notification\Services\NotificationService;
use App\Modules\User\Services\UserService;
use Illuminate\Console\Scheduling\Schedule;

class NotificationSendController extends Controller
{
    private $userService;
    private $clientService;
    private $notificationService;

    public function __construct(UserService $userService, ClientService $clientService, NotificationService $notificationService)
    {
        $this->middleware('permission:list notifications', ['only' => ['get','post']]);
        $this->userService = $userService;
        $this->clientService = $clientService;
        $this->notificationService = $notificationService;
    }

    public function get(Schedule $schedule){
        $clients = $this->clientService->all();
        $writers = $this->userService->allByWriterRole();
        return view('notifications.send', compact(['clients', 'writers']))->with([
            'page_name' => 'Send Notification',
            'notifications' => DocumentNotification::filterByRoles()->latest()->limit(4)->get()
        ]);
    }

    public function post(SendNotificationRequest $request){

        try {
            //code...
            if($request->notificationType=='writer'){
                $data = $this->notificationService->sendWriterNotification(
                    $request->writer
                );
                if($data && $data>0){
                    return response()->json(["message" => "This user has ".$data." events scheduled.", "count" => $data], 200);
                }
                return response()->json(["message" => "No event available today.", "count" => $data], 200);
            }else{
                $data = $this->notificationService->sendClientNotification(
                    $request->client
                );
                if($data && $data>0){
                    return response()->json(["message" => "This user has ".$data." events scheduled.", "count" => $data], 200);
                }
                return response()->json(["message" => "No event available today.", "count" => $data], 200);
            }
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json(["message" => "Something went wrong. Please try again."], 400);
        }

    }
}
