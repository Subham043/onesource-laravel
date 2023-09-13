<?php

namespace App\Modules\Achiever\Category\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Achiever\Category\Resources\UserCategoryCollection;
use App\Modules\Achiever\Category\Services\CategoryService;

class UserCategoryAllController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function get(){
        $data = $this->categoryService->allMain();
        return response()->json([
            'message' => "About section recieved successfully.",
            'achiverCategory' => UserCategoryCollection::collection($data),
        ], 200);
    }

}
