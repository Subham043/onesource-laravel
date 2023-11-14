<?php

namespace App\Modules\Customer\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Customer\Services\CustomerService;
use App\Modules\Document\Models\DocumentNotification;
use Illuminate\Http\Request;

class CustomerPaginateController extends Controller
{
    private $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->middleware('permission:list customers', ['only' => ['get']]);
        $this->customerService = $customerService;
    }

    public function get(Request $request){
        $data = $this->customerService->paginate($request->total ?? 10);
        return view('customers.list', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '')->with([
                'page_name' => 'Customer',
                'notifications' => DocumentNotification::filterByRoles()->latest()->limit(4)->get()
            ]);
    }

}
