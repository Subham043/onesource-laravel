<?php

namespace App\Modules\Enquiry\EnrollmentForm\Exports;

use App\Modules\Enquiry\EnrollmentForm\Models\EnrollmentForm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EnrollmentFormExport implements FromCollection,WithHeadings,WithMapping
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
            'amount',
            'discount',
            'discounted_amount',
            'receipt',
            'payment_status',
            'razorpay_order_id',
            'razorpay_payment_id',
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
            $data->amount,
            $data->discount,
            $data->discounted_amount,
            $data->receipt,
            $data->payment_status->value,
            $data->razorpay_order_id,
            $data->razorpay_payment_id,
            $data->course->name,
            $data->branch->name,
            $data->created_at,
         ];
    }
    public function collection()
    {
        return EnrollmentForm::all();
    }
}
