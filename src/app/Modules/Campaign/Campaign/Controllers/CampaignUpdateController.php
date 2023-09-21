<?php

namespace App\Modules\Campaign\Campaign\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Achiever\Student\Services\StudentService;
use App\Modules\Campaign\Campaign\Requests\CampaignUpdateRequest;
use App\Modules\Campaign\Campaign\Services\CampaignService;
use App\Modules\Testimonial\Services\TestimonialService;

class CampaignUpdateController extends Controller
{
    private $campaignService;
    private $testimonialService;
    private $achieverService;

    public function __construct(CampaignService $campaignService, TestimonialService $testimonialService, StudentService $achieverService)
    {
        $this->middleware('permission:edit campaigns', ['only' => ['get','post']]);
        $this->campaignService = $campaignService;
        $this->testimonialService = $testimonialService;
        $this->achieverService = $achieverService;
    }

    public function get($id){
        $data = $this->campaignService->getById($id);
        $testimonial = $this->testimonialService->all();
        $testimonials =$data->testimonials->pluck('id')->toArray();
        $achiever = $this->achieverService->all();
        $achievers =$data->achievers->pluck('id')->toArray();
        return view('admin.pages.campaign.campaign.update', compact(['data', 'testimonial', 'testimonials', 'achiever', 'achievers']));
    }

    public function post(CampaignUpdateRequest $request, $id){
        $campaign = $this->campaignService->getById($id);
        try {
            //code...
            $this->campaignService->update(
                $request->except(['image']),
                $campaign
            );
            if($request->hasFile('image')){
                $this->campaignService->saveImage($campaign);
            }
            if($request->testimonial && count($request->testimonial)>0){
                $this->campaignService->save_testimonials($campaign, $request->testimonial);
            }
            if($request->achiever && count($request->achiever)>0){
                $this->campaignService->save_achievers($campaign, $request->achiever);
            }
            return response()->json(["message" => "Campaign updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
