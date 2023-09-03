<?php

namespace App\Modules\Achiever\Category\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Achiever\Category\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryPaginateController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->middleware('permission:list expert tips', ['only' => ['get']]);
        $this->categoryService = $categoryService;
    }

    public function get(Request $request){
        $data = $this->categoryService->paginate($request->total ?? 10);
        return view('admin.pages.achiever.category.paginate', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
