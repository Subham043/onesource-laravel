<?php

namespace App\Modules\Enquiry\VrddhiForm\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VrddhiFormCollection extends JsonResource
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
            'school_name' => $this->school_name,
            'phone' => $this->phone,
            'father_name' => $this->father_name,
            'father_email' => $this->father_email,
            'father_phone' => $this->father_phone,
            'mother_name' => $this->mother_name,
            'mother_email' => $this->mother_email,
            'mother_phone' => $this->mother_phone,
            'class' => $this->class,
            'syllabus' => $this->syllabus,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
        ];
    }
}
