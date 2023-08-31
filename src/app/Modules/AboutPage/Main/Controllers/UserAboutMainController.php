<?php

namespace App\Modules\AboutPage\Main\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\AboutPage\Main\Resources\UserAboutMainCollection;
use App\Modules\AboutPage\Main\Services\MainService;

class UserAboutMainController extends Controller
{
    private $mainService;

    public function __construct(MainService $mainService)
    {
        $this->mainService = $mainService;
    }

    public function get($slug){
        $about = $this->mainService->getBySlug($slug);
        return response()->json([
            'message' => "About section recieved successfully.",
            'about' => UserAboutMainCollection::make($about),
        ], 200);
    }
}
