@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                        <div class="flex-wrap card-header d-flex justify-content-between align-items-center mb-3">
                            <div class="header-title">
                                <h4 class="mb-0 card-title">Customers Details</h4>
                            </div>
                            <div class="header-title">
                                @can('edit customers')
                                <a href="{{route('customer.update.get', $data->id)}}" class="btn btn-primary">Edit This Customer </a>
                                @endcan
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
                                <label class="control-label col-sm-2 align-self-center mb-0"
                                    for="eventName">Company:</label>
                                <div class="col-sm-10">
                                    {{$data->profile->company}}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Address
                                    :</label>
                                <div class="col-sm-10">
                                    {{$data->profile->address}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">City :</label>
                                <div class="col-sm-10">
                                    {{$data->profile->city}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">State/Province
                                    :</label>
                                <div class="col-sm-10">
                                    {{$data->profile->state->value}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Zip
                                    :</label>
                                <div class="col-sm-10">
                                    {{$data->profile->zip}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Time Zone
                                    :</label>
                                <div class="col-sm-10">
                                    {{$data->timezone->value}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Website
                                    :</label>
                                <div class="col-sm-10">
                                    {{$data->profile->website}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Registration
                                    Date :</label>
                                <div class="col-sm-10">
                                    {{$data->created_at->format('d M Y')}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Renewal Date
                                    :</label>
                                <div class="col-sm-10">
                                    {{$data->currentPayment->payment_renewal_date->format('d M Y')}}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Status
                                    :</label>
                                <div class="col-sm-10">
                                    {{$data->is_blocked ? 'Blocked' : 'Active'}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Payment Status
                                    :</label>
                                <div class="col-sm-10">
                                    Done, on {{$data->currentPayment->payment_date->format('d M Y')}} | Payment Mode | Transaction id: xx445498 | $ 300.00
                                </div>
                            </div>




                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
