<?php

namespace App\Modules\Enquiry\VrddhiForm\Exports;

use App\Modules\Enquiry\VrddhiForm\Models\VrddhiForm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class VrddhiFormExport implements FromCollection,WithHeadings,WithMapping
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'id',
            'name',
            'school name',
            'phone',
            'father name',
            'father phone',
            'father email',
            'mother name',
            'mother phone',
            'mother email',
            'class',
            'syllabus',
            'created at',
        ];
    }
    public function map($data): array
    {
         return[
            $data->id,
            $data->name,
            $data->school_name,
            $data->phone,
            $data->father_name,
            $data->father_phone,
            $data->father_email,
            $data->mother_name,
            $data->mother_phone,
            $data->mother_email,
            $data->class,
            $data->syllabus,
            $data->created_at,
         ];
    }
    public function collection()
    {
        return VrddhiForm::all();
    }
}
