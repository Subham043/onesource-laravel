@extends("layouts.main")

@section("css")
				<link rel="stylesheet" href="{{ asset("assets/css/select2.min.css") }}" type="text/css" />
				<link rel="stylesheet" href="{{ asset("assets/css/filepond.min.css") }}" type="text/css" />
				<link rel="stylesheet" href="{{ asset("assets/css/filepond-plugin-image-preview.min.css") }}" type="text/css" />
@stop

@section("content")
				<div>
								<div class="col-sm-12 col-lg-12">
												<form id="loginForm" method="POST" action="{{ route("event.update.post", $event->id) }}"
																class="form-horizontal">
																@csrf
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
																																<input type="text" class="form-control" id="name" name="name"
																																				value="{{ $event->name }}">
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="client">Client:</label>
																												<div class="col-sm-10">
																																<select class="form-select shadow-none" id="client" name="client">
																																				<option value="">Select Client</option>
																																				@foreach ($clients as $client)
																																								<option value="{{ $client->id }}"
																																												{{ $event->client->id == $client->id ? "selected" : "" }}>{{ $client->name }}
																																								</option>
																																				@endforeach
																																</select>
																												</div>
																								</div>
																								{{-- <div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="rate_type">Rate Type:</label>
																												<div class="col-sm-10">
																																<select class="form-select shadow-none" id="rate_type" name="rate_type">
																																				<option selected value="">Select Rate Type</option>
																																				<option value="Onsite"
																																								{{ $event->rate_type && $event->rate_type->value == "Onsite" ? "selected" : "" }}>
																																								Onsite
																																				</option>
																																				<option value="Remote"
																																								{{ $event->rate_type && $event->rate_type->value == "Remote" ? "selected" : "" }}>
																																								Remote
																																				</option>
																																</select>
																												</div>
																								</div> --}}
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="invRate">Invoice Rate: <span
																																				data-bs-toggle="tooltip"
																																				data-bs-original-title="Invoice rate should look like 000.00 (no dollar sign)"><i
																																								class="icon">
																																								<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12'
																																												height='12' fill='none' stroke='currentColor'>
																																												<circle cx='6' cy='6' r='4.5' />
																																												<path stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z' />
																																												<circle cx='6' cy='8.2' r='.6' fill='currentColor'
																																																stroke='none' />
																																								</svg>
																																				</i></span></label>
																												<div class="col-sm-10">
																																<input type="text" class="form-control" id="invoice_rate" name="invoice_rate"
																																				value="{{ $event->invoice_rate }}">
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="start_date">Start
																																Date:</label>
																												<div class="col-sm-3">
																																<input type="date" class="form-control" id="start_date" name="start_date"
																																				value="{{ $event->start_date ? $event->start_date->format("Y-m-d") : "" }}">
																												</div>
																												<label class="control-label col-sm-2 align-self-center mb-0" for="start_time">Start
																																Time:</label>
																												<div class="col-sm-3">
																																<input type="time" class="form-control" id="start_time" name="start_time"
																																				value="{{ $event->start_time ? $event->start_time->timezone(auth()->user()->timezone ? strtok(auth()->user()->timezone->value, " GMT") : "UTC")->format("H:i") : "" }}">
																												</div>
																								</div>
																								<div class="form-group row {{ $event->is_recurring_event ? "d-none" : "d-flex" }}">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="end_date">End Date:</label>
																												<div class="col-sm-3">
																																<input type="date" class="form-control" id="end_date" name="end_date"
																																				value="{{ $event->end_date ? $event->end_date->format("Y-m-d") : "" }}">
																												</div>
																												<label class="control-label col-sm-2 align-self-center mb-0" for="end_time">End Time:</label>
																												<div class="col-sm-3">
																																<input type="time" class="form-control" id="end_time" name="end_time"
																																				value="{{ $event->end_time ? $event->end_time->timezone(auth()->user()->timezone ? strtok(auth()->user()->timezone->value, " GMT") : "UTC")->format("H:i") : "" }}">
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="is_recurring_event">Recurring
																																Event:</label>
																												<div class="col-sm-10">
																																<input class="form-check-input" type="checkbox" value="1" id="is_recurring_event"
																																				name="is_recurring_event" {{ $event->is_recurring_event ? "checked" : "" }}>
																												</div>
																								</div>
																								<div id="recurring_block_div"
																												class="form-group row noborder {{ $event->is_recurring_event ? "d-flex" : "d-none" }}">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="">Recurring
																																Type:</label>
																												<div class="col-sm-10">
																																<div id="recurring-error"></div>
																																<div class="form-group row align-items-center">
																																				<div class="col-lg-2 col-md-3 col-sm-12">
																																								<input class="form-check-input" type="radio" value="Daily"
																																												id="recurring_type_daily" name="recurring_type"
																																												{{ !empty($event->recurring_type) && $event->recurring_type->value == "Daily" ? "checked" : "" }}>
																																								<label class="form-check-label" for="recurring_type_daily">
																																												Daily
																																								</label>
																																				</div>
																																				<div class="col-lg-10 col-md-9 col-sm-12 {{ !empty($event->recurring_type) && $event->recurring_type->value == "Daily" ? "d-block" : "d-none" }}"
																																								id="recurring_type_daily_options">
																																								<div class="d-flex align-items-center mb-2">
																																												<input class="form-check-input col-auto" type="radio" value="First"
																																																id="recurring_daily_type_days" name="recurring_daily_type"
																																																{{ !empty($event->recurring_daily_type) && $event->recurring_daily_type->value == "First" ? "checked" : "" }}>
																																												<label class="form-check-label col-8 mx-1" for="recurring_daily_type_days">
																																																<div class="d-flex align-items-center gap-2">
																																																				<span class="col-auto">Every</span> <input type="text"
																																																								class="form-control col-auto"
																																																								style="width: 70px;text-align:center" id="recurring_daily_days"
																																																								name="recurring_daily_days"
																																																								value="{{ $event->recurring_daily_days }}"> <span
																																																								class="col-auto">days</span>
																																																</div>
																																												</label>
																																								</div>
																																								<div>
																																												<input class="form-check-input" type="radio" value="Second"
																																																id="recurring_daily_type_weekday" name="recurring_daily_type"
																																																{{ !empty($event->recurring_daily_type) && $event->recurring_daily_type->value == "Second" ? "checked" : "" }}>
																																												<label class="form-check-label" for="recurring_daily_type_weekday">
																																																Every weekday
																																												</label>
																																								</div>
																																				</div>
																																</div>
																																<div class="form-group row align-items-center">
																																				<div class="col-lg-2 col-md-3 col-sm-12">
																																								<input class="form-check-input" type="radio" value="Weekly"
																																												id="recurring_type_weekly" name="recurring_type"
																																												{{ !empty($event->recurring_type) && $event->recurring_type->value == "Weekly" ? "checked" : "" }}>
																																								<label class="form-check-label" for="recurring_type_weekly">
																																												Weekly
																																								</label>
																																				</div>
																																				<div class="col-lg-10 col-md-9 col-sm-12 {{ !empty($event->recurring_type) && $event->recurring_type->value == "Weekly" ? "d-block" : "d-none" }}"
																																								id="recurring_type_weekly_options">
																																								<div class="d-flex align-items-center mb-2">
																																												<label class="form-check-label col-8 mx-1">
																																																<div class="d-flex align-items-center gap-2">
																																																				<span class="col-auto">Recur every</span> <input type="text"
																																																								class="form-control col-auto"
																																																								style="width: 70px;text-align:center" id="recurring_weekly_weeks"
																																																								name="recurring_weekly_weeks"
																																																								value="{{ $event->recurring_weekly_weeks }}"> <span
																																																								class="col-auto">week(s) on:</span>
																																																</div>
																																												</label>
																																								</div>
																																								<div class="d-flex align-items-center gap-3">
																																												<div class="col-auto">
																																																<input class="form-check-input" type="checkbox" value="true"
																																																				id="recurring_weekly_sunday" name="recurring_weekly_sunday"
																																																				{{ !empty($event->recurring_weekly_sunday) && $event->recurring_weekly_sunday ? "checked" : "" }}>
																																																<label class="form-check-label" for="recurring_weekly_sunday">
																																																				Sun
																																																</label>
																																												</div>
																																												<div class="col-auto">
																																																<input class="form-check-input" type="checkbox" value="true"
																																																				id="recurring_weekly_monday" name="recurring_weekly_monday"
																																																				{{ !empty($event->recurring_weekly_monday) && $event->recurring_weekly_monday ? "checked" : "" }}>
																																																<label class="form-check-label" for="recurring_weekly_monday">
																																																				Mon
																																																</label>
																																												</div>
																																												<div class="col-auto">
																																																<input class="form-check-input" type="checkbox" value="true"
																																																				id="recurring_weekly_tuesday" name="recurring_weekly_tuesday"
																																																				{{ !empty($event->recurring_weekly_tuesday) && $event->recurring_weekly_tuesday ? "checked" : "" }}>
																																																<label class="form-check-label" for="recurring_weekly_tuesday">
																																																				Tue
																																																</label>
																																												</div>
																																												<div class="col-auto">
																																																<input class="form-check-input" type="checkbox" value="true"
																																																				id="recurring_weekly_wednesday" name="recurring_weekly_wednesday"
																																																				{{ !empty($event->recurring_weekly_wednesday) && $event->recurring_weekly_wednesday ? "checked" : "" }}>
																																																<label class="form-check-label" for="recurring_weekly_wednesday">
																																																				Wed
																																																</label>
																																												</div>
																																												<div class="col-auto">
																																																<input class="form-check-input" type="checkbox" value="true"
																																																				id="recurring_weekly_thursday" name="recurring_weekly_thursday"
																																																				{{ !empty($event->recurring_weekly_thursday) && $event->recurring_weekly_thursday ? "checked" : "" }}>
																																																<label class="form-check-label" for="recurring_weekly_thursday">
																																																				Thu
																																																</label>
																																												</div>
																																												<div class="col-auto">
																																																<input class="form-check-input" type="checkbox" value="true"
																																																				id="recurring_weekly_friday" name="recurring_weekly_friday"
																																																				{{ !empty($event->recurring_weekly_friday) && $event->recurring_weekly_friday ? "checked" : "" }}>
																																																<label class="form-check-label" for="recurring_weekly_friday">
																																																				Fri
																																																</label>
																																												</div>
																																												<div class="col-auto">
																																																<input class="form-check-input" type="checkbox" value="true"
																																																				id="recurring_weekly_saturday" name="recurring_weekly_saturday"
																																																				{{ !empty($event->recurring_weekly_saturday) && $event->recurring_weekly_saturday ? "checked" : "" }}>
																																																<label class="form-check-label" for="recurring_weekly_saturday">
																																																				Sat
																																																</label>
																																												</div>
																																								</div>
																																				</div>
																																</div>
																																<div class="form-group row align-items-center">
																																				<div class="col-lg-2 col-md-3 col-sm-12">
																																								<input class="form-check-input" type="radio" value="Monthly"
																																												id="recurring_type_monthly" name="recurring_type"
																																												{{ !empty($event->recurring_type) && $event->recurring_type->value == "Monthly" ? "checked" : "" }}>
																																								<label class="form-check-label" for="recurring_type_monthly">
																																												Monthly
																																								</label>
																																				</div>
																																				<div class="col-lg-10 col-md-9 col-sm-12 {{ !empty($event->recurring_type) && $event->recurring_type->value == "Monthly" ? "d-block" : "d-none" }}"
																																								id="recurring_type_monthly_options">
																																								<div class="d-flex align-items-center mb-2">
																																												<input class="form-check-input col-auto" type="radio" value="First"
																																																id="recurring_monthly_type_days" name="recurring_monthly_type"
																																																{{ !empty($event->recurring_monthly_type) && $event->recurring_monthly_type->value == "First" ? "checked" : "" }}>
																																												<label class="form-check-label col-8 mx-1" for="recurring_monthly_type_days">
																																																<div class="d-flex align-items-center gap-2">
																																																				<span class="col-auto">Day</span> <input type="text"
																																																								class="form-control col-auto"
																																																								style="width: 70px;text-align:center"
																																																								id="recurring_monthly_first_days"
																																																								name="recurring_monthly_first_days"
																																																								value="{{ $event->recurring_monthly_first_days }}"> <span
																																																								class="col-auto">of every</span> <input type="text"
																																																								class="form-control col-auto"
																																																								style="width: 70px;text-align:center"
																																																								id="recurring_monthly_first_months"
																																																								name="recurring_monthly_first_months"
																																																								value="{{ $event->recurring_monthly_first_months }}"> <span
																																																								class="col-auto">month(s)</span>
																																																</div>
																																												</label>
																																								</div>
																																								<div class="d-flex align-items-center">
																																												<input class="form-check-input col-auto" type="radio" value="Second"
																																																id="recurring_monthly_type_months" name="recurring_monthly_type"
																																																{{ !empty($event->recurring_monthly_type) && $event->recurring_monthly_type->value == "Second" ? "checked" : "" }}>
																																												<label class="form-check-label col-8 mx-1"
																																																for="recurring_monthly_type_months">
																																																<div class="d-flex align-items-center gap-2">
																																																				<span class="col-auto">The</span>
																																																				<select class="form-select shadow-none" style="width: 170px"
																																																								name="recurring_monthly_second_type"
																																																								id="recurring_monthly_second_type">
																																																								<option value="First"
																																																												{{ !empty($event->recurring_monthly_second_type) && $event->recurring_monthly_second_type->value == "First" ? "selected" : "" }}>
																																																												First</option>
																																																								<option value="Second"
																																																												{{ !empty($event->recurring_monthly_second_type) && $event->recurring_monthly_second_type->value == "Second" ? "selected" : "" }}>
																																																												Second</option>
																																																								<option value="Third"
																																																												{{ !empty($event->recurring_monthly_second_type) && $event->recurring_monthly_second_type->value == "Third" ? "selected" : "" }}>
																																																												Third</option>
																																																								<option value="Fourth"
																																																												{{ !empty($event->recurring_monthly_second_type) && $event->recurring_monthly_second_type->value == "Fourth" ? "selected" : "" }}>
																																																												Fourth</option>
																																																				</select>
																																																				<select class="form-select shadow-none" style="width: 170px"
																																																								name="recurring_monthly_second_days"
																																																								id="recurring_monthly_second_days">
																																																								<option value="Sunday"
																																																												{{ !empty($event->recurring_monthly_second_days) && $event->recurring_monthly_second_days->value == "Sunday" ? "selected" : "" }}>
																																																												Sunday</option>
																																																								<option value="Monday"
																																																												{{ !empty($event->recurring_monthly_second_days) && $event->recurring_monthly_second_days->value == "Monday" ? "selected" : "" }}>
																																																												Monday</option>
																																																								<option value="Tuesday"
																																																												{{ !empty($event->recurring_monthly_second_days) && $event->recurring_monthly_second_days->value == "Tuesday" ? "selected" : "" }}>
																																																												Tuesday</option>
																																																								<option value="Wednesday"
																																																												{{ !empty($event->recurring_monthly_second_days) && $event->recurring_monthly_second_days->value == "Wednesday" ? "selected" : "" }}>
																																																												Wednesday</option>
																																																								<option value="Thursday"
																																																												{{ !empty($event->recurring_monthly_second_days) && $event->recurring_monthly_second_days->value == "Thursday" ? "selected" : "" }}>
																																																												Thursday</option>
																																																								<option value="Friday"
																																																												{{ !empty($event->recurring_monthly_second_days) && $event->recurring_monthly_second_days->value == "Friday" ? "selected" : "" }}>
																																																												Friday</option>
																																																								<option value="Saturday"
																																																												{{ !empty($event->recurring_monthly_second_days) && $event->recurring_monthly_second_days->value == "Saturday" ? "selected" : "" }}>
																																																												Saturday</option>
																																																				</select>
																																																				<span class="col-auto">of every</span>
																																																				<input type="text" class="form-control col-auto"
																																																								style="width: 70px;text-align:center"
																																																								id="recurring_monthly_second_months"
																																																								name="recurring_monthly_second_months"
																																																								value="{{ $event->recurring_monthly_second_months }}">
																																																				<span class="col-auto">month(s)</span>
																																																</div>
																																												</label>
																																								</div>
																																				</div>
																																</div>
																																<div class="form-group row align-items-center mb-0">
																																				<div class="col-lg-2 col-md-3 col-sm-12">
																																								<input class="form-check-input" type="radio" value="Yearly"
																																												id="recurring_type_yearly" name="recurring_type"
																																												{{ !empty($event->recurring_type) && $event->recurring_type->value == "Yearly" ? "checked" : "" }}>
																																								<label class="form-check-label" for="recurring_type_yearly">
																																												Yearly :
																																								</label>
																																				</div>
																																				<div class="col-lg-10 col-md-9 col-sm-12 {{ !empty($event->recurring_type) && $event->recurring_type->value == "Yearly" ? "d-block" : "d-none" }}"
																																								id="recurring_type_yearly_options">
																																								<div class="d-flex align-items-center mb-2">
																																												<label class="form-check-label col-8 mx-1">
																																																<div class="d-flex align-items-center gap-2">
																																																				<span class="col-auto">Every</span>
																																																				<select class="form-select shadow-none" style="width: 170px"
																																																								name="recurring_yearly_months" id="recurring_yearly_months">
																																																								<option value="1"
																																																												{{ !empty($event->recurring_yearly_months) && $event->recurring_yearly_months->value == 1 ? "selected" : "" }}>
																																																												January</option>
																																																								<option value="2"
																																																												{{ !empty($event->recurring_yearly_months) && $event->recurring_yearly_months->value == 2 ? "selected" : "" }}>
																																																												February</option>
																																																								<option value="3"
																																																												{{ !empty($event->recurring_yearly_months) && $event->recurring_yearly_months->value == 3 ? "selected" : "" }}>
																																																												March</option>
																																																								<option value="4"
																																																												{{ !empty($event->recurring_yearly_months) && $event->recurring_yearly_months->value == 4 ? "selected" : "" }}>
																																																												April</option>
																																																								<option value="5"
																																																												{{ !empty($event->recurring_yearly_months) && $event->recurring_yearly_months->value == 5 ? "selected" : "" }}>
																																																												May</option>
																																																								<option value="6"
																																																												{{ !empty($event->recurring_yearly_months) && $event->recurring_yearly_months->value == 6 ? "selected" : "" }}>
																																																												June</option>
																																																								<option value="7"
																																																												{{ !empty($event->recurring_yearly_months) && $event->recurring_yearly_months->value == 7 ? "selected" : "" }}>
																																																												July</option>
																																																								<option value="8"
																																																												{{ !empty($event->recurring_yearly_months) && $event->recurring_yearly_months->value == 8 ? "selected" : "" }}>
																																																												August</option>
																																																								<option value="9"
																																																												{{ !empty($event->recurring_yearly_months) && $event->recurring_yearly_months->value == 9 ? "selected" : "" }}>
																																																												September</option>
																																																								<option value="10"
																																																												{{ !empty($event->recurring_yearly_months) && $event->recurring_yearly_months->value == 10 ? "selected" : "" }}>
																																																												October</option>
																																																								<option value="11"
																																																												{{ !empty($event->recurring_yearly_months) && $event->recurring_yearly_months->value == 11 ? "selected" : "" }}>
																																																												November</option>
																																																								<option value="12"
																																																												{{ !empty($event->recurring_yearly_months) && $event->recurring_yearly_months->value == 12 ? "selected" : "" }}>
																																																												December</option>
																																																				</select>
																																																				<input type="text" class="form-control col-auto"
																																																								style="width: 70px;text-align:center" id="recurring_yearly_days"
																																																								name="recurring_yearly_days"
																																																								value="{{ $event->recurring_yearly_days }}">
																																																</div>
																																												</label>
																																								</div>
																																				</div>
																																</div>
																												</div>
																								</div>
																								<div id="recurring_block_time_div"
																												class="form-group row {{ $event->is_recurring_event ? "d-flex" : "d-none" }}">
																												<label class="control-label col-sm-2 align-self-center mb-0"
																																for="recurring_end_date">Recurring End Date:</label>
																												<div class="col-sm-3">
																																<input type="date" class="form-control" id="recurring_end_date" name="end_date"
																																				value="{{ $event->is_recurring_event && $event->recurring_end_date ? $event->recurring_end_date->format("Y-m-d") : "" }}">
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="fuzion_id">1FUZION:</label>
																												<div class="col-sm-10">
																																<input type="text" class="form-control" id="fuzion_id" name="fuzion_id"
																																				value="{{ $event->fuzion_id }}">
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="is_active">Active:</label>
																												<div class="col-sm-10">
																																<select class="form-select shadow-none" id="is_active" name="is_active">
																																				<option {{ $event->is_active == 1 ? "selected" : "" }} value="1">YES</option>
																																				<option {{ $event->is_active == 0 ? "selected" : "" }} value="0">No</option>
																																</select>
																												</div>
																								</div>
																								<div class="form-group row noborder">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="is_prep_ready">Is Prep
																																Ready:</label>
																												<div class="col-sm-10">
																																<select class="form-select shadow-none" id="is_prep_ready" name="is_prep_ready">
																																				<option {{ $event->is_prep_ready == 1 ? "selected" : "" }} value="1">YES</option>
																																				<option {{ $event->is_prep_ready == 0 ? "selected" : "" }} value="0">No</option>
																																</select>
																												</div>
																								</div>
																				</div>
																</div>
																<div class="card repeater-writer">
																				<div class="card-header d-flex justify-content-between align-items-center">
																								<div class="header-title">
																												<h4 class="card-title">Assign Details</h4>
																								</div>
																								<div class="col-sm-auto">
																												<button data-repeater-create class="btn btn-primary" type="button">Add Writer</button>
																								</div>
																				</div>
																				<div class="col-sm-12">
																								<div id="writer-error mt-2"></div>
																				</div>
																				<div class="card-body">
																								<div class="col-12">
																												@foreach ($event->writers as $k => $v)
																																<div
																																				class="form-group row align-items-center {{ request()->query("writer_conflict") == $v->writer_id ? "alert alert-danger" : "" }}">
																																				<label class="control-label col-sm-2 align-self-center mb-0">Writer:</label>
																																				<div class="col-sm-4">
																																								<select class="form-select writer-id-input js-example-basic-single shadow-none"
																																												name="writer_id[]">
																																												<option value="">Select Writer</option>
																																												@foreach ($writers as $writer)
																																																<option value="{{ $writer->id }}"
																																																				{{ $v->writer->id == $writer->id ? "selected" : "" }}>
																																																				{{ $writer->name }}</option>
																																												@endforeach
																																								</select>
																																				</div>
																																				<label class="control-label col-sm-2 align-self-center mb-0">Billing Rate: <span
																																												data-bs-toggle="tooltip"
																																												data-bs-original-title="Billing rate should look like 000.00 (no dollar sign)"><i
																																																class="icon">
																																																<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12'
																																																				width='12' height='12' fill='none' stroke='currentColor'>
																																																				<circle cx='6' cy='6' r='4.5' />
																																																				<path stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z' />
																																																				<circle cx='6' cy='8.2' r='.6' fill='currentColor'
																																																								stroke='none' />
																																																</svg>
																																												</i></span></label>
																																				<div class="col-sm-3 billing-rate-div">
																																								<input type="text" class="form-control billing-rate-input"
																																												name="billing_rate[]" value="{{ $v->billing_rate }}">
																																				</div>
																																				<div class="col-sm-1">
																																								<button class="btn btn-danger remove-item-btn"
																																												data-link="{{ route("event.delete_writer.get", $v->id) }}"
																																												type="button">-</button>
																																				</div>
																																</div>
																												@endforeach
																								</div>
																								<div class="col-12" data-repeater-list="writer">
																												<div class="form-group row align-items-center" data-repeater-item>
																																<label class="control-label col-sm-2 align-self-center mb-0">Writer:</label>
																																<div class="col-sm-4">
																																				<select class="form-select writer-id-input shadow-none" name="writer_id[]">
																																								<option selected value="">Select Writer</option>
																																								@foreach ($writers as $writer)
																																												<option value="{{ $writer->id }}">{{ $writer->name }}</option>
																																								@endforeach
																																				</select>
																																</div>
																																<label class="control-label col-sm-2 align-self-center mb-0">Billing Rate: <span
																																								data-bs-toggle="tooltip"
																																								data-bs-original-title="Billing rate should look like 000.00 (no dollar sign)"><i
																																												class="icon">
																																												<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12'
																																																height='12' fill='none' stroke='currentColor'>
																																																<circle cx='6' cy='6' r='4.5' />
																																																<path stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z' />
																																																<circle cx='6' cy='8.2' r='.6' fill='currentColor'
																																																				stroke='none' />
																																												</svg>
																																								</i></span></label>
																																<div class="col-sm-3 billing-rate-div">
																																				<input type="text" class="form-control billing-rate-input" name="billing_rate[]">
																																</div>
																																<div class="col-sm-1">
																																				<button data-repeater-delete class="btn btn-danger" type="button">-</button>
																																</div>
																												</div>
																								</div>
																				</div>
																</div>
																<div class="card">
																				<div class="card-header d-flex justify-content-between align-items-center">
																								<div class="header-title">
																												<h4 class="card-title">Documents</h4>
																								</div>
																				</div>
																				@if ($event->documents->count() > 0)
																								<div class="form-group">
																												<table id="basic-table" class="table-striped mb-0 mt-3 table" role="grid">
																																<thead>
																																				<tr>
																																								<th>Document Name</th>
																																								<th>&nbsp;</th>
																																				</tr>
																																</thead>
																																<tbody>
																																				@foreach ($event->documents as $document)
																																								<tr>
																																												<td>
																																																<div class="d-flex align-items-center">
																																																				<a href="{{ $document->document_link }}"
																																																								download>{{ str_replace("storage/documents/", "", $document->document) }}</a>
																																																</div>
																																												</td>
																																												<td>
																																																@can("download documents")
																																																				<a href="{{ $document->document_link }}" download
																																																								data-bs-toggle="tooltip" data-bs-original-title="Download Document">
																																																								<svg width="32" viewBox="0 0 24 24" fill="none"
																																																												xmlns="http://www.w3.org/2000/svg">
																																																												<path opacity="0.4"
																																																																d="M17.554 7.29614C20.005 7.29614 22 9.35594 22 11.8876V16.9199C22 19.4453 20.01 21.5 17.564 21.5L6.448 21.5C3.996 21.5 2 19.4412 2 16.9096V11.8773C2 9.35181 3.991 7.29614 6.438 7.29614H7.378L17.554 7.29614Z"
																																																																fill="currentColor"></path>
																																																												<path
																																																																d="M12.5464 16.0374L15.4554 13.0695C15.7554 12.7627 15.7554 12.2691 15.4534 11.9634C15.1514 11.6587 14.6644 11.6597 14.3644 11.9654L12.7714 13.5905L12.7714 3.2821C12.7714 2.85042 12.4264 2.5 12.0004 2.5C11.5754 2.5 11.2314 2.85042 11.2314 3.2821L11.2314 13.5905L9.63742 11.9654C9.33742 11.6597 8.85043 11.6587 8.54843 11.9634C8.39743 12.1168 8.32142 12.3168 8.32142 12.518C8.32142 12.717 8.39743 12.9171 8.54643 13.0695L11.4554 16.0374C11.6004 16.1847 11.7964 16.268 12.0004 16.268C12.2054 16.268 12.4014 16.1847 12.5464 16.0374Z"
																																																																fill="currentColor"></path>
																																																								</svg>
																																																				</a>
																																																@endcan
																																																@can("delete documents")
																																																				<a href="#" class="remove-item-btn"
																																																								data-link="{{ route("document.delete.get", $document->id) }}"
																																																								data-bs-toggle="tooltip" data-bs-original-title="Delete Document">
																																																								<svg width="32" viewBox="0 0 24 24" fill="none"
																																																												xmlns="http://www.w3.org/2000/svg">
																																																												<path opacity="0.4"
																																																																d="M19.643 9.48851C19.643 9.5565 19.11 16.2973 18.8056 19.1342C18.615 20.8751 17.4927 21.9311 15.8092 21.9611C14.5157 21.9901 13.2494 22.0001 12.0036 22.0001C10.6809 22.0001 9.38741 21.9901 8.13185 21.9611C6.50477 21.9221 5.38147 20.8451 5.20057 19.1342C4.88741 16.2873 4.36418 9.5565 4.35445 9.48851C4.34473 9.28351 4.41086 9.08852 4.54507 8.93053C4.67734 8.78453 4.86796 8.69653 5.06831 8.69653H18.9388C19.1382 8.69653 19.3191 8.78453 19.4621 8.93053C19.5953 9.08852 19.6624 9.28351 19.643 9.48851Z"
																																																																fill="currentColor"></path>
																																																												<path
																																																																d="M21 5.97686C21 5.56588 20.6761 5.24389 20.2871 5.24389H17.3714C16.7781 5.24389 16.2627 4.8219 16.1304 4.22692L15.967 3.49795C15.7385 2.61698 14.9498 2 14.0647 2H9.93624C9.0415 2 8.26054 2.61698 8.02323 3.54595L7.87054 4.22792C7.7373 4.8219 7.22185 5.24389 6.62957 5.24389H3.71385C3.32386 5.24389 3 5.56588 3 5.97686V6.35685C3 6.75783 3.32386 7.08982 3.71385 7.08982H20.2871C20.6761 7.08982 21 6.75783 21 6.35685V5.97686Z"
																																																																fill="currentColor"></path>
																																																								</svg>
																																																				</a>
																																																@endcan
																																												</td>
																																								</tr>
																																				@endforeach
																																</tbody>
																												</table>
																								</div>
																				@endif
																				<div class="card-body" data-repeater-list="documents">
																								<p><strong>Add Documents </strong></p>
																								<div id="document-error mt-2"></div>
																								<div class="col-12">
																												<input class="form-control filepond" type="file" name="upload" id="upload" multiple
																																data-allow-reorder="true" data-max-file-size="5MB" data-max-files="3">
																								</div>
																				</div>
																				<div class="card-header d-flex justify-content-between">
																								<div class="header-title">
																												<h4 class="card-title">Notes</h4>
																								</div>
																				</div>
																				<div class="card-body">
																								<div class="form-group">
																												<textarea class="form-control" id="notes" name="notes" aria-label="Notes">{{ $event->notes }}</textarea>
																								</div>
																								<button type="submit" class="btn btn-primary" id="submitBtn">Update Event</button>
																								<a href="{{ route("event.paginate.get") }}" class="btn btn-warning" id="submitBtn">Cancel</a>
																				</div>
																</div>
												</form>
								</div>
				</div>
