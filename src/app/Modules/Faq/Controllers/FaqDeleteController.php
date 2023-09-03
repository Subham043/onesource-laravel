<?php

namespace App\Modules\Faq\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Faq\Services\FaqService;

class FaqDeleteController extends Controller
{
    private $faqService;

    public function __construct(FaqService $faqService)
    {
        $this->middleware('permission:delete faqs', ['only' => ['get']]);
        $this->faqService = $faqService;
    }

    public function get($id){
        $faq = $this->faqService->getById($id);

        try {
            //code...
            $this->faqService->delete(
                $faq
            );
            return redirect()->back()->with('success_status', 'Faq deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
