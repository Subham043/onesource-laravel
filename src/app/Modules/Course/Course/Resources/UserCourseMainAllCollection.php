<?php

namespace App\Modules\Course\Course\Resources;

use App\Modules\Course\Branch\Resources\UserBranchCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class UserCourseMainAllCollection extends JsonResource
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
            'short_description' => str()->limit($this->description_unfiltered, 100),
            'image_title' => $this->image_title,
            'image_alt' => $this->image_alt,
            'image' => asset($this->image),
            'class' => $this->class,
            'amount' => $this->amount,
            'discount' => $this->discount,
            'discounted_amount' => $this->discounted_amount,
            'branches' => UserBranchCollection::collection($this->branches),
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
            'created' => $this->created_at->format('Y, d M'),
            'updated' => $this->updated_at->format('Y, d M'),
        ];
    }
}