@stop

@section("javascript")
				<script src="{{ asset("assets/js/plugins/jquery.js") }}"></script>
				<script src="{{ asset("assets/js/plugins/jquery.repeater.js") }}"></script>
				<script src="{{ asset("assets/js/plugins/select2.min.js") }}"></script>
				<script src="{{ asset("assets/js/plugins/filepond.min.js") }}"></script>
				<script src="{{ asset("assets/js/plugins/filepond-plugin-image-preview.min.js") }}"></script>
				<script src="{{ asset("assets/js/plugins/filepond-plugin-file-validate-size.min.js") }}"></script>
				<script src="{{ asset("assets/js/plugins/filepond-plugin-image-exif-orientation.min.js") }}"></script>
				<script src="{{ asset("assets/js/plugins/filepond-plugin-file-encode.min.js") }}"></script>

				<script type="text/javascript" nonce="{{ csp_nonce() }}">
								document.addEventListener("keydown", (e) => {
												if ((e.metaKey || e.ctrlKey) && e.key === "s") {
																e.preventDefault();
																document.getElementById('submitBtn').click();
																return false;
												}
								});

								FilePond.registerPlugin(FilePondPluginImagePreview);
								const inputUploadElement = document.querySelector('#upload');
								// Create the FilePond instance
								const pond = FilePond.create(inputUploadElement, {
												allowMultiple: true
								});

								// initialize the validation library
								const validation = new JustValidate('#loginForm', {
												errorFieldCssClass: 'is-invalid',
												focusInvalidField: true,
												lockForm: true,
								});
								// apply rules to form fields
								validation
												.addField('#name', [{
																rule: 'required',
																errorMessage: 'Name is required',
												}, ])
												.addField('#client', [{
																rule: 'required',
																errorMessage: 'Client is required',
												}, ])
												// .addField('#rate_type', [{
												// 																																																																																																																																																																																																																																																																rule: 'required',
												// 																																																																																																																																																																																																																																																																errorMessage: 'Rate Type is required',
												// }, ])
												.addField('#invoice_rate', [{
																rule: 'required',
																errorMessage: 'Invoice Rate is required',
												}, ])
												.addField('#start_date', [{
																rule: 'required',
																errorMessage: 'Start Date is required',
												}, ])
												.addField('#start_time', [{
																rule: 'required',
																errorMessage: 'Start Time is required',
												}, ])
												.addField('#end_date', [{
																rule: 'required',
																errorMessage: 'End Date is required',
												}, ])
												.addField('#end_time', [{
																rule: 'required',
																errorMessage: 'End Time is required',
												}, ])
												.addField('.writer-id-input', [{
																validator: (value, fields) => true
												}, ], {
																errorsContainer: '#writer-error',
												})
												.addField('.billing-rate-input', [{
																validator: (value, fields) => true
												}, ], {
																errorsContainer: '#writer-error',
												})
												.addField('#upload', [{
																validator: (value, fields) => true
												}, ], {
																errorsContainer: '#document-error',
												})
												.addField('#notes', [{
																validator: (value, fields) => true
												}])
												.addField('#fuzion_id', [{
																validator: (value, fields) => true
												}, ])
												.addField('#recurring_end_date', [{
																validator: (value, fields) => true
												}, ])
												.addField('#recurring_type_weekly', [{
																validator: (value, fields) => true
												}, ], {
																errorsContainer: '#recurring-error',
												})
												.onSuccess(async (event) => {
																// event.target.submit();
																var submitBtn = document.getElementById('submitBtn');
																submitBtn.innerHTML = spinner
																submitBtn.disabled = true;
																try {
																				var formData = new FormData();
																				formData.append('name', document.getElementById('name').value)
																				formData.append('fuzion_id', document.getElementById('fuzion_id').value)
																				formData.append('client', document.getElementById('client').value)
																				// formData.append('rate_type', document.getElementById('rate_type').value)
																				formData.append('invoice_rate', document.getElementById('invoice_rate').value)
																				formData.append('start_date', document.getElementById('start_date').value)
																				formData.append('start_time', document.getElementById('start_time').value)
																				formData.append('end_date', document.getElementById('end_date').value)
																				formData.append('end_time', document.getElementById('end_time').value)
																				formData.append('notes', document.getElementById('notes').value)
																				formData.append('is_active', document.getElementById('is_active').value)
																				formData.append('is_prep_ready', document.getElementById('is_prep_ready').value)
																				formData.append('is_recurring_event', document.getElementById('is_recurring_event').checked ? 1 :
																								0)
																				if (document.getElementById('is_recurring_event').checked) {
																								formData.append('recurring_end_date', document.getElementById('recurring_end_date').value)
																								if (document.querySelector('input[name="recurring_type"]:checked')) {
																												formData.append('recurring_type', document.querySelector(
																																'input[name="recurring_type"]:checked').value)
																												if (document.querySelector('input[name="recurring_type"]:checked').value == "Daily") {
																																if (document.querySelector('input[name="recurring_daily_type"]:checked')) {
																																				formData.append('recurring_daily_type', document.querySelector(
																																								'input[name="recurring_daily_type"]:checked').value)
																																				if (document.querySelector('input[name="recurring_daily_type"]:checked') &&
																																								document.querySelector('input[name="recurring_daily_type"]:checked').value ==
																																								"First") {
																																								formData.append('recurring_daily_days', document.getElementById(
																																												'recurring_daily_days').value)
																																				}
																																}
																												}
																												if (document.querySelector('input[name="recurring_type"]:checked').value == "Weekly") {
																																formData.append('recurring_weekly_weeks', document.getElementById(
																																				'recurring_weekly_weeks').value)
																																formData.append('recurring_weekly_sunday', document.getElementById(
																																				'recurring_weekly_sunday').checked ? 1 : 0)
																																formData.append('recurring_weekly_monday', document.getElementById(
																																				'recurring_weekly_monday').checked ? 1 : 0)
																																formData.append('recurring_weekly_tuesday', document.getElementById(
																																				'recurring_weekly_tuesday').checked ? 1 : 0)
																																formData.append('recurring_weekly_wednesday', document.getElementById(
																																				'recurring_weekly_wednesday').checked ? 1 : 0)
																																formData.append('recurring_weekly_thursday', document.getElementById(
																																				'recurring_weekly_thursday').checked ? 1 : 0)
																																formData.append('recurring_weekly_friday', document.getElementById(
																																				'recurring_weekly_friday').checked ? 1 : 0)
																																formData.append('recurring_weekly_saturday', document.getElementById(
																																				'recurring_weekly_saturday').checked ? 1 : 0)
																												}
																												if (document.querySelector('input[name="recurring_type"]:checked').value == "Monthly") {
																																if (document.querySelector('input[name="recurring_monthly_type"]:checked')) {
																																				formData.append('recurring_monthly_type', document.querySelector(
																																								'input[name="recurring_monthly_type"]:checked').value)
																																				if (document.querySelector('input[name="recurring_monthly_type"]:checked') &&
																																								document.querySelector('input[name="recurring_monthly_type"]:checked').value ==
																																								"First") {
																																								formData.append('recurring_monthly_first_days', document.getElementById(
																																												'recurring_monthly_first_days').value)
																																								formData.append('recurring_monthly_first_months', document.getElementById(
																																												'recurring_monthly_first_months').value)
																																				}
																																				if (document.querySelector('input[name="recurring_monthly_type"]:checked').value ==
																																								"Second") {
																																								formData.append('recurring_monthly_second_type', document.getElementById(
																																												'recurring_monthly_second_type').value)
																																								formData.append('recurring_monthly_second_days', document.getElementById(
																																												'recurring_monthly_second_days').value)
																																								formData.append('recurring_monthly_second_months', document.getElementById(
																																												'recurring_monthly_second_months').value)
																																				}
																																}
																												}
																												if (document.querySelector('input[name="recurring_type"]:checked').value == "Yearly") {
																																formData.append('recurring_yearly_months', document.getElementById(
																																				'recurring_yearly_months').value)
																																formData.append('recurring_yearly_days', document.getElementById(
																																				'recurring_yearly_days').value)
																												}
																								}
																				}
																				const writer_input_selector = document.querySelectorAll('.writer-id-input');
																				const billing_rate_input_selector = document.querySelectorAll('.billing-rate-input');
																				for (let writer_index = 0; writer_index < writer_input_selector.length; writer_index++) {
																								if (writer_input_selector[writer_index].value.length > 0) {
																												formData.append('writer_ids[]', writer_input_selector[writer_index].value)
																								}
																				}
																				for (let billing_index = 0; billing_index < billing_rate_input_selector.length; billing_index++) {
																								if (billing_rate_input_selector[billing_index].value.length > 0) {
																												formData.append('billing_rates[]', billing_rate_input_selector[billing_index].value)
																								}
																				}
																				for (let document_index = 0; document_index < pond.getFiles().length; document_index++) {
																								formData.append('documents[]', pond.getFiles()[document_index].file)
																				}

																				const response = await axios.post('{{ route("event.update.post", $event->id) }}', formData)
																				successToast(response.data.message)
																				event.target.reset();
																				@if (!empty(request()->query("writer_conflict")))
																								setInterval(window.location.replace("{{ route("report.conflict.view.get") }}"), 1500);
																				@else
																								setInterval(window.location.replace("{{ route("event.paginate.get") }}"), 1500);
																				@endif
																} catch (error) {
																				if (error?.response?.data?.errors?.name) {
																								validation.showErrors({
																												'#name': error?.response?.data?.errors?.name[0]
																								})
																				}
																				if (error?.response?.data?.errors?.fuzion_id) {
																								validation.showErrors({
																												'#fuzion_id': error?.response?.data?.errors?.fuzion_id[0]
																								})
																				}
																				if (error?.response?.data?.errors?.client) {
																								validation.showErrors({
																												'#client': error?.response?.data?.errors?.client[0]
																								})
																				}
																				// if (error?.response?.data?.errors?.rate_type) {
																				// 																																																																																																																																																																																																																																																																validation.showErrors({
																				// 																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																'#rate_type': error?.response?.data?.errors?.rate_type[0]
																				// 																																																																																																																																																																																																																																																																})
																				// }
																				if (error?.response?.data?.errors?.invoice_rate) {
																								validation.showErrors({
																												'#invoice_rate': error?.response?.data?.errors?.invoice_rate[0]
																								})
																				}
																				if (error?.response?.data?.errors?.start_date) {
																								validation.showErrors({
																												'#start_date': error?.response?.data?.errors?.start_date[0]
																								})
																				}
																				if (error?.response?.data?.errors?.start_time) {
																								validation.showErrors({
																												'#start_time': error?.response?.data?.errors?.start_time[0]
																								})
																				}
																				if (error?.response?.data?.errors?.recurring_end_date) {
																								validation.showErrors({
																												'#recurring_end_date': error?.response?.data?.errors?.recurring_end_date[0]
																								})
																				}
																				if (error?.response?.data?.errors?.end_date) {
																								validation.showErrors({
																												'#end_date': error?.response?.data?.errors?.end_date[0]
																								})
																				}
																				if (error?.response?.data?.errors?.end_time) {
																								validation.showErrors({
																												'#end_time': error?.response?.data?.errors?.end_time[0]
																								})
																				}
																				if (error?.response?.data?.errors?.recurring_daily_type) {
																								validation.showErrors({
																												'#recurring_type_weekly': error?.response?.data?.errors?.recurring_daily_type[0]
																								})
																				}
																				if (error?.response?.data?.errors?.recurring_daily_days) {
																								validation.showErrors({
																												'#recurring_type_weekly': error?.response?.data?.errors?.recurring_daily_days[0]
																								})
																				}
																				if (error?.response?.data?.errors?.recurring_weekly_weeks) {
																								validation.showErrors({
																												'#recurring_type_weekly': error?.response?.data?.errors?.recurring_weekly_weeks[0]
																								})
																				}
																				if (error?.response?.data?.errors?.recurring_monthly_type) {
																								validation.showErrors({
																												'#recurring_type_weekly': error?.response?.data?.errors?.recurring_monthly_type[0]
																								})
																				}
																				if (error?.response?.data?.errors?.recurring_monthly_first_days) {
																								validation.showErrors({
																												'#recurring_type_weekly': error?.response?.data?.errors
																																?.recurring_monthly_first_days[0]
																								})
																				}
																				if (error?.response?.data?.errors?.recurring_monthly_first_months) {
																								validation.showErrors({
																												'#recurring_type_weekly': error?.response?.data?.errors
																																?.recurring_monthly_first_months[0]
																								})
																				}
																				if (error?.response?.data?.errors?.recurring_monthly_second_type) {
																								validation.showErrors({
																												'#recurring_type_weekly': error?.response?.data?.errors
																																?.recurring_monthly_second_type[0]
																								})
																				}
																				if (error?.response?.data?.errors?.recurring_monthly_second_days) {
																								validation.showErrors({
																												'#recurring_type_weekly': error?.response?.data?.errors
																																?.recurring_monthly_second_days[0]
																								})
																				}
																				if (error?.response?.data?.errors?.recurring_monthly_second_months) {
																								validation.showErrors({
																												'#recurring_type_weekly': error?.response?.data?.errors
																																?.recurring_monthly_second_months[0]
																								})
																				}
																				if (error?.response?.data?.errors?.recurring_yearly_months) {
																								validation.showErrors({
																												'#recurring_type_weekly': error?.response?.data?.errors?.recurring_yearly_months[0]
																								})
																				}
																				if (error?.response?.data?.errors?.recurring_yearly_days) {
																								validation.showErrors({
																												'#recurring_type_weekly': error?.response?.data?.errors?.recurring_yearly_days[0]
																								})
																				}
																				if (error?.response?.data?.errors?.recurring_weekly_sunday) {
																								validation.showErrors({
																												'#recurring_type_weekly': error?.response?.data?.errors?.recurring_weekly_sunday[0]
																								})
																				}
																				if (error?.response?.data?.errors?.recurring_weekly_monday) {
																								validation.showErrors({
																												'#recurring_type_weekly': error?.response?.data?.errors?.recurring_weekly_monday[0]
																								})
																				}
																				if (error?.response?.data?.errors?.recurring_weekly_tuesday) {
																								validation.showErrors({
																												'#recurring_type_weekly': error?.response?.data?.errors?.recurring_weekly_tuesday[
																																0]
																								})
																				}
																				if (error?.response?.data?.errors?.recurring_weekly_wednesday) {
																								validation.showErrors({
																												'#recurring_type_weekly': error?.response?.data?.errors
																																?.recurring_weekly_wednesday[0]
																								})
																				}
																				if (error?.response?.data?.errors?.recurring_weekly_thursday) {
																								validation.showErrors({
																												'#recurring_type_weekly': error?.response?.data?.errors?.recurring_weekly_thursday[
																																0]
																								})
																				}
																				if (error?.response?.data?.errors?.recurring_weekly_friday) {
																								validation.showErrors({
																												'#recurring_type_weekly': error?.response?.data?.errors?.recurring_weekly_friday[0]
																								})
																				}
																				if (error?.response?.data?.errors?.recurring_weekly_sunday) {
																								validation.showErrors({
																												'#recurring_type_weekly': error?.response?.data?.errors?.recurring_weekly_sunday[0]
																								})
																				}
																				if (error?.response?.data?.errors?.notes) {
																								validation.showErrors({
																												'#notes': error?.response?.data?.errors?.notes[0]
																								})
																				}
																				if (error?.response?.data?.errors?.recurring_type) {
																								validation.showErrors({
																												'#recurring_type_weekly': error?.response?.data?.errors?.recurring_type[0]
																								})
																				}
																				if (error?.response?.data?.errors?.documents) {
																								validation.showErrors({
																												'#upload': error?.response?.data?.errors?.documents[0]
																								})
																				}
																				if (error?.response?.data?.errors?.writer_ids) {
																								validation.showErrors({
																												'.writer-id-input': error?.response?.data?.errors?.writer_ids[0]
																								})
																				}
																				if (error?.response?.data?.errors?.billing_rates) {
																								validation.showErrors({
																												'.billing-rate-input': error?.response?.data?.errors?.billing_rates[0]
																								})
																				}
																				if (error?.response?.data?.message) {
																								errorToast(error?.response?.data?.message)
																				}
																} finally {
																				submitBtn.innerHTML = `
            Update Event
            `
																				submitBtn.disabled = false;
																}
												});

								document.getElementById('is_recurring_event').addEventListener("change", function() {
												if (document.getElementById('is_recurring_event').checked) {
																document.getElementById('recurring_block_div').classList.add('d-flex');
																document.getElementById('recurring_block_div').classList.remove('d-none');
																document.getElementById('recurring_block_time_div').classList.add('d-flex');
																document.getElementById('recurring_block_time_div').classList.remove('d-none');
												} else {
																document.getElementById('recurring_block_div').classList.add('d-none');
																document.getElementById('recurring_block_div').classList.remove('d-flex');
																document.getElementById('recurring_block_time_div').classList.add('d-none');
																document.getElementById('recurring_block_time_div').classList.remove('d-flex');
												}
								});


								document.getElementById('recurring_type_daily').addEventListener("change", function() {
												if (document.getElementById('recurring_type_daily').checked) {
																document.getElementById('recurring_type_daily_options').classList.add('d-block');
																document.getElementById('recurring_type_daily_options').classList.remove('d-none');
																document.getElementById('recurring_type_yearly_options').classList.add('d-none');
																document.getElementById('recurring_type_yearly_options').classList.remove('d-block');
																document.getElementById('recurring_type_monthly_options').classList.add('d-none');
																document.getElementById('recurring_type_monthly_options').classList.remove('d-block');
																document.getElementById('recurring_type_weekly_options').classList.add('d-none');
																document.getElementById('recurring_type_weekly_options').classList.remove('d-block');
												}
								});

								document.getElementById('recurring_type_weekly').addEventListener("change", function() {
												if (document.getElementById('recurring_type_weekly').checked) {
																document.getElementById('recurring_type_weekly_options').classList.add('d-block');
																document.getElementById('recurring_type_weekly_options').classList.remove('d-none');
																document.getElementById('recurring_type_yearly_options').classList.add('d-none');
																document.getElementById('recurring_type_yearly_options').classList.remove('d-block');
																document.getElementById('recurring_type_monthly_options').classList.add('d-none');
																document.getElementById('recurring_type_monthly_options').classList.remove('d-block');
																document.getElementById('recurring_type_daily_options').classList.add('d-none');
																document.getElementById('recurring_type_daily_options').classList.remove('d-block');
												}
								});

								document.getElementById('recurring_type_monthly').addEventListener("change", function() {
												if (document.getElementById('recurring_type_monthly').checked) {
																document.getElementById('recurring_type_monthly_options').classList.add('d-block');
																document.getElementById('recurring_type_monthly_options').classList.remove('d-none');
																document.getElementById('recurring_type_yearly_options').classList.add('d-none');
																document.getElementById('recurring_type_yearly_options').classList.remove('d-block');
																document.getElementById('recurring_type_weekly_options').classList.add('d-none');
																document.getElementById('recurring_type_weekly_options').classList.remove('d-block');
																document.getElementById('recurring_type_daily_options').classList.add('d-none');
																document.getElementById('recurring_type_daily_options').classList.remove('d-block');
												}
								});

								document.getElementById('recurring_type_yearly').addEventListener("change", function() {
												if (document.getElementById('recurring_type_yearly').checked) {
																document.getElementById('recurring_type_yearly_options').classList.add('d-block');
																document.getElementById('recurring_type_yearly_options').classList.remove('d-none');
																document.getElementById('recurring_type_monthly_options').classList.add('d-none');
																document.getElementById('recurring_type_monthly_options').classList.remove('d-block');
																document.getElementById('recurring_type_weekly_options').classList.add('d-none');
																document.getElementById('recurring_type_weekly_options').classList.remove('d-block');
																document.getElementById('recurring_type_daily_options').classList.add('d-none');
																document.getElementById('recurring_type_daily_options').classList.remove('d-block');
												}
								});

								document.getElementById('start_date').addEventListener("change", function() {
												document.getElementById('end_date').value = document.getElementById('start_date').value
								});

								(function($) {
												$('#client').select2();
												$('.js-example-basic-single').select2();
												$('.writer-id-input').on('input', function() {
																const data = @json($writers);
																const event = data.filter((item) => item.id == $(this).val());
																if (event.length > 0) {
																				$(this).parent().parent().find('.billing-rate-div .billing-rate-input').val(event[0]
																								.member_profile_created_by_auth.billing_rate);
																} else {
																				$(this).parent().parent().find('.billing-rate-div .billing-rate-input').val('');
																}
												});
												$(document).ready(function() {
																$('.repeater-writer').repeater({
																				initEmpty: true,
																				isFirstItemUndeletable: true,
																				show: function() {
																								var dd = $(this).children().children();
																								$(this).slideDown();
																								$('.writer-id-input').on('input', function() {
																												const data = @json($writers);
																												const event = data.filter((item) => item.id == $(this).val());
																												if (event.length > 0) {
																																$(this).parent().parent().find(
																																				'.billing-rate-div .billing-rate-input').val(event[0]
																																				.member_profile_created_by_auth.billing_rate);
																												} else {
																																$(this).parent().parent().find(
																																				'.billing-rate-div .billing-rate-input').val('');
																												}
																								});
																								$('select[name="' + dd[0].attributes.name.nodeValue + '"]').select2();
																				},
																				hide: function(deleteElement) {
																								iziToast.question({
																												timeout: 20000,
																												close: false,
																												overlay: true,
																												displayMode: 'once',
																												id: 'question',
																												zindex: 999,
																												title: 'Hey',
																												message: 'Are you sure about that?',
																												position: 'center',
																												buttons: [
																																['<button><b>YES</b></button>', function(instance, toast) {

																																				instance.hide({
																																								transitionOut: 'fadeOut'
																																				}, toast, 'button');
																																				$(this).slideUp(deleteElement);

																																}, true],
																																['<button>NO</button>', function(instance, toast) {

																																				instance.hide({
																																								transitionOut: 'fadeOut'
																																				}, toast, 'button');

																																}],
																												],
																												onClosing: function(instance, toast, closedBy) {
																																console.info('Closing | closedBy: ' + closedBy);
																												},
																												onClosed: function(instance, toast, closedBy) {
																																console.info('Closed | closedBy: ' + closedBy);
																												}
																								});
																				},
																				ready: function(setIndexes) {}
																});
												});
								})(jQuery);
				</script>

@stop
