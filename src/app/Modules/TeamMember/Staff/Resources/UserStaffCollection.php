<?php

namespace App\Modules\TeamMember\Staff\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserStaffCollection extends JsonResource
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
            'description' => $this->description,
            'image_title' => $this->image_title,
            'image_alt' => $this->image_alt,
            'image' => asset($this->image),
            'is_active' => $this->is_active,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
        ];
    }
}
