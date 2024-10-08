@extends("layouts.main")

@section("css")
				<link rel="stylesheet" href="{{ asset("assets/css/select2.min.css") }}" type="text/css" />
				<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@24.5.0/build/css/intlTelInput.css" type="text/css" />
				<style nonce="{{ csp_nonce() }}">
								.select2-container {
												width: 100% !important;
												padding: 0.5rem 0rem;
												font-size: 1rem;
												font-weight: 400;
												line-height: 1.5;
												color: #8A92A6;
												background-color: #fff;
												-webkit-background-clip: padding-box;
												background-clip: padding-box;
												border: 1px solid #eee;
												-webkit-appearance: none;
												-moz-appearance: none;
												appearance: none;
												-webkit-border-radius: 0.25rem;
												border-radius: 0.25rem;
												-webkit-box-shadow: 0 0 0 0;
												box-shadow: 0 0 0 0;
								}

								.select2-container--default.select2-container--focus .select2-selection--multiple,
								.select2-container--default .select2-selection--multiple {
												border: none !important;
												padding-bottom: 0 !important;
												min-height: auto !important
								}
				</style>
@stop

@section("content")
				<div>
								<div class="col-sm-12 col-lg-12">
												<form id="loginForm" method="POST" action="{{ route("user.update.post", $data->id) }}" class="form-horizontal">
																@csrf
																<div class="card">
																				<div class="card-header d-flex justify-content-between">
																								<div class="header-title">
																												<h4 class="card-title">User Details</h4>
																								</div>
																				</div>
																				<div class="card-body">
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="name">Name:</label>
																												<div class="col-sm-10">
																																<input type="text" class="form-control" id="name" name="name"
																																				aria-describedby="name" value="{{ $data->name }}">
																																@error("name")
																																				<div class="invalid-message">{{ $message }}</div>
																																@enderror
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="email">Email ID:</label>
																												<div class="col-sm-10">
																																<input type="email" class="form-control" id="email" name="email" readonly disabled
																																				aria-describedby="email" value="{{ $data->email }}">
																																@error("email")
																																				<div class="invalid-message">{{ $message }}</div>
																																@enderror
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="phone">Phone: <span
																																				data-bs-toggle="tooltip"
																																				data-bs-original-title="Phone Format: 123-456-7810 or (123) 456-7810"><i class="icon">
																																								<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12'
																																												height='12' fill='none' stroke='currentColor'>
																																												<circle cx='6' cy='6' r='4.5' />
																																												<path stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z' />
																																												<circle cx='6' cy='8.2' r='.6' fill='currentColor'
																																																stroke='none' />
																																								</svg>
																																				</i></span></label>
																												<div class="col-sm-10">
																																<input type="tel" class="form-control" id="phone" name="phone" readonly disabled
																																				aria-describedby="phone" value="{{ $data->phone }}">
																																@error("phone")
																																				<div class="invalid-message">{{ $message }}</div>
																																@enderror
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="phone">Role:</label>
																												<div class="col-sm-10">
																																<input type="text" class="form-control" id="role" name="role" readonly disabled
																																				aria-describedby="role" value="{{ $data->current_role }}">
																																@error("role")
																																				<div class="invalid-message">{{ $message }}</div>
																																@enderror
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="timezone">Time Zone :</label>
																												<div class="col-sm-10">
																																<select id="timezone" name="timezone" class="form-select shadow-none">
																																				<option value="" {{ empty($data->timezone) ? "selected" : "" }}>Select</option>
                                                                                                                                                @foreach($timezones as $key => $value)
                                                                                                                                                    <option value="{{$value}}" {{!empty($data->timezone) && $data->timezone->value == $value ? 'selected' : ''}}>{{str_replace('_', ' ', strtok($value, ' '))}}</option>
                                                                                                                                                @endforeach
																																</select>
																																@error("timezone")
																																				<div class="invalid-message">{{ $message }}</div>
																																@enderror
																												</div>
																								</div>
																								<div id="client_div"
																												class="form-group row {{ $data->current_role === "Client" ? "d-flex" : "d-none" }}">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="client">Client: <span
																																				data-bs-toggle="tooltip" data-bs-original-title="Shown Only If Role Is Client"><i
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
																																<select id="client" name="client" class="form-select shadow-none">
																																				<option value=""
																																								{{ empty($data->member_profile_created_by_auth->client->id) ? "selected" : "" }}>
																																								Select Client</option>
																																				@foreach ($client as $item)
																																								<option value="{{ $item->id }}"
																																												{{ $data->member_profile_created_by_auth->client->id == $item->id ? "selected" : "" }}>
																																												{{ $item->name }}</option>
																																				@endforeach
																																</select>
																																@error("client")
																																				<div class="invalid-message">{{ $message }}</div>
																																@enderror
																												</div>
																								</div>

																								<div id="billing_rate_div"
																												class="form-group row {{ $data->current_role === "Client" || $data->current_role === "Writer" ? "d-flex" : "d-none" }}">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="billing_rate">Billing Rate :
																																<span data-bs-toggle="tooltip"
																																				data-bs-original-title="Billing rate should look like 000.00 (no dollar sign)"><i
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
																																<input type="text" class="form-control" id="billing_rate" name="billing_rate"
																																				value="{{ $data->member_profile_created_by_auth->billing_rate }}">
																																@error("billing_rate")
																																				<div class="invalid-message">{{ $message }}</div>
																																@enderror
																												</div>
																								</div>
																								<div id="tool_div"
																												class="form-group row {{ $data->current_role === "Writer" ? "d-flex" : "d-none" }}">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="tool">Tools :</label>
																												<div class="col-sm-10">
																																<select class="form-select shadow-none" id="tool" name="tool[]" multiple>
																																				@foreach ($tool as $item)
																																								<option value="{{ $item->id }}"
																																												{{ collect($data->member_profile_created_by_auth->tools->pluck("id"))->contains($item->id) ? "selected" : "" }}>
																																												{{ $item->name }}</option>
																																				@endforeach
																																</select>
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="image">Profile
																																Picture:</label>
																												<div class="col-sm-10">
																																<input type="file" class="form-control" id="image" name="image"
																																				aria-describedby="image">
																												</div>
																								</div>
																								<button type="submit" id="submitBtn" class="btn btn-primary">Update User</button>
																								<a href="{{ route("user.paginate.get") }}" class="btn btn-warning" id="submitBtn">Cancel</a>
																				</div>
																</div>
												</form>
								</div>
				</div>
