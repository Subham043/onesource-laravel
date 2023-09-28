<?php

namespace App\Modules\Blog\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Blog\Resources\UserBlogCollection;
use App\Modules\Blog\Services\BlogService;

class UserBlogAllController extends Controller
{
    private $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function get(){
        $data = $this->blogService->all_main();
        return response()->json([
            'message' => "Events recieved successfully.",
            'blogs' => UserBlogCollection::collection($data),
        ], 200);
    }

}
