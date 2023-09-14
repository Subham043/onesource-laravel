<?php

namespace App\Modules\Gallery\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gallery\Requests\GalleryCreateRequest;
use App\Modules\Gallery\Services\GalleryService;

class GalleryCreateController extends Controller
{
    private $galleryService;

    public function __construct(GalleryService $galleryService)
    {
        $this->middleware('permission:create galleries', ['only' => ['get','post']]);
        $this->galleryService = $galleryService;
    }

    public function get(){
        return view('admin.pages.gallery.create');
    }

    public function post(GalleryCreateRequest $request){

        try {
            //code...
            $gallery = $this->galleryService->create(
                $request->except('image')
            );
            if($request->hasFile('image')){
                $this->galleryService->saveImage($gallery);
            }
            return response()->json(["message" => "Gallery created successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
