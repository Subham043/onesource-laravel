<?php

namespace App\Modules\User\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Authentication\Models\Profile;
use App\Modules\Authentication\Models\User;
use App\Modules\User\Services\UserService;

class UserDeleteController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->middleware('permission:delete users', ['only' => ['get']]);
        $this->userService = $userService;
    }

    public function get($id){
        $user = User::where('id', $id)->firstOrFail();
        $user_check_count = $user->with([
            'staff_profile' => function($query) use($id){
                $query->where('created_by', auth()->user()->id)->where('user_id', $id);
            },
        ])->whereHas('staff_profile', function($qry) use($id){
            $qry->where('created_by', auth()->user()->id)->where('user_id', $id);
        })->firstOrFail();
        try {
            //code...
            if($user_check_count->current_role=='Admin' || $user_check_count->current_role=='Super-Admin' || $user_check_count->current_role=='Super Admin'){
                Profile::where('created_by', auth()->user()->id)->where('user_id', $id)->delete();
            }else{
                $user_check_count->delete();
            }
            return redirect()->back()->with('success_status', 'User deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
