@extends("layouts.print")

@section("content")
				<div class="row">
								<div class="col-md-12 col-lg-12">
												<div class="row">
																<div class="col-md-12 col-lg-12">
																				<div class="card overflow-hidden" data-aos="fade-up" data-aos-delay="600">
																								<div class="card-header d-flex justify-content-between align-items-center flex-wrap">
																												<div class="header-title">
																																<h4 class="card-title mb-2">Calendar Events</h4>
																												</div>
																								</div>
																								<div class="card-body p-0">
																												@php $count= 0; @endphp
																												@if ($events->count() > 0)
																																<div class="table-responsive mt-4">
																																				<table id="basic-table" class="table-striped mb-0 table" role="grid">
																																								<thead>
																																												<tr>
																																																@can("edit events")
																																																				<th style="max-width: 10px;">
																																																								<input type="checkbox" class="form-check-input" id="checkAll"
																																																												data-bs-toggle="tooltip" data-bs-original-title="Select All">
																																																				</th>
																																																@endcan
																																																<th>Event ID</th>
																																																<th style="max-width: 170px; width: 170px;text-wrap:balance;">Event</th>
																																																<th style="max-width: 170px; width: 170px;text-wrap:balance;">Client</th>
																																																<th style="max-width: 170px; width: 170px;text-wrap:balance;">Writer</th>
																																																<th>Start Date</th>
																																																<th>Start Time</th>
																																																<th>End Date</th>
																																																<th>End Time</th>
																																																<th>1FUZION</th>
																																												</tr>
																																								</thead>
																																								<tbody>
																																												@foreach ($events as $item)
																																																@if ($item->is_recurring_event)
																																																				@php $count++; @endphp
																																																				<tr>
																																																								@can("edit events")
																																																												<td>
																																																																<div class="d-flex align-items-center">
																																																																				<input type="checkbox"
																																																																								class="form-check-input event-checkbox"
																																																																								value="{{ $item->id }}" data-bs-toggle="tooltip"
																																																																								data-bs-original-title="Select EVD{{ $item->id }}">
																																																																</div>
																																																												</td>
																																																								@endcan
																																																								<td>
																																																												<div class="d-flex align-items-center">
																																																																<a
																																																																				href="{{ route("event.view.get", $item->id) }}">EVD{{ $item->id }}</a>
																																																												</div>
																																																								</td>
																																																								<td style="max-width: 170px; width: 170px;text-wrap:balance;">
																																																												<div class="iq-media-group iq-media-group-1">
																																																																<a href="{{ route("event.view.get", $item->id) }}">
																																																																				{{ $item->name }}</a>
																																																												</div>
																																																								</td>
																																																								<td style="max-width: 170px; width: 170px;text-wrap:balance;">
																																																												<div class="iq-media-group iq-media-group-1">
																																																																{{ $item->client->name }}
																																																												</div>
																																																								</td>
																																																								<td style="max-width: 170px; width: 170px;text-wrap:balance;">
																																																												@foreach ($item->writers as $k => $v)
																																																																{!! $k + 1 == count($item->writers) ? $v->writer->name : $v->writer->name . "<br/> " !!}
																																																												@endforeach
																																																								</td>
																																																								<td>
																																																												{{ $item->start_date->format("M d Y") }}
																																																								</td>
																																																								<td>{{ $item->start_time->format("h:i a") }}</td>
																																																								<td>
																																																												{{ $item->end_date->format("M d Y") }}
																																																								</td>
																																																								<td>{{ $item->end_time->format("h:i a") }}</td>
																																																								<td>{{ $item->fuzion_id }}</td>
																																																				</tr>
																																																@else
																																																				@php $count++; @endphp
																																																				<tr>
																																																								@can("edit events")
																																																												<td>
																																																																<div class="d-flex align-items-center">
																																																																				<input type="checkbox"
																																																																								class="form-check-input event-checkbox"
																																																																								value="{{ $item->id }}" data-bs-toggle="tooltip"
																																																																								data-bs-original-title="Select EVD{{ $item->id }}">
																																																																</div>
																																																												</td>
																																																								@endcan
																																																								<td>
																																																												<div class="d-flex align-items-center">
																																																																<a
																																																																				href="{{ route("event.view.get", $item->id) }}">EVD{{ $item->id }}</a>
																																																												</div>
																																																								</td>
																																																								<td style="max-width: 170px; width: 170px;text-wrap:balance;">
																																																												<div class="iq-media-group iq-media-group-1">
																																																																<a href="{{ route("event.view.get", $item->id) }}">
																																																																				{{ $item->name }}</a>
																																																												</div>
																																																								</td>
																																																								<td style="max-width: 170px; width: 170px;text-wrap:balance;">
																																																												<div class="iq-media-group iq-media-group-1">
																																																																{{ $item->client->name }}
																																																												</div>
																																																								</td>
																																																								<td style="max-width: 170px; width: 170px;text-wrap:balance;">
																																																												@foreach ($item->writers as $k => $v)
																																																																{!! $k + 1 == count($item->writers) ? $v->writer->name : $v->writer->name . "<br/> " !!}
																																																												@endforeach
																																																								</td>
																																																								<td>
																																																												{{ $item->start_date->format("M d Y") }}
																																																								</td>
																																																								<td>{{ $item->start_time->format("h:i a") }}</td>
																																																								<td>
																																																												{{ $item->end_date->format("M d Y") }}
																																																								</td>
																																																								<td>{{ $item->end_time->format("h:i a") }}</td>
																																																								<td>{{ $item->fuzion_id }}</td>
																																																				</tr>
																																																@endif
																																												@endforeach
																																								</tbody>
																																				</table>
																																</div>
																												@else
																																<p class="text-center">No data available</p>
																												@endif
																												@if ($count == 0)
																																<p class="m-1 text-center">No events available today</p>
																												@endif
																								</div>
																				</div>
																</div>
												</div>
								</div>
				</div>
@stop
