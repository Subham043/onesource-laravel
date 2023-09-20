<?php

namespace App\Modules\Blog\Comment\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Blog\Comment\Services\CommentService;

class BlogCommentDeleteController extends Controller
{
    private $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->middleware('permission:delete blogs', ['only' => ['get']]);
        $this->commentService = $commentService;
    }

    public function get($blog_id, $id){
        $comment = $this->commentService->getByBlogIdAndId($blog_id, $id);

        try {
            //code...
            $this->commentService->delete(
                $comment
            );
            return redirect()->back()->with('success_status', 'Blog Comment deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
