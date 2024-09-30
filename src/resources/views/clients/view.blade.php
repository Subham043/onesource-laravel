@extends("layouts.main")

@section("content")
				<div>
								<div class="col-sm-12 col-lg-12">
												<form class="form-horizontal">
																<div class="card">
																				<div class="card-header d-flex justify-content-between">
																								<div class="header-title">
																												<h4 class="card-title">Client Details</h4>
																								</div>
																								<div>
																												<a href="{{ route("client.update.get", $data->id) }}" class="btn btn-primary">
																																Edit This Client
																												</a>
																												<a href="{{ route("dashboard.get") }}" class="btn btn-primary">Dashboard</a>
																								</div>
																				</div>
																				<div class="card-body">
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Name:</label>
																												<div class="col-sm-10">
																																{{ $data->name }}
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Email:</label>
																												<div class="col-sm-10">
																																{{ $data->email }}
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Phone:</label>
																												<div class="col-sm-10">
																																{{ $data->phone }}
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Invoice Rate:</label>
																												<div class="col-sm-10">
																																${{ $data->invoice_rate }}
																												</div>
																								</div>
                                                                                                <div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Audio Phone Number:</label>
																												<div class="col-sm-10">
																																{{ $data->audio_phone }}
																												</div>
																								</div>
                                                                                                <div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Encoder Phone Number:</label>
																												<div class="col-sm-10">
																																{{ $data->encoder_phone }}
																												</div>
																								</div>
                                                                                                <div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="eventName">MC Phone Number:</label>
																												<div class="col-sm-10">
																																{{ $data->mic_phone }}
																												</div>
																								</div>
																								{{-- <div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Onsite Billing
																																Rate:</label>
																												<div class="col-sm-10">
																																${{ $data->onsite_billing_rate }}
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Remote Billing
																																Rate:</label>
																												<div class="col-sm-10">
																																${{ $data->remote_billing_rate }}
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Setup Time
																																(minutes):</label>
																												<div class="col-sm-10">
																																{{ $data->setup_time }}
																												</div>
																								</div> --}}
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Address:</label>
																												<div class="col-sm-10">
																																{{ $data->address }}
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Line Placements:</label>
																												<div class="col-sm-10">
																																{{ $data->line_placements }}
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Notes:</label>
																												<div class="col-sm-10">
																																{{ $data->notes }}
																												</div>
																								</div>
																								<div class="form-group row">
																												<label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Words/Specifics:</label>
																												<div class="col-sm-10">
																																{{ $data->word }}
																												</div>
																								</div>
																				</div>
																</div>
                                                                <div class="card">
                                                                                @if ($data->documents->count() > 0)
                                                                                                <div class="card-header d-flex justify-content-between">
                                                                                                                <div class="header-title">
                                                                                                                                <h4 class="card-title">Documents</h4>
                                                                                                                </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                                <table id="basic-table" class="table-striped mb-0 mt-3 table" role="grid">
                                                                                                                                <thead>
                                                                                                                                                <tr>
                                                                                                                                                                <th>Document Name</th>
                                                                                                                                                                <th>&nbsp;</th>
                                                                                                                                                </tr>
                                                                                                                                </thead>
                                                                                                                                <tbody>
                                                                                                                                                @foreach ($data->documents as $document)
                                                                                                                                                                <tr>
                                                                                                                                                                                <td>
                                                                                                                                                                                                <div class="d-flex align-items-center">
                                                                                                                                                                                                                <a href="{{ $document->document_link }}"
                                                                                                                                                                                                                                download>{{ str_replace("storage/documents/", "", $document->document) }}</a>
                                                                                                                                                                                                </div>
                                                                                                                                                                                </td>
                                                                                                                                                                                <td>
                                                                                                                                                                                                @can("download documents")
                                                                                                                                                                                                                <a href="{{ $document->document_link }}" download data-bs-toggle="tooltip"
                                                                                                                                                                                                                                data-bs-original-title="Download Document"> <svg width="32"
                                                                                                                                                                                                                                                viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                                                                                                                                                                                <path opacity="0.4"
                                                                                                                                                                                                                                                                d="M17.554 7.29614C20.005 7.29614 22 9.35594 22 11.8876V16.9199C22 19.4453 20.01 21.5 17.564 21.5L6.448 21.5C3.996 21.5 2 19.4412 2 16.9096V11.8773C2 9.35181 3.991 7.29614 6.438 7.29614H7.378L17.554 7.29614Z"
                                                                                                                                                                                                                                                                fill="currentColor"></path>
                                                                                                                                                                                                                                                <path
                                                                                                                                                                                                                                                                d="M12.5464 16.0374L15.4554 13.0695C15.7554 12.7627 15.7554 12.2691 15.4534 11.9634C15.1514 11.6587 14.6644 11.6597 14.3644 11.9654L12.7714 13.5905L12.7714 3.2821C12.7714 2.85042 12.4264 2.5 12.0004 2.5C11.5754 2.5 11.2314 2.85042 11.2314 3.2821L11.2314 13.5905L9.63742 11.9654C9.33742 11.6597 8.85043 11.6587 8.54843 11.9634C8.39743 12.1168 8.32142 12.3168 8.32142 12.518C8.32142 12.717 8.39743 12.9171 8.54643 13.0695L11.4554 16.0374C11.6004 16.1847 11.7964 16.268 12.0004 16.268C12.2054 16.268 12.4014 16.1847 12.5464 16.0374Z"
                                                                                                                                                                                                                                                                fill="currentColor"></path>
                                                                                                                                                                                                                                </svg>
                                                                                                                                                                                                                </a>
                                                                                                                                                                                                @endcan
                                                                                                                                                                                                @can("delete documents")
																																																				<a href="#" class="remove-item-btn"
																																																								data-link="{{ route("client.document.delete", $document->id) }}"
																																																								data-bs-toggle="tooltip" data-bs-original-title="Delete Document">
																																																								<svg width="32" viewBox="0 0 24 24" fill="none"
																																																												xmlns="http://www.w3.org/2000/svg">
																																																												<path opacity="0.4"
																																																																d="M19.643 9.48851C19.643 9.5565 19.11 16.2973 18.8056 19.1342C18.615 20.8751 17.4927 21.9311 15.8092 21.9611C14.5157 21.9901 13.2494 22.0001 12.0036 22.0001C10.6809 22.0001 9.38741 21.9901 8.13185 21.9611C6.50477 21.9221 5.38147 20.8451 5.20057 19.1342C4.88741 16.2873 4.36418 9.5565 4.35445 9.48851C4.34473 9.28351 4.41086 9.08852 4.54507 8.93053C4.67734 8.78453 4.86796 8.69653 5.06831 8.69653H18.9388C19.1382 8.69653 19.3191 8.78453 19.4621 8.93053C19.5953 9.08852 19.6624 9.28351 19.643 9.48851Z"
																																																																fill="currentColor"></path>
																																																												<path
																																																																d="M21 5.97686C21 5.56588 20.6761 5.24389 20.2871 5.24389H17.3714C16.7781 5.24389 16.2627 4.8219 16.1304 4.22692L15.967 3.49795C15.7385 2.61698 14.9498 2 14.0647 2H9.93624C9.0415 2 8.26054 2.61698 8.02323 3.54595L7.87054 4.22792C7.7373 4.8219 7.22185 5.24389 6.62957 5.24389H3.71385C3.32386 5.24389 3 5.56588 3 5.97686V6.35685C3 6.75783 3.32386 7.08982 3.71385 7.08982H20.2871C20.6761 7.08982 21 6.75783 21 6.35685V5.97686Z"
																																																																fill="currentColor"></path>
																																																								</svg>
																																																				</a>
																																																@endcan
                                                                                                                                                                                </td>
                                                                                                                                                                </tr>
                                                                                                                                                @endforeach
                                                                                                                                </tbody>
                                                                                                                </table>
                                                                                                </div>
                                                                                @endif

                                                                </div>
												</form>
								</div>
				</div>
@stop
