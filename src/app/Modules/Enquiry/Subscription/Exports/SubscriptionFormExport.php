<?php

namespace App\Modules\Enquiry\SubscriptionForm\Exports;

use App\Modules\Enquiry\SubscriptionForm\Models\SubscriptionForm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SubscriptionFormExport implements FromCollection,WithHeadings,WithMapping
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'id',
            'email',
            'page url',
            'created_at',
        ];
    }
    public function map($data): array
    {
         return[
            $data->id,
            $data->email,
            $data->page_url,
            $data->created_at,
         ];
    }
    public function collection()
    {
        return SubscriptionForm::all();
    }
}