@stop

@section("javascript")
				<script src="{{ asset("assets/js/plugins/jquery.js") }}"></script>
				<script src="{{ asset("assets/js/plugins/select2.min.js") }}"></script>
				<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@24.5.0/build/js/intlTelInput.min.js"></script>

				<script type="text/javascript" nonce="{{ csp_nonce() }}">
								document.addEventListener("keydown", (e) => {
												if ((e.metaKey || e.ctrlKey) && e.key === "s") {
																e.preventDefault();
																document.getElementById('submitBtn').click();
																return false;
												}
								});

								(function($) {
												$(document).ready(function() {
																$('#tool').select2();
												});
								})(jQuery);

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
												.addField('#timezone', [{
																rule: 'required',
																errorMessage: 'Timezone is required',
												}, ])
												.addField('#role', [{
																rule: 'required',
																errorMessage: 'Role is required',
												}, ])
												.addField('#client', [{
																validator: (value, fields) => {
																				if (fields['#role'] && fields['#role'].elem) {
																								const roleValue = fields['#role'].elem.value;

																								if ((roleValue === 'Client') && value.length == 0) {
																												return false;
																								}
																								return true;
																				}

																				return true;
																},
																errorMessage: 'Client is required',
												}, ])
												.addField('#billing_rate', [{
																validator: (value, fields) => {
																				if (fields['#role'] && fields['#role'].elem) {
																								const roleValue = fields['#role'].elem.value;

																								if ((roleValue === 'Client' || roleValue === 'Writer') && value.length == 0) {
																												return false;
																								}
																								return true;
																				}

																				return true;
																},
																errorMessage: 'Billing rate is required',
												}, ])
												.addField('#tool', [{
																validator: (value, fields) => true
												}, ])
												.addField('#image', [{
																validator: (value, fields) => true
												}, ])
												.onSuccess(async (event) => {
																// event.target.submit();
																var submitBtn = document.getElementById('submitBtn');
																submitBtn.innerHTML = spinner
																submitBtn.disabled = true;
																try {
																				var formData = new FormData();
																				formData.append('name', document.getElementById('name').value)
																				formData.append('timezone', document.getElementById('timezone').value)
																				formData.append('role', document.getElementById('role').value)
																				if (document.getElementById('role').value == 'Client') {
																								formData.append('client', document.getElementById('client').value)
																								formData.append('billing_rate', document.getElementById('billing_rate').value)
																				}
																				if (document.getElementById('role').value == 'Writer') {
																								formData.append('billing_rate', document.getElementById('billing_rate').value)
																								if (document.getElementById('tool')?.length > 0) {
																												for (let index = 0; index < document.getElementById('tool').length; index++) {
																																if (document.getElementById('tool')[index].selected) {
																																				if (document.getElementById('tool')[index].value != "") {
																																								formData.append('tool[]', document.getElementById('tool')[index].value)
																																				}
																																}
																												}
																								}
																				}
																				if ((document.getElementById('image').files).length > 0) {
																								formData.append('image', document.getElementById('image').files[0])
																				}

																				const response = await axios.post('{{ route("user.update.post", $data->id) }}', formData)
																				successToast(response.data.message)
																				setInterval(window.location.replace("{{ route("user.paginate.get") }}"), 1500);
																} catch (error) {
																				if (error?.response?.data?.errors?.name) {
																								validation.showErrors({
																												'#name': error?.response?.data?.errors?.name[0]
																								})
																				}
																				if (error?.response?.data?.errors?.timezone) {
																								validation.showErrors({
																												'#timezone': error?.response?.data?.errors?.timezone[0]
																								})
																				}
																				if (error?.response?.data?.errors?.role) {
																								validation.showErrors({
																												'#role': error?.response?.data?.errors?.role[0]
																								})
																				}
																				if (error?.response?.data?.errors?.billing_rate) {
																								validation.showErrors({
																												'#billing_rate': error?.response?.data?.errors?.billing_rate[0]
																								})
																				}
																				if (error?.response?.data?.errors?.tool) {
																								validation.showErrors({
																												'#tool': error?.response?.data?.errors?.tool[0]
																								})
																				}
																				if (error?.response?.data?.errors?.client) {
																								validation.showErrors({
																												'#client': error?.response?.data?.errors?.client[0]
																								})
																				}
																				if (error?.response?.data?.errors?.image) {
																								validation.showErrors({
																												'#image': error?.response?.data?.errors?.image[0]
																								})
																				}
																				if (error?.response?.data?.message) {
																								errorToast(error?.response?.data?.message)
																				}
																} finally {
																				submitBtn.innerHTML = `
            Update User
            `
																				submitBtn.disabled = false;
																}
												});

								document.getElementById('role').addEventListener("change", function() {
												if (document.getElementById('role').value === 'Client') {
																document.getElementById('client_div').classList.add('d-flex');
																document.getElementById('client_div').classList.remove('d-none');
												} else {
																document.getElementById('client_div').classList.add('d-none');
																document.getElementById('client_div').classList.remove('d-flex');
												}
												if (document.getElementById('role').value === 'Writer') {
																document.getElementById('tool_div').classList.add('d-flex');
																document.getElementById('tool_div').classList.remove('d-none');
												} else {
																document.getElementById('tool_div').classList.add('d-none');
																document.getElementById('tool_div').classList.remove('d-flex');
												}
												if (document.getElementById('role').value === 'Writer' || document.getElementById('role').value ===
																'Client') {
																document.getElementById('billing_rate_div').classList.add('d-flex');
																document.getElementById('billing_rate_div').classList.remove('d-none');
												} else {
																document.getElementById('billing_rate_div').classList.add('d-none');
																document.getElementById('billing_rate_div').classList.remove('d-flex');
												}
								});
				</script>

@stop
