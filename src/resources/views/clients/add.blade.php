@extends("layouts.main")

@section("css")
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@24.5.0/build/css/intlTelInput.css" type="text/css" />
@stop

@section("content")
				<div>
								<div class="col-sm-12 col-lg-12">
												<form id="loginForm" method="POST" action="{{ route("client.create.post") }}" class="form-horizontal">
																@csrf
																<div class="card">
																				<div class="card-header d-flex justify-content-between">
																								<div class="header-title">
																												<h4 class="card-title">Client Details</h4>
																								</div>
																				</div>
																				<div class="card-body">
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="name">Name:</label>
																												<div class="col-sm-10">
																																<input type="text" class="form-control" id="name" name="name"
																																				value="{{ old("name") }}">
																																@error("name")
																																				<div class="invalid-message">{{ $message }}</div>
																																@enderror
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="email">Email:</label>
																												<div class="col-sm-10">
																																<input type="text" class="form-control" id="email" name="email"
																																				value="{{ old("email") }}">
																																@error("email")
																																				<div class="invalid-message">{{ $message }}</div>
																																@enderror
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="phone">Phone:</label>
																												<div class="col-sm-10">
																																<input type="text" class="form-control" id="phone" name="phone"
																																				value="{{ old("phone") }}">
																																@error("phone")
																																				<div class="invalid-message">{{ $message }}</div>
																																@enderror
																												</div>
																								</div>
																								{{-- <div class="form-group row d-flex">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="onsite_billing_rate">Onsite
																																Billing Rate : <span data-bs-toggle="tooltip"
																																				data-bs-original-title="Onsite Billing rate should look like 000.00 (no dollar sign)"><i
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
																																<input type="text" class="form-control" id="onsite_billing_rate"
																																				name="onsite_billing_rate" value="{{ old("onsite_billing_rate") }}">
																																@error("onsite_billing_rate")
																																				<div class="invalid-message">{{ $message }}</div>
																																@enderror
																												</div>
																								</div>
																								<div class="form-group row d-flex">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="remote_billing_rate">Remote
																																Billing Rate : <span data-bs-toggle="tooltip"
																																				data-bs-original-title="Remote Billing rate should look like 000.00 (no dollar sign)"><i
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
																																<input type="text" class="form-control" id="remote_billing_rate"
																																				name="remote_billing_rate" value="{{ old("remote_billing_rate") }}">
																																@error("remote_billing_rate")
																																				<div class="invalid-message">{{ $message }}</div>
																																@enderror
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="setup_time">Setup
																																Time (in Minutes): <span data-bs-toggle="tooltip"
																																				data-bs-original-title="Setup time should be in minutes like 10"><i class="icon">
																																								<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12'
																																												height='12' fill='none' stroke='currentColor'>
																																												<circle cx='6' cy='6' r='4.5' />
																																												<path stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z' />
																																												<circle cx='6' cy='8.2' r='.6' fill='currentColor'
																																																stroke='none' />
																																								</svg>
																																				</i></span></label>
																												<div class="col-sm-10">
																																<input type="text" class="form-control" id="setup_time" name="setup_time"
																																				value="{{ old("setup_time") }}">
																																@error("setup_time")
																																				<div class="invalid-message">{{ $message }}</div>
																																@enderror
																												</div>
																								</div> --}}
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="address">Address:</label>
																												<div class="col-sm-10">
																																<textarea class="form-control" name="address" id="address" rows="5">{{ old("address") }}</textarea>
																																@error("address")
																																				<div class="invalid-message">{{ $message }}</div>
																																@enderror
																												</div>
																								</div>
																								<button type="submit" id="submitBtn" class="btn btn-primary">Create Client</button>
																								<a href="{{ route("client.paginate.get") }}" class="btn btn-warning" id="submitBtn">Cancel</a>
																				</div>
																</div>
												</form>
								</div>
				</div>
@stop

@section("javascript")
                <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@24.5.0/build/js/intlTelInput.min.js"></script>

				<script type="text/javascript" nonce="{{ csp_nonce() }}">
								document.addEventListener("keydown", (e) => {
												if ((e.metaKey || e.ctrlKey) && e.key === "s") {
																e.preventDefault();
																document.getElementById('submitBtn').click();
																return false;
												}
								});

                                const countryData = window.intlTelInput(document.querySelector("#phone"), {
												utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@24.5.0/build/js/utils.js",
												autoInsertDialCode: true,
												initialCountry: "us",
												nationalMode: false,
												geoIpLookup: callback => {
																fetch("https://ipapi.co/json")
																				.then(res => res.json())
																				.then(data => callback(data.country_code))
																				.catch(() => callback("us"));
												},
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
												.addField('#email', [{
																rule: 'required',
																errorMessage: 'Email is required',
												}, ])
												.addField('#phone', [{
																rule: 'required',
																errorMessage: 'Phone is required',
												}, ])
												// .addField('#onsite_billing_rate', [{
												// 																rule: 'required',
												// 																errorMessage: 'Onsite billing rate is required',
												// }, ])
												// .addField('#remote_billing_rate', [{
												// 																rule: 'required',
												// 																errorMessage: 'Remote billing rate is required',
												// }, ])
												// .addField('#setup_time', [{
												// 																rule: 'required',
												// 																errorMessage: 'Setup time is required',
												// }, ])
												.addField('#address', [{
																rule: 'required',
																errorMessage: 'Address is required',
												}, ])
												.onSuccess((event) => {
																event.target.submit();
												});
				</script>

@stop
