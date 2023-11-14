<?php

namespace App\Modules\Customer\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Customer\Requests\CustomerUpdatePostRequest;
use App\Modules\Customer\Services\CustomerService;
use App\Modules\Document\Models\DocumentNotification;

class CustomerUpdateController extends Controller
{
    private $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->middleware('permission:edit customers', ['only' => ['get', 'post']]);
        $this->customerService = $customerService;
    }

    public function get($id){
        $data = $this->customerService->getById($id);
        return view('customers.edit', compact(['data']))->with([
            'page_name' => 'Customer',
            'notifications' => DocumentNotification::filterByRoles()->latest()->limit(4)->get()
        ]);
    }

    public function post(CustomerUpdatePostRequest $request, $id){
        $customer = $this->customerService->getById($id);

        try {
            //code...
            $this->customerService->update(
                $request,
                $customer
            );
            return redirect()->intended(route('customer.paginate.get'))->with('success_status', 'User updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->intended(route('customer.update.get', $customer->id))->with('error_status', 'Something went wrong. Please try again');
        }

    }
}
