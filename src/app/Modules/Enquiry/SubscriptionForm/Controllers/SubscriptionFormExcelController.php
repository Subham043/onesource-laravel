<?php

namespace App\Modules\Enquiry\SubscriptionForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\SubscriptionForm\Exports\SubscriptionFormExport;
use Maatwebsite\Excel\Facades\Excel;

class SubscriptionFormExcelController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:list enquiries', ['only' => ['get']]);
    }

    public function get(){
        return Excel::download(new SubscriptionFormExport, 'subscription_form.xlsx');
    }

}
