@extends("layouts.print")

@section("content")
				<div class="row">
								<div class="col-md-12 col-lg-12">
												<div class="row">
																<div class="col-md-12 col-lg-12">
																				<div class="card overflow-hidden" data-aos="fade-up" data-aos-delay="600">
																								<div class="card-header d-flex justify-content-between align-items-center flex-wrap">
																												<div class="header-title d-flex align-items-center gap-2">
																																<h4 class="card-title mb-0">Events</h4>
																												</div>
																								</div>
																								<div class="card-body p-0">
																												@if ($data->total() > 0)
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
																																																<th>Prep</th>
																																																<th>1FUZION</th>
																																												</tr>
																																								</thead>
																																								<tbody>
																																												@foreach ($data->items() as $item)
																																																<tr>
																																																				@can("edit events")
																																																								<td>
																																																												<div class="d-flex align-items-center">
																																																																<input type="checkbox" class="form-check-input event-checkbox"
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
																																																												{!! $k + 1 == count($item->writers)
																																																												    ? '<span style="max-width: 170px; width: 170px;text-wrap:balance;">' . $v->writer->name . "</span>"
																																																												    : '<span style="max-width: 170px; width: 170px;text-wrap:balance;">' . $v->writer->name . "</span><br/> " !!}
																																																								@endforeach
																																																				</td>
																																																				<td>
																																																								{{ $item->start_date->format("M d Y") }}
																																																				</td>
																																																				<td>{{ $item->start_time->timezone(auth()->user()->timezone ? strtok(auth()->user()->timezone->value, " GMT") : "UTC")->format("h:i a") }}
																																																				</td>
																																																				<td>
																																																								{{ $item->end_date->format("M d Y") }}
																																																				</td>
																																																				<td>{{ $item->end_time->timezone(auth()->user()->timezone ? strtok(auth()->user()->timezone->value, " GMT") : "UTC")->format("h:i a") }}
																																																				</td>
																																																				<td>
																																																								@if ($item->is_prep_ready)
																																																												<a href="#" class="remove-item-btn"
																																																																data-link="{{ route("event.prep.get", $item->id) }}"
																																																																data-bs-toggle="tooltip"
																																																																data-bs-original-title="Prep is ready, click to cancel it.">
																																																																<svg width="32" viewBox="0 0 24 24" fill="none"
																																																																				xmlns="http://www.w3.org/2000/svg">
																																																																				<path
																																																																								d="M9.38574 11.8746L11.2777 13.7696L15.1757 9.86963"
																																																																								stroke="#1aa053" stroke-width="1.5"
																																																																								stroke-linecap="round" stroke-linejoin="round">
																																																																				</path>
																																																																</svg>
																																																												</a>
																																																								@else
																																																												<a href="#" class="remove-item-btn"
																																																																data-link="{{ route("event.prep.get", $item->id) }}"
																																																																data-bs-toggle="tooltip"
																																																																data-bs-original-title="Prep is not ready, click to make it ready">
																																																																<svg width="32" viewBox="0 0 24 24" fill="none"
																																																																				xmlns="http://www.w3.org/2000/svg">
																																																																				<path d="M14.3955 9.59497L9.60352 14.387"
																																																																								stroke="#FF0000" stroke-width="1.5"
																																																																								stroke-linecap="round" stroke-linejoin="round">
																																																																				</path>
																																																																				<path d="M14.3971 14.3898L9.60107 9.59277"
																																																																								stroke="#FF0000" stroke-width="1.5"
																																																																								stroke-linecap="round" stroke-linejoin="round">
																																																																				</path>
																																																																</svg>
																																																												</a>
																																																								@endif
																																																				</td>
																																																				<td>{{ $item->fuzion_id }}</td>
																																																</tr>
																																												@endforeach
																																								</tbody>
																																				</table>
																																</div>
																												@else
																																<p class="text-center">No data available</p>
																												@endif
																								</div>
																				</div>
																</div>
												</div>
								</div>
				</div>
@stop
