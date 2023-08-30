<?php

namespace App\Modules\Testimonial\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserTestimonialCollection extends JsonResource
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
            'designation' => $this->designation,
            'star' => $this->star,
            'message' => $this->message,
            'image' => asset($this->image),
            'image_alt' => $this->image_alt,
            'image_title' => $this->image_title,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
        ];
    }
}
