<?php

namespace App\Modules\Course\BranchDetail\Resources;

use App\Modules\Achiever\Student\Resources\UserStudentCollection;
use App\Modules\TeamMember\Staff\Resources\UserStaffCollection;
use App\Modules\Testimonial\Resources\UserTestimonialCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class UserBranchDetailCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'description_unfiltered' => $this->description_unfiltered,
            'short_description' => str()->limit($this->description_unfiltered, 80),
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'meta_scripts' => $this->meta_scripts,
            'amount' => $this->amount,
            'discount' => $this->discount,
            'discounted_amount' => $this->discounted_amount,
            'include_testimonial' => $this->include_testimonial,
            'testimonial_heading' => $this->testimonial_heading,
            'testimonials' => UserTestimonialCollection::collection($this->testimonials),
            'include_topper' => $this->include_topper,
            'topper_heading' => $this->topper_heading,
            'achievers' => UserStudentCollection::collection($this->achievers),
            'include_staff' => $this->include_staff,
            'staff_heading' => $this->staff_heading,
            'staffs' => UserStaffCollection::collection($this->staffs),
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
        ];
    }
}
