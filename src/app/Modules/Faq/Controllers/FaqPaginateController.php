<?php

namespace App\Modules\Faq\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Faq\Services\FaqService;
use Illuminate\Http\Request;

class FaqPaginateController extends Controller
{
    private $faqService;

    public function __construct(FaqService $faqService)
    {
        $this->middleware('permission:list faqs', ['only' => ['get']]);
        $this->faqService = $faqService;
    }

    public function get(Request $request){
        $data = $this->faqService->paginate($request->total ?? 10);
        return view('admin.pages.faq.paginate', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
