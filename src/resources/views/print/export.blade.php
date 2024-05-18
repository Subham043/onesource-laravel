@extends("layouts.print")

@section("content")
				<div class="row">
								<div class="col-md-12 col-lg-12">
												<div class="row">
																<div class="col-md-12 col-lg-12">
																				<div class="card overflow-hidden" data-aos="fade-up" data-aos-delay="600">
																								<div class="card-header d-flex justify-content-between flex-wrap">
																												<div class="header-title">
																																<h4 class="card-title mb-2">Export Events to 1CapApp</h4>
																												</div>
																								</div>
																								<div class="card-body p-0">
																												@if ($data->total() > 0)
																																<div class="table-responsive mt-4">
																																				<table id="basic-table" class="table-striped mb-0 table" role="grid">
																																								<thead>
																																												<tr>
																																																<th>Event ID</th>
																																																<th>Event</th>
																																																<th>Client</th>
																																																<th>Writer</th>
																																																<th>Date</th>
																																																<th>Start Time</th>
																																																<th>End Time</th>
																																												</tr>
																																								</thead>
																																								<tbody>
																																												@foreach ($data->items() as $item)
																																																<tr>
																																																				<td>
																																																								<div class="d-flex align-items-center">
																																																												<a
																																																																href="{{ route("event.view.get", $item->id) }}">EVD{{ $item->id }}</a>
																																																								</div>
																																																				</td>
																																																				<td>
																																																								<div class="iq-media-group iq-media-group-1">
																																																												<a href="{{ route("event.view.get", $item->id) }}">
																																																																{{ $item->name }}</a>
																																																								</div>
																																																				</td>
																																																				<td>
																																																								<div class="iq-media-group iq-media-group-1">
																																																												{{ $item->client->name }}
																																																								</div>
																																																				</td>
																																																				<td>
																																																								@foreach ($item->writers as $k => $v)
																																																												{!! $k + 1 == count($item->writers) ? $v->writer->name : $v->writer->name . "<br/> " !!}
																																																								@endforeach
																																																				</td>
																																																				<td>
																																																								{{ $item->start_date->format("M d Y") }}
																																																				</td>
																																																				<td>{{ $item->start_time->format("h:i a") }}</td>
																																																				<td>{{ $item->end_time->format("h:i a") }}</td>
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
