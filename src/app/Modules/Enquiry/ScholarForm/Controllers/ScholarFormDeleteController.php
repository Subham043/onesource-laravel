<?php

namespace App\Modules\Enquiry\ScholarForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\ScholarForm\Services\ScholarFormService;

class ScholarFormDeleteController extends Controller
{
    private $scholarFormService;

    public function __construct(ScholarFormService $scholarFormService)
    {
        $this->middleware('permission:delete enquiries', ['only' => ['get']]);
        $this->scholarFormService = $scholarFormService;
    }

    public function get($id){
        $scholar = $this->scholarFormService->getById($id);

        try {
            //code...
            $this->scholarFormService->delete(
                $scholar
            );
            return redirect()->back()->with('success_status', 'Scholar Form deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
