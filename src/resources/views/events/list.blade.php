@extends("layouts.main")

@section("content")
				<div class="row">
								<div class="col-md-12 col-lg-12">
												<div class="row">
																<div class="col-md-12 col-lg-12">
																				<div class="card overflow-hidden" data-aos="fade-up" data-aos-delay="600">
																								<div class="card-header d-flex justify-content-between align-items-center flex-wrap">
																												<div class="header-title d-flex align-items-center gap-2">
																																<h4 class="card-title mb-0">Events</h4>
																																<form method="GET" action="{{ route("event.paginate.get") }}" id='sort-form'
																																				class="col-auto d-flex gap-2">
																																				<select class="form-select shadow-none" id="sort" name="sort">
																																								<option value="" {{ empty(request()->query("sort")) ? "selected" : "" }}>Sort
																																												By</option>
																																								<option value="name" {{ request()->query("sort") == "name" ? "selected" : "" }}>
																																												Event:A-Z</option>
																																								<option value="-name" {{ request()->query("sort") == "-name" ? "selected" : "" }}>
																																												Event:Z-A</option>
																																								<option value="-id" {{ request()->query("sort") == "-id" ? "selected" : "" }}>
																																												Event
																																												ID:Latest</option>
																																								<option value="id" {{ request()->query("sort") == "id" ? "selected" : "" }}>
																																												Event
																																												ID:Oldest</option>
																																								<option value="-start_date"
																																												{{ request()->query("sort") == "-start_date" ? "selected" : "" }}>Event
																																												Date:Latest</option>
																																								<option value="start_date"
																																												{{ request()->query("sort") == "start_date" ? "selected" : "" }}>Event
																																												Date:Oldest
																																								</option>
																																								<option value="-start_time"
																																												{{ request()->query("sort") == "-start_time" ? "selected" : "" }}>Event
																																												Time:Latest</option>
																																								<option value="start_time"
																																												{{ request()->query("sort") == "start_time" ? "selected" : "" }}>Event
																																												Time:Oldest
																																								</option>
																																				</select>
																																				<select class="form-select shadow-none" id="status" name="filter[status]">
																																								<option value="" {{ empty($status) || $status == "all" ? "selected" : "" }}>All</option>
																																								<option value="upcoming" {{ $status == "upcoming" ? "selected" : "" }}>
																																												Upcoming</option>
																																								<option value="archived" {{ $status == "archived" ? "selected" : "" }}>
																																												Archived</option>
																																				</select>
																																</form>
																																{{-- <form method="GET" action="{{ route("event.paginate.get") }}" id='total-form'
																																				class="col-auto">
																																				<select class="form-select shadow-none" id="total" name="total">
																																								<option value="" {{ empty(request()->query("total")) ? "selected" : "" }}>
																																												Total</option>
																																								<option value="10" {{ request()->query("total") == "10" ? "selected" : "" }}>
																																												10</option>
																																								<option value="30" {{ request()->query("total") == "30" ? "selected" : "" }}>
																																												30</option>
																																								<option value="50" {{ request()->query("total") == "50" ? "selected" : "" }}>
																																												50</option>
																																								<option value="75" {{ request()->query("total") == "75" ? "selected" : "" }}>
																																												75</option>
																																								<option value="100" {{ request()->query("total") == "100" ? "selected" : "" }}>
																																												100</option>
																																				</select>
																																</form> --}}
																												</div>
																												<div>
																																@can("edit events")
																																				<button id="cancel_event" class="btn btn-primary d-none">Cancel Event</button>
																																				<button id="toggle_event" class="btn btn-primary d-none">Toggle Prep</button>
																																@endcan
																																{{-- <a href="{{ route("event.print.get") }}?{{ http_build_query(request()->query()) }}"
																																				target="_blank" class="btn btn-primary">Print</a> --}}
																																@can("add events")
																																				<a href="{{ route("event.create.get") }}" class="btn btn-primary">Add Event</a>
																																@endcan
																																@can("view calendar")
																																				<a href="{{ route("calendar.view.get") }}" class="btn btn-primary">Calendar View</a>
																																@endcan
																																<a href="{{ route("dashboard.get") }}" class="btn btn-primary">Dashboard</a>
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
																																																<th>&nbsp;</th>
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
																																																				<td>

																																																								@can("edit events")
																																																												@if (!$item->is_active)
																																																																<a href="#" class="remove-item-btn"
																																																																				data-link="{{ route("event.status.get", $item->id) }}"
																																																																				data-bs-toggle="tooltip"
																																																																				data-bs-original-title="Event is Cancelled. Click to Activate it">
																																																																				<svg xmlns="http://www.w3.org/2000/svg" width="32"
																																																																								viewBox="0 0 24 24" fill="none">
																																																																								<circle cx="12" cy="12" r="5"
																																																																												fill="red"></circle>
																																																																				</svg>
																																																																</a>
																																																												@else
																																																																<a href="#" class="remove-item-btn"
																																																																				data-link="{{ route("event.status.get", $item->id) }}"
																																																																				data-bs-toggle="tooltip"
																																																																				data-bs-original-title="Event is Active. Click to Cancel it">
																																																																				<svg xmlns="http://www.w3.org/2000/svg" width="32"
																																																																								viewBox="0 0 24 24" fill="none">
																																																																								<circle cx="12" cy="12" r="5"
																																																																												fill="green"></circle>
																																																																				</svg>
																																																																</a>
																																																												@endif
																																																								@endcan

																																																								@can("view events")
																																																												<a href="{{ route("event.view.get", $item->id) }}" class=""
																																																																data-bs-toggle="tooltip" data-bs-original-title="View Event">
																																																																<svg width="32" viewBox="0 0 24 24" fill="none"
																																																																				xmlns="http://www.w3.org/2000/svg">
																																																																				<path opacity="0.4" fill-rule="evenodd"
																																																																								clip-rule="evenodd"
																																																																								d="M17.7366 6.04606C19.4439 7.36388 20.8976 9.29455 21.9415 11.7091C22.0195 11.8924 22.0195 12.1067 21.9415 12.2812C19.8537 17.1103 16.1366 20 12 20H11.9902C7.86341 20 4.14634 17.1103 2.05854 12.2812C1.98049 12.1067 1.98049 11.8924 2.05854 11.7091C4.14634 6.87903 7.86341 4 11.9902 4H12C14.0683 4 16.0293 4.71758 17.7366 6.04606ZM8.09756 12C8.09756 14.1333 9.8439 15.8691 12 15.8691C14.1463 15.8691 15.8927 14.1333 15.8927 12C15.8927 9.85697 14.1463 8.12121 12 8.12121C9.8439 8.12121 8.09756 9.85697 8.09756 12Z"
																																																																								fill="currentColor"></path>
																																																																				<path
																																																																								d="M14.4308 11.997C14.4308 13.3255 13.3381 14.4115 12.0015 14.4115C10.6552 14.4115 9.5625 13.3255 9.5625 11.997C9.5625 11.8321 9.58201 11.678 9.61128 11.5228H9.66006C10.743 11.5228 11.621 10.6695 11.6601 9.60184C11.7674 9.58342 11.8845 9.57275 12.0015 9.57275C13.3381 9.57275 14.4308 10.6588 14.4308 11.997Z"
																																																																								fill="currentColor"></path>
																																																																</svg>
																																																												</a>
																																																								@endcan

																																																								@can("edit events")
																																																												<a href="{{ route("event.update.get", $item->id) }}"
																																																																class="" data-bs-toggle="tooltip"
																																																																data-bs-original-title="Edit Event"> <svg width="32"
																																																																				viewBox="0 0 24 24" fill="none"
																																																																				xmlns="http://www.w3.org/2000/svg">
																																																																				<path opacity="0.4"
																																																																								d="M16.6643 21.9897H7.33488C5.88835 22.0796 4.46781 21.5781 3.3989 20.6011C2.4219 19.5312 1.92041 18.1107 2.01032 16.6652V7.33482C1.92041 5.88932 2.4209 4.46878 3.3979 3.39889C4.46781 2.42189 5.88835 1.92041 7.33488 2.01032H16.6643C18.1089 1.92041 19.5284 2.4209 20.5973 3.39789C21.5733 4.46878 22.0758 5.88832 21.9899 7.33482V16.6652C22.0788 18.1107 21.5783 19.5312 20.6013 20.6011C19.5314 21.5781 18.1109 22.0796 16.6643 21.9897Z"
																																																																								fill="currentColor"></path>
																																																																				<path
																																																																								d="M17.0545 10.3976L10.5018 16.9829C10.161 17.3146 9.7131 17.5 9.24574 17.5H6.95762C6.83105 17.5 6.71421 17.4512 6.62658 17.3634C6.53895 17.2756 6.5 17.1585 6.5 17.0317L6.55842 14.7195C6.56816 14.261 6.75315 13.8317 7.07446 13.5098L11.7189 8.8561C11.7967 8.77805 11.9331 8.77805 12.011 8.8561L13.6399 10.4785C13.747 10.5849 13.9028 10.6541 14.0683 10.6541C14.4286 10.6541 14.7109 10.3615 14.7109 10.0102C14.7109 9.83463 14.6428 9.67854 14.5357 9.56146C14.5065 9.52244 12.9554 7.97805 12.9554 7.97805C12.858 7.88049 12.858 7.71463 12.9554 7.61707L13.6078 6.95366C14.2114 6.34878 15.1851 6.34878 15.7888 6.95366L17.0545 8.22195C17.6485 8.81707 17.6485 9.79268 17.0545 10.3976Z"
																																																																								fill="currentColor"></path>
																																																																</svg> </a>
																																																								@endcan

																																																				</td>
																																																</tr>
																																												@endforeach
																																								</tbody>
																																				</table>
																																				<div class="card-header">
																																								{{ $data->onEachSide(5)->links() }}
																																				</div>
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

