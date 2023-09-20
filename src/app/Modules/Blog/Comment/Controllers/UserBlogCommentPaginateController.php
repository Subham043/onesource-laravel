<?php

namespace App\Modules\Blog\Comment\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Blog\Comment\Resources\UserCommentCollection;
use App\Modules\Blog\Comment\Services\CommentService;
use App\Modules\Blog\Services\BlogService;
use Illuminate\Http\Request;

class UserBlogCommentPaginateController extends Controller
{
    private $commentService;
    private $blogService;

    public function __construct(CommentService $commentService, BlogService $blogService)
    {
        $this->commentService = $commentService;
        $this->blogService = $blogService;
    }

    public function get(Request $request, $blog_id){
        $this->blogService->getById($blog_id);
        $data = $this->commentService->paginateMain($request->total ?? 10, $blog_id);
        return UserCommentCollection::collection($data);
    }

}
