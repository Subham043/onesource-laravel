<?php

namespace App\Modules\User\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Client\Services\ClientService;
use App\Modules\Tool\Services\ToolService;
use App\Modules\User\Requests\UserUpdatePostRequest;
use App\Modules\User\Services\UserService;

class UserUpdateController extends Controller
{
    private $userService;
    private $clientService;
    private $toolService;

    public function __construct(UserService $userService, ClientService $clientService, ToolService $toolService)
    {
        $this->middleware('permission:edit users', ['only' => ['get', 'post']]);
        $this->userService = $userService;
        $this->clientService = $clientService;
        $this->toolService = $toolService;
    }

    public function get($id){
        $data = $this->userService->getById($id);
        $client = $this->clientService->all();
        $tool = $this->toolService->all();
        $user_roles = $data->getRoleNames()->toArray();
        return view('users.edit', compact(['client', 'tool', 'data']))->with([
            'page_name' => 'User'
        ]);
    }

    public function post(UserUpdatePostRequest $request, $id){
        $user = $this->userService->getById($id);
        try {
            //code...
            $this->userService->update($request,$user);
            return redirect()->intended(route('user.update.get', $user->id))->with('success_status', 'User updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->intended(route('user.update.get', $user->id))->with('error_status', 'Something went wrong. Please try again');
        }

    }
}
