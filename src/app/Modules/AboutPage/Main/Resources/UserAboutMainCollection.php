<?php

namespace App\Modules\AboutPage\Main\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAboutMainCollection extends JsonResource
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
            'page' => $this->page,
            'title' => $this->title,
            'heading' => $this->heading,
            'description' => $this->description,
            'description_unfiltered' => $this->description_unfiltered,
            'image' => asset($this->image),
            'image_alt' => $this->image_alt,
            'image_title' => $this->image_title,
            'counter_title' => $this->counter_title,
            'counter_description' => $this->counter_description,
            'counter_image' => asset($this->counter_image),
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
        ];
    }
}
