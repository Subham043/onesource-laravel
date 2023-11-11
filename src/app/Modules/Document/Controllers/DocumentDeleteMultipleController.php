<?php

namespace App\Modules\Document\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Document\Requests\DocumentDeleteRequest;
use App\Modules\Document\Services\DocumentService;

class DocumentDeleteMultipleController extends Controller
{
    private $eventDocumentService;

    public function __construct(DocumentService $eventDocumentService)
    {
        $this->middleware('permission:delete documents', ['only' => ['get']]);
        $this->eventDocumentService = $eventDocumentService;
    }

    public function post(DocumentDeleteRequest $request){
        try {
            //code...
            $this->eventDocumentService->docDelete(
                $request
            );
            return response()->json(["message" => "Document deleted successfully."], 200);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again."], 400);
        }
    }

}
