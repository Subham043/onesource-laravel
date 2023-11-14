<?php

namespace App\Modules\Customer\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Customer\Services\CustomerService;
use App\Modules\Document\Models\DocumentNotification;

class CustomerViewController extends Controller
{
    private $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->middleware('permission:view customers', ['only' => ['get']]);
        $this->customerService = $customerService;
    }

    public function get($id){
        $data = $this->customerService->getById($id);
        return view('customers.view', compact('data'))->with([
            'page_name' => 'Customer',
            'notifications' => DocumentNotification::filterByRoles()->latest()->limit(4)->get()
        ]);
    }
}
