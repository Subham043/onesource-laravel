<?php

namespace App\Modules\Achiever\Category\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Achiever\Category\Resources\UserCategoryCollection;
use App\Modules\Achiever\Category\Services\CategoryService;

class UserCategoryDetailController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function get($slug){
        $category = $this->categoryService->getBySlug($slug);
        return response()->json([
            'message' => "Category recieved successfully.",
            'category' => UserCategoryCollection::make($category),
        ], 200);
    }
}
