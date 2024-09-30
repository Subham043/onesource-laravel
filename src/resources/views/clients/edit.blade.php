@extends("layouts.main")

@section("css")
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@24.5.0/build/css/intlTelInput.css" type="text/css" />
				<link rel="stylesheet" href="{{ asset("assets/css/filepond.min.css") }}" type="text/css" />
				<link rel="stylesheet" href="{{ asset("assets/css/filepond-plugin-image-preview.min.css") }}" type="text/css" />
@stop

@section("content")
				<div>
								<div class="col-sm-12 col-lg-12">
												<form id="loginForm" method="POST" action="{{ route("client.update.post", $data->id) }}" class="form-horizontal">
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
																																				value="{{ $data->name }}">
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="email">Email:</label>
																												<div class="col-sm-10">
																																<input type="text" class="form-control" id="email" name="email"
																																				value="{{ $data->email }}">
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="phone">Phone:</label>
																												<div class="col-sm-10">
																																<input type="text" class="form-control" id="phone" name="phone"
																																				value="{{ $data->phone }}">
																												</div>
																								</div>
                                                                                                <div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="onsite_billing_rate">Invoice Rate: <span data-bs-toggle="tooltip"
																																				data-bs-original-title="Invoice rate should look like 000.00 (no dollar sign)"><i
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
																																<input type="text" class="form-control" id="invoice_rate"
																																				name="invoice_rate" value="{{ $data->invoice_rate }}">
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="audio_phone">Audio Phone Number:</label>
																												<div class="col-sm-10">
																																<input type="text" class="form-control" id="audio_phone" name="audio_phone"
																																				value="{{ $data->audio_phone }}">
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="encoder_phone">Encoder Phone Number:</label>
																												<div class="col-sm-10">
																																<input type="text" class="form-control" id="encoder_phone" name="encoder_phone"
																																				value="{{ $data->encoder_phone }}">
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="mic_phone">MC Phone Number:</label>
																												<div class="col-sm-10">
																																<input type="text" class="form-control" id="mic_phone" name="mic_phone"
																																				value="{{ $data->mic_phone }}">
																												</div>
																								</div>
																								{{-- <div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="onsite_billing_rate">Onsite
																																Billing Rate: <span data-bs-toggle="tooltip"
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
																																				name="onsite_billing_rate" value="{{ $data->onsite_billing_rate }}">
																																@error("onsite_billing_rate")
																																				<div class="invalid-message">{{ $message }}</div>
																																@enderror
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="remote_billing_rate">Remote
																																Billing Rate: <span data-bs-toggle="tooltip"
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
																																				name="remote_billing_rate" value="{{ $data->remote_billing_rate }}">
																																@error("remote_billing_rate")
																																				<div class="invalid-message">{{ $message }}</div>
																																@enderror
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="setup_time">Setup Time: <span
																																				data-bs-toggle="tooltip"
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
																																				value="{{ $data->setup_time }}">
																																@error("setup_time")
																																				<div class="invalid-message">{{ $message }}</div>
																																@enderror
																												</div>
																								</div> --}}
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="address">Address:</label>
																												<div class="col-sm-10">
																																<textarea class="form-control" name="address" id="address" rows="5">{{ $data->address }}</textarea>
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="line_placements">Line Placements:</label>
																												<div class="col-sm-10">
																																<textarea class="form-control" name="line_placements" id="line_placements" rows="5">{{ $data->line_placements }}</textarea>
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="notes">Notes:</label>
																												<div class="col-sm-10">
																																<textarea class="form-control" name="notes" id="notes" rows="5">{{ $data->notes }}</textarea>
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="word">Words/Specifics:</label>
																												<div class="col-sm-10">
																																<textarea class="form-control" name="word" id="word" rows="5">{{ $data->word }}</textarea>
																												</div>
																								</div>
                                                                                                <div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="word">Documents:</label>
																												<div class="col-sm-10">
																																<input class="form-control filepond" type="file" name="upload" id="upload" multiple
																																data-allow-reorder="true" data-max-file-size="5MB" data-max-files="3">
																																<div id="document-error mt-2"></div>
																												</div>
																								</div>
																								<button type="submit" id="submitBtn" class="btn btn-primary">Save</button>
																								<a href="{{ route("client.paginate.get") }}" class="btn btn-warning" id="submitBtn">Cancel</a>
																				</div>
																</div>
												</form>
								</div>
				</div>
@stop

