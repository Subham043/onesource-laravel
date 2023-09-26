<?php

namespace App\Modules\Campaign\Campaign\Resources;

use App\Modules\Achiever\Student\Resources\UserStudentCollection;
use App\Modules\Testimonial\Resources\UserTestimonialCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class UserCampaignCollection extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'heading' => $this->heading,
            'description' => $this->description,
            'description_unfiltered' => $this->description_unfiltered,
            'short_description' => str()->limit($this->description_unfiltered, 80),
            'image_title' => $this->image_title,
            'image_alt' => $this->image_alt,
            'image' => asset($this->image),
            'is_active' => $this->is_active,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'meta_scripts' => $this->meta_scripts,
            'include_testimonial' => $this->include_testimonial,
            'testimonial_heading' => $this->testimonial_heading,
            'testimonials' => UserTestimonialCollection::collection($this->testimonials),
            'include_topper' => $this->include_topper,
            'topper_heading' => $this->topper_heading,
            'achievers' => UserStudentCollection::collection($this->achievers),
            'include_form' => $this->include_form,
            'form_heading' => $this->form_heading,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
            'created' => $this->created_at->format('Y, d M'),
            'updated' => $this->updated_at->format('Y, d M'),
        ];
    }
}
