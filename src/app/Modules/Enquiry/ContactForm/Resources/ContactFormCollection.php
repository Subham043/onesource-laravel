<?php

namespace App\Modules\Enquiry\ContactForm\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactFormCollection extends JsonResource
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
            'phone' => $this->phone,
            'page_url' => $this->page_url,
            'detail' => $this->detail,
            'course' => $this->course,
            'location' => $this->location,
            'branch' => $this->branch,
            'request_type' => $this->request_type,
            'date' => $this->date,
            'time' => $this->time,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
        ];
    }
}
