@extends("layouts.main")

@section("css")
				<style>
								thead,
								tbody,
								tfoot,
								tr,
								td,
								th {
												/* white-space: pre-wrap; */
								}
				</style>
@stop

@section("content")
				<div class="row">
								<div class="col-md-12 col-lg-12">
												<div class="row">
																<div class="col-12 d-flex justify-content-end mb-3 gap-2">
																				<a href="{{ route("report.quickbook.print.get") }}?{{ http_build_query(request()->query()) }}"
																								target="_blank" class="btn btn-primary">Print</a>
																				<a href="{{ route("dashboard.get") }}" class="btn btn-primary">Dashboard</a>
																</div>
																<div class="col-md-12 col-lg-12">
																				<div class="card overflow-hidden" data-aos="fade-up" data-aos-delay="600">
																								<div class="card-header d-flex justify-content-between flex-wrap">
																												<div class="header-title">
																																<h4 class="card-title mb-2">Export To Quickbooks</h4>
																												</div>
																												<div class="d-flex align-items-middle">
																												</div>
																												<form action="{{ route("report.quickbook.view.get") }}" method="GET"
																																class="d-flex align-items-center filterset">
																																<div class="form-group">
																																				<label class="form-label" for="colFormLabelSm">Writer</label>
																																				<select class="form-select writer-id-input shadow-none" name="filter[has_writer]">
																																								<option {{ empty(request()->query("filter")["has_writer"]) ? "selected" : "" }}
																																												value="">Select Writer</option>
																																								@foreach ($writers as $writer)
																																												<option value="{{ $writer->id }}"
																																																{{ !empty(request()->query("filter")["has_writer"]) && request()->query("filter")["has_writer"] == $writer->id ? "selected" : "" }}>
																																																{{ $writer->name }}</option>
																																								@endforeach
																																				</select>
																																</div>
																																<div class="form-group">
																																				<label class="form-label" for="colFormLabelSm">Client</label>
																																				<select class="form-select shadow-none" id="client" name="filter[has_client]">
																																								<option {{ empty(request()->query("filter")["has_client"]) ? "selected" : "" }}
																																												value="">Select Client</option>
																																								@foreach ($clients as $client)
																																												<option value="{{ $client->id }}"
																																																{{ !empty(request()->query("filter")["has_client"]) && request()->query("filter")["has_client"] == $client->id ? "selected" : "" }}>
																																																{{ $client->name }}</option>
																																								@endforeach
																																				</select>
																																</div>
																																<div class="form-group">
																																				<label class="form-label" for="colFormLabelSm">Start Date</label>
																																				<input type="date" class="form-control" id="start_date" name="filter[has_start_date]"
																																								value="{{ request()->query("filter")["has_start_date"] ?? "" }}">
																																</div>
																																<div class="form-group">
																																				<label class="form-label" for="colFormLabelSm">End Date Date</label>
																																				<input type="date" class="form-control" id="end_date" name="filter[has_end_date]"
																																								value="{{ request()->query("filter")["has_end_date"] ?? "" }}">
																																</div>
																																<div class="form-group">
																																				<br />
																																				<button class="btn btn-link btn-soft-primary">
																																								Filter
																																				</button>
																																				<a href="{{ route("report.quickbook.view.get") }}" class="btn btn-link btn-soft-light">
																																								Reset
																																				</a>
																																</div>
																												</form>
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
																																																												<td> {{ $item->invoice_rate }} $ / hr </td>
																																																												<td>
																																																																{{ $item->invoice_rate * $diff }} $
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
																																																								<td> {{ $item->invoice_rate }} $ / hr </td>
																																																								<td>
																																																												{{ $item->invoice_rate * $diff }} $
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
																																{{-- <div class="card-header">
                                    {{$data->onEachSide(5)->links()}}
                                </div> --}}
																												</div>
																												<div style="padding: 20px; text-align: right; ">
																																<a href="{{ route("report.quickbook.excel.get", request()->query()) }}"
																																				class="btn btn-primary">
																																				<svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none"
																																								xmlns="http://www.w3.org/2000/svg">
																																								<path opacity="0.4"
																																												d="M2 7.916V16.084C2 19.623 4.276 22 7.665 22H16.335C19.724 22 22 19.623 22 16.084V7.916C22 4.378 19.723 2 16.334 2H7.665C4.276 2 2 4.378 2 7.916Z"
																																												fill="currentColor"></path>
																																								<path
																																												d="M7.72033 12.8555L11.4683 16.6205C11.7503 16.9035 12.2493 16.9035 12.5323 16.6205L16.2803 12.8555C16.5723 12.5615 16.5713 12.0865 16.2773 11.7945C15.9833 11.5025 15.5093 11.5025 15.2163 11.7965L12.7493 14.2735V7.91846C12.7493 7.50346 12.4133 7.16846 11.9993 7.16846C11.5853 7.16846 11.2493 7.50346 11.2493 7.91846V14.2735L8.78333 11.7965C8.63633 11.6495 8.44433 11.5765 8.25133 11.5765C8.06033 11.5765 7.86833 11.6495 7.72233 11.7945C7.42933 12.0865 7.42833 12.5615 7.72033 12.8555Z"
																																												fill="currentColor"></path>
																																				</svg> Export
																																</a>
																												</div>
																								</div>
																				</div>
																</div>
												</div>
								</div>
				</div>
@stop
