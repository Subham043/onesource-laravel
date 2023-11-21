@extends('layouts.main')

@section('content')
<div>
    <div class="col-sm-12 col-lg-12">
        <form class="form-horizontal">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">User Details</h4>
                    </div>
                    <div >
                        @can('edit users')
                        <a href="{{route('user.update.get', $user->id)}}" class="btn btn-primary">
                            Edit This User
                        </a>
                        @endcan
                        <a href="{{route('dashboard.get')}}" class="btn btn-primary">Return To Dashboard</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Name:</label>
                        <div class="col-sm-10">
                            {{$user->name}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Email:</label>
                        <div class="col-sm-10">
                            {{$user->email}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Phone:</label>
                        <div class="col-sm-10">
                            {{$user->phone}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="client">Role:</label>
                        <div class="col-sm-10">
                            {{($user->current_role=='Staff-Admin' || $user->current_role=='Super Admin' || $user->current_role=='Super-Admin') ? 'Admin' : $user->current_role}}</div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Time Zone :</label>
                        <div class="col-sm-10">
                            {{!empty($user->timezone) ? $user->timezone->value : ''}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Company:</label>
                        <div class="col-sm-10">
                            {{auth()->user()->current_role=='Staff-Admin' ? $user->member_profile_created_by_auth->creator->admin_profile->company : $user->member_profile_created_by_auth->creator->self_profile->company}}
                        </div>
                    </div>
                    @if($user->current_role!='Staff-Admin')
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Billing Rate :</label>
                        <div class="col-sm-10">
                            ${{$user->member_profile_created_by_auth->billing_rate}}
                        </div>
                    </div>
                    @endif
                    @if($user->current_role=='Client')
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Client :</label>
                        <div class="col-sm-10">
                            {{$user->member_profile_created_by_auth->client->name}}
                        </div>
                    </div>
                    @endif
                    @if($user->current_role=='Writer')
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Tools :</label>
                        <div class="col-sm-10">
                            @foreach($user->member_profile_created_by_auth->tools as $k=>$v)
                                {{($k+1==count($user->member_profile_created_by_auth->tools)) ? $v->name : $v->name.', '}}
                            @endforeach
                        </div>
                    </div>
                    @endif
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Registration Date :</label>
                        <div class="col-sm-10">
                            {{$user->member_profile_created_by_auth->created_at->format('M d Y')}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Profile Status :</label>
                        <div class="col-sm-10">
                            @if(!$user->is_blocked)
                                <a href="javascript:void(0)" class="" data-bs-toggle="tooltip" data-bs-original-title="Active"> <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.38574 11.8746L11.2777 13.7696L15.1757 9.86963" stroke="#1aa053" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </a>
                            @else
                                <a href="javascript:void(0)" class="" data-bs-toggle="tooltip" data-bs-original-title="Blocked">
                                    <svg fill="red" width="10px" height="10px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        viewBox="0 0 460.775 460.775" xml:space="preserve">
                                        <path d="M285.08,230.397L456.218,59.27c6.076-6.077,6.076-15.911,0-21.986L423.511,4.565c-2.913-2.911-6.866-4.55-10.992-4.55
                                        c-4.127,0-8.08,1.639-10.993,4.55l-171.138,171.14L59.25,4.565c-2.913-2.911-6.866-4.55-10.993-4.55
                                        c-4.126,0-8.08,1.639-10.992,4.55L4.558,37.284c-6.077,6.075-6.077,15.909,0,21.986l171.138,171.128L4.575,401.505
                                        c-6.074,6.077-6.074,15.911,0,21.986l32.709,32.719c2.911,2.911,6.865,4.55,10.992,4.55c4.127,0,8.08-1.639,10.994-4.55
                                        l171.117-171.12l171.118,171.12c2.913,2.911,6.866,4.55,10.993,4.55c4.128,0,8.081-1.639,10.992-4.55l32.709-32.719
                                        c6.074-6.075,6.074-15.909,0-21.986L285.08,230.397z"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="client">Image:</label>
                        <div class="col-sm-10">
                            <img src="{{$user->image_link}}" style="height: 100px;object-fit:contain;" />
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>
@stop
