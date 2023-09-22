<?php

namespace App\Modules\Enquiry\ScholarForm\Exports;

use App\Modules\Enquiry\ScholarForm\Models\ScholarForm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ScholarFormExport implements FromCollection,WithHeadings,WithMapping
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
            $data->course,
            $data->branch,
            $data->created_at,
         ];
    }
    public function collection()
    {
        return ScholarForm::all();
    }
}
