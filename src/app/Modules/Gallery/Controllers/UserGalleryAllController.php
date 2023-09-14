<?php

namespace App\Modules\Gallery\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gallery\Resources\UserGalleryCollection;
use App\Modules\Gallery\Services\GalleryService;

class UserGalleryAllController extends Controller
{
    private $galleryService;

    public function __construct(GalleryService $galleryService)
    {
        $this->galleryService = $galleryService;
    }

    public function get(){
        $gallery = $this->galleryService->main_all();
        return response()->json([
            'message' => "Gallery recieved successfully.",
            'gallery' => UserGalleryCollection::collection($gallery),
        ], 200);
    }

}