@section("javascript")
                <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@24.5.0/build/js/intlTelInput.min.js"></script>
                <script src="{{ asset("assets/js/plugins/filepond.min.js") }}"></script>
				<script src="{{ asset("assets/js/plugins/filepond-plugin-image-preview.min.js") }}"></script>
				<script src="{{ asset("assets/js/plugins/filepond-plugin-file-validate-size.min.js") }}"></script>
				<script src="{{ asset("assets/js/plugins/filepond-plugin-image-exif-orientation.min.js") }}"></script>
				<script src="{{ asset("assets/js/plugins/filepond-plugin-file-encode.min.js") }}"></script>

				<script type="text/javascript" nonce="{{ csp_nonce() }}">
								document.addEventListener("keydown", (e) => {
												if ((e.metaKey || e.ctrlKey) && e.key === "s") {
																e.preventDefault();
																document.getElementById('submitBtn').click();
																return false;
												}
								});

                                FilePond.registerPlugin(FilePondPluginImagePreview);
								const inputUploadElement = document.querySelector('#upload');
								// Create the FilePond instance
								const pond = FilePond.create(inputUploadElement, {
												allowMultiple: true
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
												.addField('#invoice_rate', [{
                                                    rule: 'required',
                                                    errorMessage: 'Invoice rate is required',
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
                                                .addField('#notes', [{
																validator: (value, fields) => true
												}])
                                                .addField('#line_placements', [{
																validator: (value, fields) => true
												}])
                                                .addField('#word', [{
																validator: (value, fields) => true
												}])
                                                .addField('#audio_phone', [{
																validator: (value, fields) => true
												}])
                                                .addField('#encoder_phone', [{
																validator: (value, fields) => true
												}])
                                                .addField('#mic_phone', [{
																validator: (value, fields) => true
												}])
                                                .addField('#upload', [{
																validator: (value, fields) => true
												}, ], {
																errorsContainer: '#document-error',
												})
												.onSuccess(async (event) => {
																var submitBtn = document.getElementById('submitBtn');
																submitBtn.innerHTML = spinner
																submitBtn.disabled = true;
                                                                try {
																				var formData = new FormData();
																				formData.append('name', document.getElementById('name').value)
																				formData.append('email', document.getElementById('email').value)
																				formData.append('phone', document.getElementById('phone').value)
																				formData.append('invoice_rate', document.getElementById('invoice_rate').value)
																				formData.append('address', document.getElementById('address').value)
																				formData.append('audio_phone', document.getElementById('audio_phone').value)
																				formData.append('encoder_phone', document.getElementById('encoder_phone').value)
																				formData.append('mic_phone', document.getElementById('mic_phone').value)
																				formData.append('notes', document.getElementById('notes').value)
                                                                                formData.append('line_placements', document.getElementById('line_placements').value)
                                                                                formData.append('word', document.getElementById('word').value)
																				for (let document_index = 0; document_index < pond.getFiles().length; document_index++) {
																				    formData.append('documents[]', pond.getFiles()[document_index].file)
																				}

																				const response = await axios.post('{{ route("client.update.post", $data->id) }}', formData)
																				successToast(response.data.message)
																				event.target.reset();
																				setInterval(window.location.replace("{{ route("client.paginate.get") }}"), 1500);
																				// setInterval(location.reload(), 1500);
																} catch (error) {
																				// console.log(error);
																				if (error?.response?.data?.errors?.name) {
																								validation.showErrors({
																												'#name': error?.response?.data?.errors?.name[0]
																								})
																				}
																				if (error?.response?.data?.errors?.email) {
																								validation.showErrors({
																												'#email': error?.response?.data?.errors?.email[0]
																								})
																				}
																				if (error?.response?.data?.errors?.phone) {
																								validation.showErrors({
																												'#phone': error?.response?.data?.errors?.phone[0]
																								})
																				}
																				if (error?.response?.data?.errors?.invoice_rate) {
																								validation.showErrors({
																												'#invoice_rate': error?.response?.data?.errors?.invoice_rate[0]
																								})
																				}
																				if (error?.response?.data?.errors?.address) {
																								validation.showErrors({
																												'#address': error?.response?.data?.errors?.address[0]
																								})
																				}
																				if (error?.response?.data?.errors?.audio_phone) {
																								validation.showErrors({
																												'#audio_phone': error?.response?.data?.errors?.audio_phone[0]
																								})
																				}
																				if (error?.response?.data?.errors?.encoder_phone) {
																								validation.showErrors({
																												'#encoder_phone': error?.response?.data?.errors?.encoder_phone[0]
																								})
																				}
																				if (error?.response?.data?.errors?.mic_phone) {
																								validation.showErrors({
																												'#mic_phone': error?.response?.data?.errors?.mic_phone[0]
																								})
																				}
																				if (error?.response?.data?.errors?.notes) {
																								validation.showErrors({
																												'#notes': error?.response?.data?.errors?.notes[0]
																								})
																				}
																				if (error?.response?.data?.errors?.line_placements) {
																								validation.showErrors({
																												'#line_placements': error?.response?.data?.errors?.line_placements[0]
																								})
																				}
																				if (error?.response?.data?.errors?.word) {
																								validation.showErrors({
																												'#word': error?.response?.data?.errors?.word[0]
																								})
																				}
																				if (error?.response?.data?.errors?.documents) {
																								validation.showErrors({
																												'.document-input': error?.response?.data?.errors?.documents[0]
																								})
																				}
																				if (error?.response?.data?.message) {
																								errorToast(error?.response?.data?.message)
																				}
																} finally {
																				submitBtn.innerHTML = `Save`
																				submitBtn.disabled = false;
																}
												});
				</script>

@stop
