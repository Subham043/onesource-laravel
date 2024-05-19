@extends("layouts.print")

@section("content")
				<div class="row">
								<div class="col-md-12 col-lg-12">
												<div class="row">
																<div class="col-md-12 col-lg-12">
																				<div class="card overflow-hidden" data-aos="fade-up" data-aos-delay="600">
																								<div class="card-header d-flex justify-content-between flex-wrap">
																												<div class="header-title">
																																<h4 class="card-title mb-2">Export To Quickbooks</h4>
																												</div>
																								</div>
																								<div class="card-body p-0">
																												<div class="table-responsive mt-4">
																																<table id="basic-table" class="mb-0 table">
																																				<thead>
																																								<tr>
																																												<th>Event ID</th>
																																												<th>Event</th>
																																												<th>Client</th>
																																												<th>Writer</th>
																																												<th>Date</th>
																																												<th>Start Time</th>
																																												<th>End Time</th>
																																												<th>Total Time</th>
																																												<th>Billing Rate</th>
																																												<th>Total</th>
																																								</tr>
																																				</thead>
																																				@if ($data->count() > 0)
																																								<tbody>
																																												@foreach ($data as $key => $item)
																																																@if ($item->is_recurring_event)
																																																				@foreach ($item->event_repeated_date as $r_date)
																																																								<tr>
																																																												<td rowspan="{{ $item->writers->count() + 1 }}">
																																																																<div class="d-flex align-items-center">
																																																																				<a
																																																																								href="{{ route("event.view.get", $item->id) }}">EVD{{ $item->id }}</a>
																																																																</div>
																																																												</td>
																																																												<td rowspan="{{ $item->writers->count() + 1 }}">
																																																																<div class="iq-media-group iq-media-group-1">
																																																																				<a
																																																																								href="{{ route("event.view.get", $item->id) }}">{{ $item->name }}</a>
																																																																</div>
																																																												</td>
																																																												<td>{{ $item->client->name }}</td>
																																																												<td>&nbsp;</td>
																																																												<td rowspan="{{ $item->writers->count() + 1 }}">
																																																																{{ date("M d Y", strtotime(str_replace("T05:30:00.000Z", "", $r_date))) }}
																																																												</td>
																																																												<td rowspan="{{ $item->writers->count() + 1 }}">
																																																																{{ $item->start_time->addMinute($item->client->setup_time)->format("h:i a") }}
																																																												</td>
																																																												<td rowspan="{{ $item->writers->count() + 1 }}">
																																																																{{ $item->end_time->format("h:i a") }}</td>
																																																												<td rowspan="{{ $item->writers->count() + 1 }}">
																																																																@php
																																																																				$start = new Carbon\Carbon(
																																																																				    $item->start_date->format("Y-m-d") .
																																																																				        " " .
																																																																				        $item->start_time
																																																																				            ->addMinute($item->client->setup_time)
																																																																				            ->format("H:i:s"),
																																																																				);
																																																																				$end = new Carbon\Carbon(
																																																																				    $item->end_date->format("Y-m-d") .
																																																																				        " " .
																																																																				        $item->end_time->format("H:i:s"),
																																																																				);
																																																																				$diff = $start->diffInHours($end);
																																																																@endphp
																																																																{{ $diff }} Hour
																																																												</td>
																																																												<td> {{ $item->rate_type && $item->rate_type->value == "Onsite" ? $item->client->onsite_billing_rate : $item->client->remote_billing_rate }}
																																																																$ / hr </td>
																																																												<td>
																																																																{{ $item->rate_type && $item->rate_type->value == "Onsite" ? $item->client->onsite_billing_rate : $item->client->remote_billing_rate * $diff }}
																																																																$
																																																												</td>
																																																								</tr>
																																																								@foreach ($item->writers as $k => $v)
																																																												<tr>
																																																																<td> </td>
																																																																<td>{{ $v->writer->name }}</td>

																																																																<td> {{ $v->billing_rate }} $ / hr </td>
																																																																<td>
																																																																				{{ $v->billing_rate * $diff }} $
																																																																</td>
																																																												</tr>
																																																								@endforeach
																																																				@endforeach
																																																@else
																																																				<tr>
																																																								<td rowspan="{{ $item->writers->count() + 1 }}">
																																																												<div class="d-flex align-items-center">
																																																																<a
																																																																				href="{{ route("event.view.get", $item->id) }}">EVD{{ $item->id }}</a>
																																																												</div>
																																																								</td>
																																																								<td rowspan="{{ $item->writers->count() + 1 }}">
																																																												<div class="iq-media-group iq-media-group-1">
																																																																<a
																																																																				href="{{ route("event.view.get", $item->id) }}">{{ $item->name }}</a>
																																																												</div>
																																																								</td>
																																																								<td>{{ $item->client->name }}</td>
																																																								<td>&nbsp;</td>
																																																								<td rowspan="{{ $item->writers->count() + 1 }}">
																																																												{{ $item->start_date->format("M d Y") }}
																																																								</td>
																																																								<td rowspan="{{ $item->writers->count() + 1 }}">
																																																												{{ $item->start_time->addMinute($item->client->setup_time)->format("h:i a") }}
																																																								</td>
																																																								<td rowspan="{{ $item->writers->count() + 1 }}">
																																																												{{ $item->end_time->format("h:i a") }}</td>
																																																								<td rowspan="{{ $item->writers->count() + 1 }}">
																																																												@php
																																																																$start = new Carbon\Carbon(
																																																																    $item->start_date->format("Y-m-d") .
																																																																        " " .
																																																																        $item->start_time
																																																																            ->addMinute($item->client->setup_time)
																																																																            ->format("H:i:s"),
																																																																);
																																																																$end = new Carbon\Carbon(
																																																																    $item->end_date->format("Y-m-d") .
																																																																        " " .
																																																																        $item->end_time->format("H:i:s"),
																																																																);
																																																																$diff = $start->diffInHours($end);
																																																												@endphp
																																																												{{ $diff }} Hour
																																																								</td>
																																																								<td> {{ $item->rate_type && $item->rate_type->value == "Onsite" ? $item->client->onsite_billing_rate : $item->client->remote_billing_rate }}
																																																												$ / hr </td>
																																																								<td>
																																																												{{ $item->rate_type && $item->rate_type->value == "Onsite" ? $item->client->onsite_billing_rate : $item->client->remote_billing_rate * $diff }}
																																																												$
																																																								</td>
																																																				</tr>
																																																				@foreach ($item->writers as $k => $v)
																																																								<tr>
																																																												<td> </td>
																																																												<td>{{ $v->writer->name }}</td>

																																																												<td> {{ $v->billing_rate }} $ / hr </td>
																																																												<td>
																																																																{{ $v->billing_rate * $diff }} $
																																																												</td>
																																																								</tr>
																																																				@endforeach
																																																@endif
																																												@endforeach
																																								</tbody>
																																				@else
																																								<tbody>
																																												<tr>
																																																<td colspan="10">
																																																				<p class="text-center">No data available</p>
																																																</td>
																																												</tr>
																																								</tbody>
																																				@endif
																																</table>
																												</div>
																								</div>
																				</div>
																</div>
												</div>
								</div>
				</div>
@stop
