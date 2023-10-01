<?php

namespace App\Modules\Customer\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Customer\Services\CustomerService;
use Illuminate\Support\Facades\Password;

class CustomerPasswordResetLinkController extends Controller
{
    private $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->middleware('permission:edit customers', ['only' => ['get']]);
        $this->customerService = $customerService;
    }

    public function get($id){
        $data = $this->customerService->getById($id);
        $status = Password::sendResetLink(
            ['email' => $data->email]
        );
        if($status === Password::RESET_LINK_SENT){
            return redirect(route('customer.update.get', $data->id))->with(['success_status' => __($status)]);
        }
        return redirect(route('customer.update.get', $data->id))->with(['error_status' => __($status)]);
    }
}
