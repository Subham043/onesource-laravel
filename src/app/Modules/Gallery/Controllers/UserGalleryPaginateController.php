<?php

namespace App\Modules\Gallery\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gallery\Resources\UserGalleryCollection;
use App\Modules\Gallery\Services\GalleryService;
use Illuminate\Http\Request;

class UserGalleryPaginateController extends Controller
{
    private $galleryService;

    public function __construct(GalleryService $galleryService)
    {
        $this->galleryService = $galleryService;
    }

    public function get(Request $request){
        $gallery = $this->galleryService->paginateMain($request->total ?? 10);
        return UserGalleryCollection::collection($gallery);
    }

}
