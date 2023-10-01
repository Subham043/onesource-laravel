@extends('layouts.main')

@section('content')
    <div>
        <div class="col-sm-12 col-lg-12">
            <form class="form-horizontal">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Profile Details</h4>
                        </div>
                        <div>
                            <a href="{{route('profile.edit.get')}}" class="btn btn-primary">
                                Edit Profile
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Name:</label>
                            <div class="col-sm-10">
                                {{$data->name}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Email:</label>
                            <div class="col-sm-10">
                                {{$data->email}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Phone:</label>
                            <div class="col-sm-10">
                                {{$data->phone}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-2 align-self-center mb-0" for="client">Timezone:</label>
                            <div class="col-sm-10">
                                {{!empty($data->timezone) ? $data->timezone->value : ''}}</div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-2 align-self-center mb-0" for="client">Role:</label>
                            <div class="col-sm-10">
                                {{$data->current_role}}</div>
                        </div>

                    </div>
                </div>
        </div>
    </div>
@stop
