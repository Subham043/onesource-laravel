<?php

namespace App\Modules\Blog\Comment\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Blog\Comment\Services\CommentService;

class BlogCommentStatusController extends Controller
{
    private $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->middleware('permission:edit blogs', ['only' => ['get','post']]);
        $this->commentService = $commentService;
    }

    public function get($blog_id, $id){
        $comment = $this->commentService->getByBlogIdAndId($blog_id, $id);
        try {
            //code...
            $this->commentService->update(
                [
                    'is_approved' => !$comment->is_approved
                ],
                $comment
            );
            return redirect()->back()->with('success_status', 'Blog Comment updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }

    }
}
