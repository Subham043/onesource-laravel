<?php

namespace App\Modules\Customer\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Customer\Services\CustomerService;

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
        return view('customers.view', compact('data'));
    }
}
