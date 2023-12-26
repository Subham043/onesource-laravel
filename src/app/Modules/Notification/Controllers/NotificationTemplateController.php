<?php

namespace App\Modules\Notification\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Document\Models\DocumentNotification;
use App\Modules\Notification\Requests\TemplateRequest;
use App\Modules\Notification\Services\TemplateService;

class NotificationTemplateController extends Controller
{
    private $templateService;

    public function __construct(TemplateService $templateService)
    {
        $this->middleware('permission:list notifications', ['only' => ['get','post']]);
        $this->templateService = $templateService;
    }

    public function get(){
        $data = $this->templateService->get();
        return view('notifications.template', compact(['data']))->with([
            'page_name' => 'Notification Template',
            'notifications' => DocumentNotification::filterByRoles()->latest()->limit(4)->get()
        ]);
    }

    public function post(TemplateRequest $request){

        try {
            //code...
            $this->templateService->update($request);
            return response()->json(["message" => "Template updated successfully."], 200);
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json(["message" => "Something went wrong. Please try again."], 400);
        }

    }
}
