<?php

namespace App\Modules\Achiever\Category\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Achiever\Category\Resources\UserCategoryCollection;
use App\Modules\Achiever\Category\Services\CategoryService;
use Illuminate\Http\Request;

class UserCategoryPaginateController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function get(Request $request){
        $data = $this->categoryService->paginateMain($request->total ?? 10);
        return UserCategoryCollection::collection($data);
    }

}
