<?php

namespace App\Modules\Enquiry\ScholarForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\ScholarForm\Services\ScholarFormService;
use Illuminate\Http\Request;

class ScholarFormPaginateController extends Controller
{
    private $scholarFormService;

    public function __construct(ScholarFormService $scholarFormService)
    {
        $this->middleware('permission:list enquiries', ['only' => ['get']]);
        $this->scholarFormService = $scholarFormService;
    }

    public function get(Request $request){
        $data = $this->scholarFormService->paginate($request->total ?? 10);
        return view('admin.pages.enquiry.scholar_form', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
