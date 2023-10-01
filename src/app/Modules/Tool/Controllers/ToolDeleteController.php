<?php

namespace App\Modules\Tool\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Tool\Services\ToolService;

class ToolDeleteController extends Controller
{
    private $toolService;

    public function __construct(ToolService $toolService)
    {
        $this->middleware('permission:delete tools', ['only' => ['get']]);
        $this->toolService = $toolService;
    }

    public function get($id){
        $tool = $this->toolService->getById($id);

        try {
            //code...
            $this->toolService->delete(
                $tool
            );
            return redirect()->back()->with('success_status', 'Tool deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
