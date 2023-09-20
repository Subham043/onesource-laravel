<?php

namespace App\Modules\Blog\Comment\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Blog\Comment\Requests\CommentRequest;
use App\Modules\Blog\Comment\Services\CommentService;

class BlogCommentUpdateController extends Controller
{
    private $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->middleware('permission:edit blogs', ['only' => ['get','post']]);
        $this->commentService = $commentService;
    }

    public function get($blog_id, $id){
        $data = $this->commentService->getByBlogIdAndId($blog_id, $id);
        return view('admin.pages.blog.comment.update', compact(['data', 'blog_id']));
    }

    public function post(CommentRequest $request, $blog_id, $id){
        $comment = $this->commentService->getByBlogIdAndId($blog_id, $id);
        try {
            //code...
            $this->commentService->update(
                $request->validated(),
                $comment
            );
            return response()->json(["message" => "Blog Comment updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
