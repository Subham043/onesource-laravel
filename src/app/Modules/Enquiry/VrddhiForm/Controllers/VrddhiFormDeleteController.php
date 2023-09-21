<?php

namespace App\Modules\Enquiry\VrddhiForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\VrddhiForm\Services\VrddhiFormService;

class VrddhiFormDeleteController extends Controller
{
    private $vrddhiFormService;

    public function __construct(VrddhiFormService $vrddhiFormService)
    {
        $this->middleware('permission:delete enquiries', ['only' => ['get']]);
        $this->vrddhiFormService = $vrddhiFormService;
    }

    public function get($id){
        $vrddhi = $this->vrddhiFormService->getById($id);

        try {
            //code...
            $this->vrddhiFormService->delete(
                $vrddhi
            );
            return redirect()->back()->with('success_status', 'Vrddhi Form deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
