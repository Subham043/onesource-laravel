<?php

namespace App\Modules\Event\Speaker\Resources;

use App\Modules\Achiever\Category\Resources\UserCategoryCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class UserSpeakerCollection extends JsonResource
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
            'qualification' => $this->qualification,
            'image' => asset($this->image),
            'image_alt' => $this->image_alt,
            'image_title' => $this->image_title,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
        ];
    }
}
