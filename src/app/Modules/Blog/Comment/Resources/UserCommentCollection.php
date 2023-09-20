<?php

namespace App\Modules\Blog\Comment\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserCommentCollection extends JsonResource
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
            'email' => $this->email,
            'comment' => $this->comment,
            'comment_on' => $this->created_at->format('d M, Y').' AT '.$this->created_at->format('h:m a'),
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
        ];
    }
}
