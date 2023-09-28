<?php

namespace App\Modules\ExpertTip\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\ExpertTip\Resources\UserExpertTipCollection;
use App\Modules\ExpertTip\Services\ExpertTipService;

class UserExpertTipAllController extends Controller
{
    private $expertTipService;

    public function __construct(ExpertTipService $expertTipService)
    {
        $this->expertTipService = $expertTipService;
    }

    public function get(){
        $data = $this->expertTipService->all_main();
        return response()->json([
            'message' => "Expert tips recieved successfully.",
            'expertTips' => UserExpertTipCollection::collection($data),
        ], 200);
    }

}
