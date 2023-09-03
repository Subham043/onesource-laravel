<?php

namespace App\Modules\Achiever\Student\Resources;

use App\Modules\Achiever\Category\Resources\UserCategoryCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class UserStudentCollection extends JsonResource
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
            'rank' => $this->rank,
            'college' => $this->college,
            'image' => asset($this->image),
            'image_alt' => $this->image_alt,
            'image_title' => $this->image_title,
            'is_active' => $this->is_active,
            'categories' => UserCategoryCollection::collection($this->categories),
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
        ];
    }
}
