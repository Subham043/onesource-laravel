<?php

namespace App\Modules\Course\Branch\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserBranchCollection extends JsonResource
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
            'is_active' => $this->is_active,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
            'created' => $this->created_at->format('Y, d M'),
            'updated' => $this->updated_at->format('Y, d M'),
        ];
    }
}
