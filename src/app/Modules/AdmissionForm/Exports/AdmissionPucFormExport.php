<?php

namespace App\Modules\AdmissionForm\Exports;

use App\Enums\AdmissionEnum;
use App\Modules\AdmissionForm\Models\AdmissionForm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AdmissionPucFormExport implements FromCollection,WithHeadings,WithMapping
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'id',
            'name',
            'school_name',
            'father_name',
            'father_phone',
            'father_occupation',
            'mother_name',
            'mother_phone',
            'mother_occupation',
            'center',
            'aadhar',
            'address',
            'batch',
            'sibling',
            'no_of_sibling',
            'sibling_occupation',
            'sibling_school',
            'sibling_class',
            'created_at',
        ];
    }
    public function map($data): array
    {
         return[
            $data->id,
            $data->name,
            $data->school_name,
            $data->father_name,
            $data->father_phone,
            $data->father_occupation,
            $data->mother_name,
            $data->mother_phone,
            $data->mother_occupation,
            $data->center,
            $data->aadhar,
            $data->address,
            $data->batch,
            $data->sibling,
            $data->no_of_sibling,
            $data->sibling_occupation,
            $data->sibling_school,
            $data->sibling_class,
            $data->created_at,
         ];
    }
    public function collection()
    {
        return AdmissionForm::where('admission_for', AdmissionEnum::PUC)->get();
    }
}
