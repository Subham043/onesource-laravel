<?php

namespace App\Modules\Enquiry\CourseRequestForm\Exports;

use App\Modules\Enquiry\CourseRequestForm\Models\CourseRequestForm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CourseRequestFormExport implements FromCollection,WithHeadings,WithMapping
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'id',
            'name',
            'email',
            'phone',
            'course',
            'branch',
            'created_at',
        ];
    }
    public function map($data): array
    {
         return[
            $data->id,
            $data->name,
            $data->email,
            $data->phone,
            $data->course->name,
            $data->branch->name,
            $data->created_at,
         ];
    }
    public function collection()
    {
        return CourseRequestForm::all();
    }
}
