<?php

namespace App\Modules\Faq\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Faq\Requests\FaqCreateRequest;
use App\Modules\Faq\Services\FaqService;

class FaqCreateController extends Controller
{
    private $faqService;

    public function __construct(FaqService $faqService)
    {
        $this->middleware('permission:create faqs', ['only' => ['get','post']]);
        $this->faqService = $faqService;
    }

    public function get(){
        return view('admin.pages.faq.create');
    }

    public function post(FaqCreateRequest $request){

        try {
            //code...
            $faq = $this->faqService->create(
                $request->except(['image'])
            );
            return response()->json(["message" => "Faq created successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
