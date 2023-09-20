<?php

namespace App\Modules\Blog\Comment\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Blog\Services\BlogService;
use App\Modules\Blog\Comment\Requests\CommentRequest;
use App\Modules\Blog\Comment\Resources\UserCommentCollection;
use App\Modules\Blog\Comment\Services\CommentService;

class UserBlogCommentCreateController extends Controller
{
    private $commentService;
    private $blogService;

    public function __construct(CommentService $commentService, BlogService $blogService)
    {
        $this->commentService = $commentService;
        $this->blogService = $blogService;
    }

    public function post(CommentRequest $request, $blog_id){

        $this->blogService->getById($blog_id);
        try {
            //code...
            $blogComment = $this->commentService->create(
                [
                    ...$request->validated(),
                    'blog_id' => $blog_id
                ]
            );
            return response()->json([
                "message" => "Comment created successfully.",
                "comment" => UserCommentCollection::make($blogComment)
            ], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
