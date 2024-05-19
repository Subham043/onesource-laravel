@extends("layouts.print")

@section("content")
				<div class="row">
								<div class="col-md-12 col-lg-12">
												<div class="row">
																<div class="col-md-12 col-lg-12">
																				<div class="card overflow-hidden" data-aos="fade-up" data-aos-delay="600">
																								<div class="d-flex justify-content-center flex-wrap py-2">
																												<div class="header-title">
																																<h4 class="card-title mb-0">{{ $data->count() }} writers have conflicts</h4>
																												</div>
																								</div>
																				</div>
																</div>
												</div>

												@foreach ($data as $item)
																<div class="row">
																				<div class="col-md-12 col-lg-12">
																								<div class="card overflow-hidden" data-aos="fade-up" data-aos-delay="600">
																												<div class="card-body p-0">
																																<div class="table-responsive mt-0">
																																				<table id="basic-table" class="table-striped mb-0 table" role="grid">
																																								<thead>
																																												<tr>
																																																<th>Writer</th>
																																																<th>Conflict Type</th>
																																																<th>Event ID</th>
																																																<th>Event</th>
																																																<th>Writer</th>
																																																<th>Date</th>
																																																<th>Start Time</th>
																																																<th>End Time</th>
																																												</tr>
																																								</thead>
																																								<tbody>
																																												@foreach ($item->writerEvents as $k => $v)
																																																<tr>
																																																				@if ($k == 0)
																																																								<td rowspan="{{ $item->writerEvents->count() }}">{{ $item->name }}
																																																								</td>
																																																								<td rowspan="{{ $item->writerEvents->count() }}">
																																																												{{ count(array_unique($item->writerEvents->pluck("event.created_by")->toArray(), SORT_REGULAR)) === 1 ? "Internal" : "External" }}
																																																								</td>
																																																				@endif

																																																				@if (
																																																								$v->event->created_by ==
																																																												(auth()->user()->current_role == "Staff-Admin"
																																																																? auth()->user()->member_profile_created_by_auth->created_by
																																																																: auth()->user()->id))
																																																								<td class="padfix">
																																																												<div class="d-flex align-items-center">
																																																																<a
																																																																				href="{{ route("event.view.get", $v->event->id) }}">EVD{{ $v->event->id }}</a>
																																																												</div>
																																																								</td>
																																																								<td>
																																																												<div class="iq-media-group iq-media-group-1">
																																																																<a href="{{ route("event.view.get", $v->event->id) }}">
																																																																				{{ $v->event->name }}</a>
																																																												</div>
																																																								</td>
																																																				@else
																																																								<td class="padfix">
																																																												<div class="d-flex align-items-center">
																																																																EVDxx <span data-bs-toggle="tooltip"
																																																																				data-bs-original-title="You cannot view/edit an external event"><i
																																																																								class="icon">
																																																																								<svg xmlns='http://www.w3.org/2000/svg'
																																																																												viewBox='0 0 12 12' width='12'
																																																																												height='12' fill='none'
																																																																												stroke='currentColor'>
																																																																												<circle cx='6' cy='6' r='4.5' />
																																																																												<path stroke-linejoin='round'
																																																																																d='M5.8 3.6h.4L6 6.5z' />
																																																																												<circle cx='6' cy='8.2' r='.6'
																																																																																fill='currentColor' stroke='none' />
																																																																								</svg>
																																																																				</i></span>
																																																												</div>
																																																								</td>
																																																								<td>
																																																												<div class="iq-media-group iq-media-group-1">
																																																																{{ str()->limit($v->event->name, 5) }}xxx
																																																												</div>
																																																								</td>
																																																				@endif
																																																				<td>
																																																								@foreach ($v->event->writers as $ke => $val)
																																																												{!! $ke + 1 == count($v->event->writers)
																																																												    ? '<span style="max-width: 170px; width: 170px;text-wrap:balance;">' . $val->writer->name . "</span>"
																																																												    : '<span style="max-width: 170px; width: 170px;text-wrap:balance;">' . $val->writer->name . "</span><br/> " !!}
																																																								@endforeach
																																																				</td>
																																																				<td>
																																																								{{ $v->event->start_date->format("M d Y") }}
																																																				</td>
																																																				<td>{{ $v->event->start_time->addMinute($v->event->client->setup_time)->format("h:i a") }}
																																																				</td>
																																																				<td>{{ $v->event->end_time->format("h:i a") }}</td>
																																																</tr>
																																												@endforeach
																																								</tbody>
																																				</table>
																																</div>
																												</div>
																								</div>
																				</div>
																</div>
												@endforeach

								</div>
				</div>
@stop
