<?php

namespace App\Modules\HomePage\Banner\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserBannerCollection extends JsonResource
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
            'title' => $this->title,
            'heading' => $this->heading,
            'description' => $this->description,
            'button_link' => $this->button_link,
            'button_text' => $this->button_text,
            'banner_image_alt' => $this->banner_image_alt,
            'banner_image_title' => $this->banner_image_title,
            'banner_image' => asset($this->banner_image),
            'counter_title_1' => $this->counter_title_1,
            'counter_description_1' => $this->counter_description_1,
            'counter_image_1' => asset($this->counter_image_1),
            'counter_title_2' => $this->counter_title_2,
            'counter_description_2' => $this->counter_description_2,
            'counter_image_2' => asset($this->counter_image_2),
            'is_active' => $this->is_active,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
        ];
    }
}
