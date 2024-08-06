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
																																<h4 class="card-title mb-0">{{ count($data) }} writers have conflicts</h4>
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
																																																				<th>&nbsp;</th>
																																																</tr>
																																												</thead>
																																												<tbody>
																																																<tr>
																																																				<td rowspan="{{ count($item["events"]) + 1 }}">{{ $item["writer_name"] }}
																																																				</td>
																																																				<td rowspan="{{ count($item["events"]) + 1 }}" class="text-left">
																																																								INTERNAL <br/>(Date & Time Conflict)
																																																				</td>
																																																</tr>
																																																@foreach ($item["events"] as $val)
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
																																																								<td>
                                                                                                                                                                                                                                    <span style="max-width: 170px; width: 170px;text-wrap:balance;">
                                                                                                                                                                                                                                        {{ $val["writer_name"] }}
                                                                                                                                                                                                                                    </span>
																																																								</td>
																																																								<td>
																																																									{{ $val["event_date"] }}
																																																								</td>
																																																								<td>{{ $val["event_start_time"] }}
																																																								</td>
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

								</div>
				</div>
@stop
