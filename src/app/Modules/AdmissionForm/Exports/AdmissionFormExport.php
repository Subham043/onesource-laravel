<?php

namespace App\Modules\AdmissionForm\Exports;

use App\Modules\AdmissionForm\Models\AdmissionForm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AdmissionFormExport implements FromCollection,WithHeadings,WithMapping
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
            'location',
            'request_type',
            'date',
            'time',
            'branch',
            'detail',
            'page url',
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
            $data->course,
            $data->location,
            $data->request_type,
            $data->date,
            $data->time,
            $data->branch,
            $data->detail,
            $data->page_url,
            $data->created_at,
         ];
    }
    public function collection()
    {
        return AdmissionForm::all();
    }
}
