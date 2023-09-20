<?php

namespace App\Modules\Blog\Comment\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Blog\Comment\Services\CommentService;
use Illuminate\Http\Request;

class BlogCommentPaginateController extends Controller
{
    private $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->middleware('permission:list blogs', ['only' => ['get']]);
        $this->commentService = $commentService;
    }

    public function get(Request $request, $blog_id){
        $data = $this->commentService->paginate($request->total ?? 10, $blog_id);
        return view('admin.pages.blog.comment.paginate', compact(['data', 'blog_id']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
