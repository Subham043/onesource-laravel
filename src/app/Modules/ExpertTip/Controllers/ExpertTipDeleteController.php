<?php

namespace App\Modules\ExpertTip\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\ExpertTip\Services\ExpertTipService;

class ExpertTipDeleteController extends Controller
{
    private $expertTipService;

    public function __construct(ExpertTipService $expertTipService)
    {
        $this->middleware('permission:delete expert tips', ['only' => ['get']]);
        $this->expertTipService = $expertTipService;
    }

    public function get($id){
        $expertTip = $this->expertTipService->getById($id);

        try {
            //code...
            $this->expertTipService->delete(
                $expertTip
            );
            return redirect()->back()->with('success_status', 'ExpertTip deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