@section("javascript")
				<script type="text/javascript" nonce="{{ csp_nonce() }}">
								document.getElementById('sort').addEventListener('change', function() {
												document.getElementById('sort-form').submit();
								});
								document.getElementById('status').addEventListener('change', function() {
												document.getElementById('sort-form').submit();
								});
								// document.getElementById('total').addEventListener('change', function() {
								// 																																																																document.getElementById('total-form').submit();
								// });
				</script>
				@can("edit events")
								<script type="text/javascript" nonce="{{ csp_nonce() }}">
												let event_arr = []
												const checkAll = document.getElementById('checkAll');
												checkAll.addEventListener('input', function() {
																const event_checkbox = document.querySelectorAll('.event-checkbox');
																if (checkAll.checked) {
																				for (let index = 0; index < event_checkbox.length; index++) {
																								if (event_checkbox[index].value.length > 0) {
																												event_checkbox[index].checked = true
																												if (!event_arr.includes(event_checkbox[index].value)) {
																																event_arr.push(event_checkbox[index].value);
																												}
																								}
																				}
																} else {
																				for (let index = 0; index < event_checkbox.length; index++) {
																								if (event_checkbox[index].value.length > 0) {
																												event_checkbox[index].checked = false
																												event_arr = [];
																								}
																				}
																}
																toggleCancelBtn()
												})


												document.querySelectorAll('.event-checkbox').forEach(el => {
																el.addEventListener('input', function(event) {
																				toggleSingleCancelBtn(event)
																})
												});

												const toggleCancelBtn = () => {
																document.querySelectorAll('.event-checkbox').forEach(el => {
																				if (el.checked && event_arr.length > 0) {
																								document.getElementById('cancel_event').classList.add('d-inline-block')
																								document.getElementById('cancel_event').classList.remove('d-none')
																								document.getElementById('toggle_event').classList.add('d-inline-block')
																								document.getElementById('toggle_event').classList.remove('d-none')
																				} else {
																								document.getElementById('cancel_event').classList.add('d-none')
																								document.getElementById('cancel_event').classList.remove('d-inline-block')
																								document.getElementById('toggle_event').classList.add('d-none')
																								document.getElementById('toggle_event').classList.remove('d-inline-block')
																				}
																})
												}

												const toggleSingleCancelBtn = (event) => {
																if (!event.target.checked) {
																				event_arr = event_arr.filter(function(item) {
																								return item !== event.target.value
																				})
																} else {
																				if (!event_arr.includes(event.target.value)) {
																								event_arr.push(event.target.value)
																				}
																}
																if (!event.target.checked && event_arr.length < 1) {
																				document.getElementById('cancel_event').classList.add('d-none')
																				document.getElementById('cancel_event').classList.remove('d-inline-block')
																				document.getElementById('toggle_event').classList.add('d-none')
																				document.getElementById('toggle_event').classList.remove('d-inline-block')
																} else {
																				document.getElementById('cancel_event').classList.add('d-inline-block')
																				document.getElementById('cancel_event').classList.remove('d-none')
																				document.getElementById('toggle_event').classList.add('d-inline-block')
																				document.getElementById('toggle_event').classList.remove('d-none')
																}
												}


												document.getElementById('cancel_event').addEventListener('click', function() {
																cancel_event_handler()
												})
												document.getElementById('toggle_event').addEventListener('click', function() {
																toggle_event_handler()
												})

												const cancel_event_handler = () => {
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
																								['<button><b>YES</b></button>', async function(instance, toast) {

																												instance.hide({
																																transitionOut: 'fadeOut'
																												}, toast, 'button');
																												var submitBtn = document.getElementById('cancel_event');
																												submitBtn.innerHTML = spinner
																												submitBtn.disabled = true;
																												try {

																																const response = await axios.post('{{ route("event.status.post") }}', {
																																				event: event_arr
																																})
																																successToast(response.data.message)
																																setInterval(window.location.replace("{{ route("event.paginate.get") }}"),
																																				1500);
																												} catch (error) {
																																if (error?.response?.data?.message) {
																																				errorToast(error?.response?.data?.message)
																																}
																												} finally {
																																submitBtn.innerHTML = `
                            Cancel Event
                            `
																																submitBtn.disabled = false;
																												}

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
												}

												const toggle_event_handler = () => {
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
																								['<button><b>YES</b></button>', async function(instance, toast) {

																												instance.hide({
																																transitionOut: 'fadeOut'
																												}, toast, 'button');
																												var submitBtn = document.getElementById('toggle_event');
																												submitBtn.innerHTML = spinner
																												submitBtn.disabled = true;
																												try {

																																const response = await axios.post('{{ route("event.prep.post") }}', {
																																				event: event_arr
																																})
																																successToast(response.data.message)
																																setInterval(window.location.replace("{{ route("event.paginate.get") }}"),
																																				1500);
																												} catch (error) {
																																if (error?.response?.data?.message) {
																																				errorToast(error?.response?.data?.message)
																																}
																												} finally {
																																submitBtn.innerHTML = `
                            Toggle Prep
                            `
																																submitBtn.disabled = false;
																												}

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
												}
								</script>
				@endcan
@stop
