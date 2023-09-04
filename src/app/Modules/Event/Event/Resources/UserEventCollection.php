<?php

namespace App\Modules\Event\Event\Resources;

use App\Modules\Event\Speaker\Resources\UserSpeakerCollection;
use App\Modules\Event\Specification\Resources\UserSpecificationCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class UserEventCollection extends JsonResource
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
            'event_date' => $this->event_date,
            'slug' => $this->slug,
            'heading' => $this->heading,
            'description' => $this->description,
            'description_unfiltered' => $this->description_unfiltered,
            'image_title' => $this->image_title,
            'image_alt' => $this->image_alt,
            'image' => asset($this->image),
            'is_active' => $this->is_active,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'meta_scripts' => $this->meta_scripts,
            'speakers' => UserSpeakerCollection::collection($this->speakers),
            'specifications' => UserSpecificationCollection::collection($this->specifications),
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
        ];
    }
}
