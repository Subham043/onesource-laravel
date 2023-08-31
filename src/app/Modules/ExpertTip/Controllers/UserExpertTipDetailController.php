<?php

namespace App\Modules\ExpertTip\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\ExpertTip\Resources\UserExpertTipCollection;
use App\Modules\ExpertTip\Services\ExpertTipService;

class UserExpertTipDetailController extends Controller
{
    private $expertTipService;

    public function __construct(ExpertTipService $expertTipService)
    {
        $this->expertTipService = $expertTipService;
    }

    public function get($slug){
        $expertTip = $this->expertTipService->getBySlug($slug);
        return response()->json([
            'message' => "ExpertTip recieved successfully.",
            'expertTip' => UserExpertTipCollection::make($expertTip),
        ], 200);
    }
}
