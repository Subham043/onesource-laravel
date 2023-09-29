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
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Name:</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="eventName" placeholder="Full Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Email ID:</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="eventName" placeholder="johndoe@gmail.com">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Phone:</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="eventName" placeholder="555-555-555">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Password:</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="eventName" placeholder=" ">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Confirm Password:</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="eventName" placeholder=" ">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="client">Role:</label>
                        <div class="col-sm-10">
                            <select class="form-select shadow-none">
                                <option>Select Role</option>
                                <option value="1">Admin</option>
                                <option value="2" selected="">Writer</option>
                                <option value="3">Client</option>
                            </select></div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="invRate">Client: <span data-bs-toggle="tooltip" data-bs-original-title="Shown Only If Role Is Client"><i class="icon">
                                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='currentColor'><circle cx='6' cy='6' r='4.5'/><path stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/><circle cx='6' cy='8.2' r='.6' fill='currentColor' stroke='none'/></svg>
                                </i></span></label>
                        <div class="col-sm-10">
                            <select class="form-select shadow-none">
                                <option selected="">Select Client</option>
                                <option value="1">Client 1</option>
                                <option value="2">Client 2</option>
                                <option value="3">Client 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="invRate">Primary User: <span data-bs-toggle="tooltip" data-bs-original-title="Shown Only If Role Is Client"><i class="icon">
                                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='currentColor'><circle cx='6' cy='6' r='4.5'/><path stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/><circle cx='6' cy='8.2' r='.6' fill='currentColor' stroke='none'/></svg>
                                </i></span> </label>
                        <div class="col-sm-10">
                            <select class="form-select shadow-none">
                                <option selected="">Select</option>
                                <option value="1">Yes</option>
                                <option value="2">NO</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Time Zone :</label>
                        <div class="col-sm-10">
                            <select class="form-select shadow-none">
                                <option>Select</option>
                                <option value="Pacific/Honolulu">Pacific/Honolulu GMT-10:00</option>
                                <option value="America/Anchorage">America/Anchorage GMT-9:00</option>
                                <option value="America/Los_Angeles">America/Los_Angeles GMT-8:00</option>
                                <option value="America/Boise">America/Boise GMT-7:00</option>
                                <option value="America/Denver">America/Denver GMT-7:00</option>
                                <option value="America/Phoenix">America/Phoenix GMT-7:00</option>
                                <option value="America/Chicago">America/Chicago GMT-6:00</option>
                                <option value="America/Detroit">America/Detroit GMT-5:00</option>
                                <option value="America/New_York" selected="">America/New_York GMT-5:00</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Billing Rate : <span data-bs-toggle="tooltip" data-bs-original-title="Shown Only If Role Is Client"><i class="icon">
                                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='currentColor'><circle cx='6' cy='6' r='4.5'/><path stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/><circle cx='6' cy='8.2' r='.6' fill='currentColor' stroke='none'/></svg>
                                </i></span></label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="eventName" placeholder="$100">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Tools :</label>
                        <div class="col-sm-10">
                            <select class="form-select shadow-none" multiple>
                                <option selected="">Select Tools</option>
                                <option value="1">Tool 1</option>
                                <option value="2" selected="">Tool 2</option>
                                <option value="3" selected="">Tool 3</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop
