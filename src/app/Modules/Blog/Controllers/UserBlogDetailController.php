<?php

namespace App\Modules\Blog\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Blog\Resources\UserBlogCollection;
use App\Modules\Blog\Services\BlogService;

class UserBlogDetailController extends Controller
{
    private $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function get($slug){
        $blog = $this->blogService->getBySlug($slug);
        $next_blog = $this->blogService->getNext($blog->id);
        $prev_blog = $this->blogService->getPrev($blog->id);
        return response()->json([
            'message' => "Blog recieved successfully.",
            'blog' => UserBlogCollection::make($blog),
            'next_blog' => !empty($next_blog) ? UserBlogCollection::make($next_blog) : null,
            'prev_blog' => !empty($prev_blog) ? UserBlogCollection::make($prev_blog) : null,
        ], 200);
    }
}
