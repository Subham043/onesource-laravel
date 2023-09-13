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
        $next_expertTip = $this->expertTipService->getNext($expertTip->id);
        $prev_expertTip = $this->expertTipService->getPrev($expertTip->id);
        return response()->json([
            'message' => "ExpertTip recieved successfully.",
            'expertTip' => UserExpertTipCollection::make($expertTip),
            'next_expertTip' => !empty($next_expertTip) ? UserExpertTipCollection::make($next_expertTip) : null,
            'prev_expertTip' => !empty($prev_expertTip) ? UserExpertTipCollection::make($prev_expertTip) : null,
        ], 200);
    }
}
