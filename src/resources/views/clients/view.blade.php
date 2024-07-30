@extends("layouts.main")

@section("content")
				<div>
								<div class="col-sm-12 col-lg-12">
												<form class="form-horizontal">
																<div class="card">
																				<div class="card-header d-flex justify-content-between">
																								<div class="header-title">
																												<h4 class="card-title">Client Details</h4>
																								</div>
																								<div>
																												<a href="{{ route("client.update.get", $data->id) }}" class="btn btn-primary">
																																Edit This Client
																												</a>
																												<a href="{{ route("dashboard.get") }}" class="btn btn-primary">Dashboard</a>
																								</div>
																				</div>
																				<div class="card-body">
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Name:</label>
																												<div class="col-sm-10">
																																{{ $data->name }}
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Email:</label>
																												<div class="col-sm-10">
																																{{ $data->email }}
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Phone:</label>
																												<div class="col-sm-10">
																																{{ $data->phone }}
																												</div>
																								</div>
																								{{-- <div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Onsite Billing
																																Rate:</label>
																												<div class="col-sm-10">
																																${{ $data->onsite_billing_rate }}
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Remote Billing
																																Rate:</label>
																												<div class="col-sm-10">
																																${{ $data->remote_billing_rate }}
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Setup Time
																																(minutes):</label>
																												<div class="col-sm-10">
																																{{ $data->setup_time }}
																												</div>
																								</div> --}}
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Address:</label>
																												<div class="col-sm-10">
																																{{ $data->address }}
																												</div>
																								</div>
																				</div>
																</div>
												</form>
								</div>
				</div>
@stop
