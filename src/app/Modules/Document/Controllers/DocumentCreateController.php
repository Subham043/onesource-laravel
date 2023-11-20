<?php

namespace App\Modules\Document\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Document\Models\DocumentNotification;
use App\Modules\Document\Requests\DocumentCreateRequest;
use App\Modules\Document\Services\DocumentService;
use App\Modules\Event\Services\EventService;

class DocumentCreateController extends Controller
{
    private $eventService;
    private $documentService;

    public function __construct(DocumentService $documentService, EventService $eventService)
    {
        $this->middleware('permission:add documents', ['only' => ['get','post']]);
        $this->documentService = $documentService;
        $this->eventService = $eventService;
    }

    public function get(){
        $events = $this->eventService->all();
        return view('documents.add', compact(['events']))->with([
            'page_name' => 'Document',
            'notifications' => DocumentNotification::filterByRoles()->latest()->limit(4)->get()
        ]);
    }

    public function post(DocumentCreateRequest $request){

        try {
            //code...
            $this->documentService->create(
                $request
            );
            return response()->json(["message" => "Document created successfully."], 201);
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json(["message" => "Something went wrong. Please try again."], 400);
        }

    }
}
