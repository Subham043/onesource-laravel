<?php

namespace App\Modules\Gallery\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gallery\Services\GalleryService;

class GalleryDeleteController extends Controller
{
    private $galleryService;

    public function __construct(GalleryService $galleryService)
    {
        $this->middleware('permission:delete galleries', ['only' => ['get']]);
        $this->galleryService = $galleryService;
    }

    public function get($id){
        $gallery = $this->galleryService->getById($id);

        try {
            //code...
            $this->galleryService->delete(
                $gallery
            );
            return redirect()->back()->with('success_status', 'Gallery deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
