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
                        <div>
                            <a href="edit-user.html" class="btn btn-primary">
                                Edit Profile
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Name:</label>
                            <div class="col-sm-10">
                                Full Name
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Email:</label>
                            <div class="col-sm-10">
                                johndoe@gmail.com
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Phone:</label>
                            <div class="col-sm-10">
                                555-555-555
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-2 align-self-center mb-0" for="client">Role:</label>
                            <div class="col-sm-10">
                                Writer</div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">d1Fuzion ID No
                                :</label>
                            <div class="col-sm-10">
                                #23hFZ
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Time Zone :</label>
                            <div class="col-sm-10">
                                America/New_York GMT-5:00
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Billing Rate
                                :</label>
                            <div class="col-sm-10">
                                $100
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Tools :</label>
                            <div class="col-sm-10">
                                Tool1, Tool2, Tool3
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Profile Status
                                :</label>
                            <div class="col-sm-10">
                                <a href="#" class="" data-bs-toggle="tooltip"
                                    data-bs-original-title="Deactivate User Account"> <svg width="32"
                                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.38574 11.8746L11.2777 13.7696L15.1757 9.86963" stroke="#1aa053"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
        </div>
    </div>
@stop
