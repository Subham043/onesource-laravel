@extends("layouts.main")

@section("css")
				<style nonce="{{ csp_nonce() }}">
								.text-left {
												text-align: left !important;
								}
				</style>
@stop

@section("content")
				<div class="row">
								<div class="col-md-12 col-lg-12">
												<div class="row">
																<div class="col-12 d-flex justify-content-end mb-3 gap-2">
																				{{-- <a href="{{ route("report.conflict.print.get") }}" target="_blank" class="btn btn-primary">Print</a> --}}
																				<a href="{{ route("dashboard.get") }}" class="btn btn-primary">Dashboard</a>
																</div>
																<div class="col-md-12 col-lg-12">
																				<div class="card overflow-hidden" data-aos="fade-up" data-aos-delay="600">
																								<div class="d-flex justify-content-center flex-wrap py-2">
																												<div class="header-title">
																																<h4 class="card-title mb-0">{{ count($data) * 2 }} writers have conflicts</h4>
																												</div>
																								</div>
																				</div>
																</div>
												</div>

												@foreach ($data as $item)
																@foreach ($item["events"] as $vl)
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
																																																				<th>&nbsp;</th>
																																																</tr>
																																												</thead>
																																												<tbody>
																																																<tr>
																																																				<td rowspan="{{ count($vl) + 1 }}">{{ $item["writer_name"] }}
																																																				</td>
																																																				<td rowspan="{{ count($vl) + 1 }}" class="text-left">
																																																								{{ $item["conflict_type"] }}
																																																				</td>
																																																</tr>
																																																@foreach ($vl as $val)
																																																				<tr>
																																																								<td class="padfix">
																																																												<div class="d-flex align-items-center">
																																																																<a
																																																																				href="{{ route("event.view.get", $val["event_id"]) }}">EVD{{ $val["event_id"] }}</a>
																																																												</div>
																																																								</td>
																																																								<td>
																																																												<div class="iq-media-group iq-media-group-1">
																																																																<a href="{{ route("event.view.get", $val["event_id"]) }}">
																																																																				{{ $val["event_name"] }}</a>
																																																												</div>
																																																								</td>
																																																								{{-- <td class="padfix">
                                                                                                                                                                                                                                    <div class="d-flex align-items-center">
                                                                                                                                                                                                                                                    EVDxx <span data-bs-toggle="tooltip"
                                                                                                                                                                                                                                                                    data-bs-original-title="You cannot view/edit an external event"><i
                                                                                                                                                                                                                                                                                    class="icon">
                                                                                                                                                                                                                                                                                    <svg xmlns='http://www.w3.org/2000/svg'
                                                                                                                                                                                                                                                                                                    viewBox='0 0 12 12' width='12'
                                                                                                                                                                                                                                                                                                    height='12' fill='none'
                                                                                                                                                                                                                                                                                                    stroke='currentColor'>
                                                                                                                                                                                                                                                                                                    <circle cx='6' cy='6'
                                                                                                                                                                                                                                                                                                                    r='4.5' />
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
                                                                                                                                                                                                                    </td> --}}
																																																								<td>
																																																												@foreach ($val["event_conflict_writer"] as $ke => $eve_writer)
																																																																{!! $ke + 1 == count($val["event_conflict_writer"])
																																																																    ? '<span style="max-width: 170px; width: 170px;text-wrap:balance;">' . $eve_writer . "</span>"
																																																																    : '<span style="max-width: 170px; width: 170px;text-wrap:balance;">' . $eve_writer . "</span><br/> " !!}
																																																												@endforeach
																																																								</td>
																																																								<td>
																																																												{{ $val["event_date"] }}
																																																								</td>
																																																								<td>{{ $val["event_start_time"] }}
																																																								</td>
																																																								{{-- <td>{{ $v->event->start_time->addMinute($v->event->client->setup_time)->timezone(auth()->user()->timezone ? strtok(auth()->user()->timezone->value, " GMT") : "UTC")->format("h:i a") }}
                                                                                                                                                                </td> --}}
																																																								<td>{{ $val["event_end_time"] }}
																																																								</td>
																																																								<td>
																																																												@can("edit events")
																																																																<a href="{{ route("event.update.get", $val["event_id"]) . "?writer_conflict=" . $item["writer_id"] }}"
																																																																				class="btn btn-primary">Edit
																																																																				Event</a>
																																																												@endcan
																																																								</td>
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
												@endforeach

								</div>
				</div>
@stop
