<?php

namespace App\Modules\ExpertTip\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\ExpertTip\Resources\UserExpertTipCollection;
use App\Modules\ExpertTip\Services\ExpertTipService;
use Illuminate\Http\Request;

class UserExpertTipPaginateController extends Controller
{
    private $expertTipService;

    public function __construct(ExpertTipService $expertTipService)
    {
        $this->expertTipService = $expertTipService;
    }

    public function get(Request $request){
        $data = $this->expertTipService->paginateMain($request->total ?? 10);
        return UserExpertTipCollection::collection($data);
    }

}
