<?php

namespace App\Modules\Document\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Document\Services\DocumentService;

class DocumentDeleteController extends Controller
{
    private $eventDocumentService;

    public function __construct(DocumentService $eventDocumentService)
    {
        $this->middleware('permission:delete documents', ['only' => ['get']]);
        $this->eventDocumentService = $eventDocumentService;
    }

    public function get($id){
        $eventDocument = $this->eventDocumentService->getById($id);
        if((auth()->user()->current_role=='Admin' || auth()->user()->current_role=='Staff-Admin') || (auth()->user()->current_role=='Writer') && $eventDocument->created_by==auth()->user()->id){
            try {
                //code...
                $this->eventDocumentService->delete(
                    $eventDocument
                );
                return redirect()->back()->with('success_status', 'Document deleted successfully.');
            } catch (\Throwable $th) {
                return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
            }
        }
        abort(404);
    }

}
