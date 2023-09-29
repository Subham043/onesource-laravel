@extends('layouts.main')

@section('content')
<div>
    <div class="col-sm-12 col-lg-12">
        <form class="form-horizontal">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Event Details</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Event Name:</label>
                        <div class="col-sm-10">
                             <select class="form-select shadow-none">
                                <option selected="">Select Event</option>
                                <option value="1">Event One</option>
                                <option value="2">Event Two</option>
                                <option value="3">Event Three</option>
                            </select>
                        </div>
                    </div>

                    <div class="header-title mt-5 mb-0">
                        <h4 class="card-title mb-0">Documents</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <input class="form-control" type="file" id="customFile">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="file" id="customFile">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="file" id="customFile">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop
