<?php

namespace App\Modules\User\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Authentication\Models\User;
use App\Modules\Client\Services\ClientService;
use App\Modules\Document\Models\DocumentNotification;
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
            'page_name' => 'User',
            'notifications' => DocumentNotification::filterByRoles()->latest()->limit(4)->get()
        ]);
    }

    public function post(UserCreatePostRequest $request){
        $user = User::where('email', $request->email)->orWhere('phone', $request->phone)->first();
        if(empty($user)){
            try {
                //code...
                $user_data = $this->userService->create(
                    $request
                );
                if($request->file('image') && $request->file('image')->isValid()){
                    $file = $request->file('image')->hashName();
                    $request->file('image')->storeAs((new User)->image_path,$file);
                    $user_data->image = $file;
                    $user_data->save();
                }
                return response()->json(["message" => "User created successfully.", "merge_available" => false], 201);
            } catch (\Throwable $th) {
                // throw $th;
                return response()->json(["message" => "Something went wrong. Please try again."], 400);
            }
        }else{
            if($user->current_role=='Super-Admin' || $user->current_role=='Admin' || $user->current_role=='Staff-Admin'){
                return response()->json(["message" => "User already exists.", 'merge_available' => false], 400);
            }
            $user_check_count = $user->with([
                'member_profile_created_by_auth' => function($query) use($request){
                    $query->where('created_by', auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id)->whereHas('user', function($qr) use($request){
                        $qr->where('phone', $request->phone)->orWhere('email', $request->email);
                    });
                },
            ])->whereHas('member_profile_created_by_auth', function($qry) use($request){
                $qry->where('created_by', auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id)->whereHas('user', function($qr) use($request){
                    $qr->where('phone', $request->phone)->orWhere('email', $request->email);
                });
            })->first();
            if(empty($user_check_count)){
                return response()->json(["message" => "A user with the given credential already exists. Do you want to merge the existing user?", 'merge_available' => true, 'url' => route('user.merge.post', $user->id)], 200);
            }
            return response()->json(["message" => "A user already exists", 'merge_available' => false], 400);
        }


    }
}
