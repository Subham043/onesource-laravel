<?php

namespace App\Modules\Tool\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Tool\Requests\ToolRequest;
use App\Modules\Tool\Services\ToolService;

class ToolUpdateController extends Controller
{
    private $toolService;

    public function __construct(ToolService $toolService)
    {
        $this->middleware('permission:edit tools', ['only' => ['get', 'post']]);
        $this->toolService = $toolService;
    }

    public function get($id){
        $data = $this->toolService->getById($id);
        return view('tools.edit', compact(['data']))->with([
            'page_name' => 'Tool'
        ]);
    }

    public function post(ToolRequest $request, $id){
        $tool = $this->toolService->getById($id);

        try {
            //code...
            $this->toolService->update(
                $request->validated(),
                $tool
            );
            return redirect()->intended(route('tool.update.get', $tool->id))->with('success_status', 'Tool updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->intended(route('tool.update.get', $tool->id))->with('error_status', 'Something went wrong. Please try again');
        }
    }
}
