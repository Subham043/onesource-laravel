<?php

namespace App\Modules\Gallery\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gallery\Requests\GalleryUpdateRequest;
use App\Modules\Gallery\Services\GalleryService;

class GalleryUpdateController extends Controller
{
    private $galleryService;

    public function __construct(GalleryService $galleryService)
    {
        $this->middleware('permission:edit galleries', ['only' => ['get','post']]);
        $this->galleryService = $galleryService;
    }

    public function get($id){
        $data = $this->galleryService->getById($id);
        return view('admin.pages.gallery.update', compact('data'));
    }

    public function post(GalleryUpdateRequest $request, $id){
        $gallery = $this->galleryService->getById($id);
        try {
            //code...
            $this->galleryService->update(
                $request->except('image'),
                $gallery
            );
            if($request->hasFile('image')){
                $this->galleryService->saveImage($gallery);
            }
            return response()->json(["message" => "Gallery updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
