<?php

namespace App\Modules\User\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Document\Models\DocumentNotification;
use App\Modules\User\Services\UserService;
use Illuminate\Http\Request;

class UserPaginateController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->middleware('permission:list users', ['only' => ['get']]);
        $this->userService = $userService;
    }

    public function get(Request $request){
        $data = $this->userService->paginate($request->total ?? 10);
        return view('users.list', compact(['data']))->with([
                'page_name' => 'User',
                'notifications' => DocumentNotification::filterByRoles()->latest()->limit(4)->get()
            ])
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
