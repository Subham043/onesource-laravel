<?php

namespace App\Modules\Search\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Search\Services\SearchService;
use Illuminate\Http\Request;

class SearchViewController extends Controller
{
    private $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->middleware('permission:list events', ['only' => ['get','post']]);
        $this->searchService = $searchService;
    }
    public function get(Request $request){
        $event_data = $this->searchService->event_paginate($request->total ?? 1);
        $document_data = $this->searchService->document_paginate($request->total ?? 10);
        $user_data = $this->searchService->user_paginate($request->total ?? 10);
        return view('search.list')->with([
            'page_name' => 'Search',
            'event_data' => $event_data,
            'document_data' => $document_data,
            'user_data' => $user_data,
        ]);
    }
}
