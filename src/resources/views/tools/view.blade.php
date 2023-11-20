@extends('layouts.main')

@section('content')
<div>
    <div class="col-sm-12 col-lg-12">
        <form class="form-horizontal">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Tool Details</h4>
                    </div>
                    <div >
                        <a href="{{route('tool.update.get', $data->id)}}" class="btn btn-primary">
                            Edit This Tool
                        </a>
                        <a href="{{route('dashboard.get')}}" class="btn btn-primary">Return To Dashboard</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Name:</label>
                        <div class="col-sm-10">
                            {{$data->name}}
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@stop
