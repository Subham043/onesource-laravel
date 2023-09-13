<?php

namespace App\Modules\Testimonial\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Testimonial\Resources\UserTestimonialCollection;
use App\Modules\Testimonial\Services\TestimonialService;
use Illuminate\Http\Request;

class UserTestimonialPaginateController extends Controller
{
    private $testimonialService;

    public function __construct(TestimonialService $testimonialService)
    {
        $this->testimonialService = $testimonialService;
    }

    public function get(Request $request){
        $testimonial = $this->testimonialService->paginateMain($request->total ?? 10);
        return UserTestimonialCollection::collection($testimonial);
    }

}
