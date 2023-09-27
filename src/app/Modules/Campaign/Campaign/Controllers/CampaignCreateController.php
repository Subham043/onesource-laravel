<?php

namespace App\Modules\Campaign\Campaign\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Achiever\Student\Services\StudentService;
use App\Modules\Campaign\Campaign\Requests\CampaignCreateRequest;
use App\Modules\Campaign\Campaign\Services\CampaignService;
use App\Modules\Campaign\Speaker\Services\SpeakerService;
use App\Modules\Testimonial\Services\TestimonialService;

class CampaignCreateController extends Controller
{
    private $campaignService;
    private $testimonialService;
    private $achieverService;

    public function __construct(CampaignService $campaignService, TestimonialService $testimonialService, StudentService $achieverService)
    {
        $this->middleware('permission:create campaigns', ['only' => ['get','post']]);
        $this->campaignService = $campaignService;
        $this->testimonialService = $testimonialService;
        $this->achieverService = $achieverService;
    }

    public function get(){
        $testimonial = $this->testimonialService->all();
        $achiever = $this->achieverService->all();
        return view('admin.pages.campaign.campaign.create', compact(['testimonial', 'achiever']));
    }

    public function post(CampaignCreateRequest $request){

        try {
            //code...
            $campaign = $this->campaignService->create(
                $request->except(['image'])
            );
            if($request->hasFile('image')){
                $this->campaignService->saveImage($campaign);
            }
            if($request->testimonial && count($request->testimonial)>0){
                $this->campaignService->save_testimonials($campaign, $request->testimonial);
            }else{
                $this->campaignService->save_testimonials($campaign, []);
            }
            if($request->achiever && count($request->achiever)>0){
                $this->campaignService->save_achievers($campaign, $request->achiever);
            }else{
                $this->campaignService->save_achievers($campaign, []);
            }
            return response()->json(["message" => "Campaign created successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
