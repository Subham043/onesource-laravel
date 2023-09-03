<?php

namespace App\Modules\Faq\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Faq\Requests\FaqUpdateRequest;
use App\Modules\Faq\Services\FaqService;

class FaqUpdateController extends Controller
{
    private $faqService;

    public function __construct(FaqService $faqService)
    {
        $this->middleware('permission:edit faqs', ['only' => ['get','post']]);
        $this->faqService = $faqService;
    }

    public function get($id){
        $data = $this->faqService->getById($id);
        return view('admin.pages.faq.update', compact(['data']));
    }

    public function post(FaqUpdateRequest $request, $id){
        $faq = $this->faqService->getById($id);
        try {
            //code...
            $this->faqService->update(
                $request->except(['image']),
                $faq
            );
            return response()->json(["message" => "Faq updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
