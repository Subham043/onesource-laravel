<?php

namespace App\Modules\Faq\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Faq\Resources\UserFaqCollection;
use App\Modules\Faq\Services\FaqService;

class UserFaqDetailController extends Controller
{
    private $faqService;

    public function __construct(FaqService $faqService)
    {
        $this->faqService = $faqService;
    }

    public function get($id){
        $faq = $this->faqService->getById($id);
        return response()->json([
            'message' => "Faq recieved successfully.",
            'faq' => UserFaqCollection::make($faq),
        ], 200);
    }
}
