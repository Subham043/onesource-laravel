<?php

namespace App\Modules\Faq\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Faq\Resources\UserFaqCollection;
use App\Modules\Faq\Services\FaqService;
use Illuminate\Http\Request;

class UserFaqPaginateController extends Controller
{
    private $faqService;

    public function __construct(FaqService $faqService)
    {
        $this->faqService = $faqService;
    }

    public function get(Request $request){
        $data = $this->faqService->paginateMain($request->total ?? 10);
        return UserFaqCollection::collection($data);
    }

}
