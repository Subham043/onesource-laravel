<?php

namespace App\Modules\Tool\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Tool\Requests\ToolRequest;
use App\Modules\Tool\Services\ToolService;

class ToolCreateController extends Controller
{
    private $toolService;

    public function __construct(ToolService $toolService)
    {
        $this->middleware('permission:edit tools', ['only' => ['get', 'post']]);
        $this->toolService = $toolService;
    }

    public function get(){
        return view('tools.add')->with([
            'page_name' => 'Tool'
        ]);
    }

    public function post(ToolRequest $request){
        try {
            //code...
            $this->toolService->create(
                $request->validated(),
            );
            return redirect()->intended(route('tool.paginate.get'))->with('success_status', 'Tool created successfully.');
        } catch (\Throwable $th) {
            return redirect()->intended(route('tool.create.get'))->with('error_status', 'Something went wrong. Please try again');
        }
    }
}
