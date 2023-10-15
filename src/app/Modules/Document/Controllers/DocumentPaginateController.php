<?php

namespace App\Modules\Document\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Document\Services\DocumentService;
use Illuminate\Http\Request;

class DocumentPaginateController extends Controller
{
    private $documentService;

    public function __construct(DocumentService $documentService)
    {
        $this->middleware('permission:list documents', ['only' => ['get','post']]);
        $this->documentService = $documentService;
    }

    public function get(Request $request){
        $data = $this->documentService->paginate($request->total ?? 10);
        return view('documents.list', compact(['data']))->with([
            'page_name' => 'Document'
        ])
        ->with('search', $request->query('filter')['search'] ?? '');
    }

}
