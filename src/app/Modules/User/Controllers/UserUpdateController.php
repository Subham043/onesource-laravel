<?php

namespace App\Modules\User\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Authentication\Models\User;
use App\Modules\Client\Services\ClientService;
use App\Modules\Document\Models\DocumentNotification;
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
            'page_name' => 'User',
            'notifications' => DocumentNotification::filterByRoles()->latest()->limit(4)->get()
        ]);
    }

    public function post(UserUpdatePostRequest $request, $id){

        // $user = User::where('id', $id)->firstOrFail();
        // $user_check_count = $user->with([
        //     'member_profile_created_by_auth' => function($query) use($request){
        //         $query->where('created_by', auth()->user()->id)->whereHas('user', function($qr) use($request){
        //             $qr->where('phone', $request->phone)->orWhere('email', $request->email);
        //         });
        //     },
        // ])->whereHas('member_profile_created_by_auth', function($qry) use($request){
        //     $qry->where('created_by', auth()->user()->id)->whereHas('user', function($qr) use($request){
        //         $qr->where('phone', $request->phone)->orWhere('email', $request->email);
        //     });
        // })->first();
        // if(empty($user_check_count)){
        //     return response()->json(["message" => "A user with the given credential already exists. Do you want to merge the existing user?", 'merge_available' => true, 'url' => route('user.merge.post', $user->id)], 200);
        // }else{
        //     try {
        //         //code...
        //         $this->userService->update($request,$user_check_count);
        //         return response()->json(["message" => "User updated successfully.", "merge_available" => false], 200);
        //     } catch (\Throwable $th) {
        //         return response()->json(["message" => "Something went wrong. Please try again."], 400);
        //     }
        // }
        $user = $this->userService->getById($id);
        try {
            //code...
            $this->userService->update($request,$user);
            return response()->json(["message" => "User updated successfully.", "merge_available" => false], 200);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again."], 400);
        }

    }
}
