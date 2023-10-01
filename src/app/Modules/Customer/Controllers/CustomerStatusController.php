<?php

namespace App\Modules\Customer\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Customer\Services\CustomerService;
use Illuminate\Support\Facades\Password;

class CustomerStatusController extends Controller
{
    private $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->middleware('permission:edit customers', ['only' => ['get']]);
        $this->customerService = $customerService;
    }

    public function get($id){
        $data = $this->customerService->getById($id);
        $data->is_blocked = !$data->is_blocked;
        $result = $data->save();
        return redirect(route('customer.update.get', $data->id))->with(['success_status' => 'User Status Updated Successfully']);
    }
}
