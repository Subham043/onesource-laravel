<?php

namespace App\Modules\User\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Authentication\Models\User;
use App\Modules\User\Requests\UserMergePostRequest;
use App\Modules\User\Services\UserService;

class UserMergeController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->middleware('permission:add users', ['only' => ['get','post']]);
        $this->userService = $userService;
    }

    public function post(UserMergePostRequest $request, $id){

        $user = User::where('id', $id)->first();
        if(!empty($user)){
            if($user->current_role=='Super-Admin' || $user->current_role=='Admin' || $user->current_role=='Staff-Admin'){
                return response()->json(["message" => "User already exists."], 400);
            }
            $user_check_count = $user->with([
                'member_profile_created_by_auth' => function($query) use($id){
                    $query->where('created_by', auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id)->where('user_id', $id);
                },
            ])->whereHas('member_profile_created_by_auth', function($qry) use($id){
                $qry->where('created_by', auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id)->where('user_id', $id);
            })->first();
            if(empty($user_check_count)){
                try {
                    //code...
                    $this->userService->merge(
                        $request,
                        $user
                    );
                    return response()->json(["message" => "User merged successfully.", "merge_available" => false], 201);
                } catch (\Throwable $th) {
                    return response()->json(["message" => "Something went wrong. Please try again."], 400);
                }
            }
            return response()->json(["message" => "User already exists."], 400);
        }
        return response()->json(["message" => "Invalid request."], 400);

    }
}
