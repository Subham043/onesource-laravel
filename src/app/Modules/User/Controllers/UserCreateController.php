<?php

namespace App\Modules\User\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Client\Services\ClientService;
use App\Modules\Tool\Services\ToolService;
use App\Modules\User\Requests\UserCreatePostRequest;
use App\Modules\User\Services\UserService;

class UserCreateController extends Controller
{
    private $userService;
    private $clientService;
    private $toolService;

    public function __construct(UserService $userService, ClientService $clientService, ToolService $toolService)
    {
        $this->middleware('permission:add users', ['only' => ['get','post']]);
        $this->userService = $userService;
        $this->clientService = $clientService;
        $this->toolService = $toolService;
    }

    public function get(){
        $client = $this->clientService->all();
        $tool = $this->toolService->all();
        return view('users.add', compact(['client', 'tool']))->with([
            'page_name' => 'User'
        ]);
    }

    public function post(UserCreatePostRequest $request){

        try {
            //code...
            $this->userService->create(
                $request
            );
            return redirect()->intended(route('user.create.get'))->with('success_status', 'User created successfully.');
        } catch (\Throwable $th) {
            return redirect()->intended(route('user.create.get'))->with('error_status', 'Something went wrong. Please try again');
        }

    }
}
