<?php

namespace App\Modules\Enquiry\VrddhiForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\VrddhiForm\Services\VrddhiFormService;
use Illuminate\Http\Request;

class VrddhiFormPaginateController extends Controller
{
    private $vrddhiFormService;

    public function __construct(VrddhiFormService $vrddhiFormService)
    {
        $this->middleware('permission:list enquiries', ['only' => ['get']]);
        $this->vrddhiFormService = $vrddhiFormService;
    }

    public function get(Request $request){
        $data = $this->vrddhiFormService->paginate($request->total ?? 10);
        return view('admin.pages.enquiry.vrddhi_form', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
