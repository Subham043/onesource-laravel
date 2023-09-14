<?php

namespace App\Modules\Gallery\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gallery\Services\GalleryService;
use Illuminate\Http\Request;

class GalleryPaginateController extends Controller
{
    private $galleryService;

    public function __construct(GalleryService $galleryService)
    {
        $this->middleware('permission:list galleries', ['only' => ['get']]);
        $this->galleryService = $galleryService;
    }

    public function get(Request $request){
        $data = $this->galleryService->paginate($request->total ?? 10);
        return view('admin.pages.gallery.paginate', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
