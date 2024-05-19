@extends("layouts.main")

@section("content")
				<div class="row">
								<div class="col-md-12">
												<div class="row">
																<div class="col-md-12 col-lg-12">
																				<div class="card overflow-hidden" data-aos="fade-up" data-aos-delay="600">
																								<div class="card-header d-flex justify-content-between flex-wrap">
																												<div class="header-title">
																																<h4 class="card-title mb-2">Clients</h4>
																												</div>
																												<div>
																																<a href="{{ route("client.create.get") }}" class="btn btn-primary">Add Client</a>
																																<a href="{{ route("dashboard.get") }}" class="btn btn-primary">Dashboard</a>
																												</div>
																								</div>
																								<div class="card-body p-0">
																												@if ($data->total() > 0)
																																<div class="table-responsive mt-4">
																																				<table id="basic-table" class="table-striped mb-0 table" role="grid">
																																								<thead>
																																												<tr>
																																																<th> Name</th>
																																																<th> Email</th>
																																																<th> Phone</th>
																																																<th> Onsite Billing Rate</th>
																																																<th> Remote Billing Rate</th>
																																																<th> Setup Time (minutes)</th>

																																																<th>&nbsp;</th>
																																												</tr>
																																								</thead>
																																								<tbody>
																																												@foreach ($data->items() as $item)
																																																<tr>
																																																				<td>
																																																								<div class="d-flex align-items-center">
																																																												<a
																																																																href="{{ route("user.view.get", 1) }}">{{ $item->name }}</a>
																																																								</div>
																																																				</td>
																																																				<td>
																																																								<div class="d-flex align-items-center">
																																																												{{ $item->email }}
																																																								</div>
																																																				</td>
																																																				<td>
																																																								<div class="d-flex align-items-center">
																																																												{{ $item->phone }}
																																																								</div>
																																																				</td>
																																																				<td>
																																																								<div class="d-flex align-items-center">
																																																												${{ $item->onsite_billing_rate }}
																																																								</div>
																																																				</td>
																																																				<td>
																																																								<div class="d-flex align-items-center">
																																																												${{ $item->remote_billing_rate }}
																																																								</div>
																																																				</td>
																																																				<td>
																																																								<div class="d-flex align-items-center">
																																																												${{ $item->setup_time }}
																																																								</div>
																																																				</td>

																																																				<td>
																																																								@can("view clients")
																																																												<a href="{{ route("client.view.get", $item->id) }}" class=""
																																																																data-bs-toggle="tooltip" data-bs-original-title="View Client">
																																																																<svg width="32" viewBox="0 0 24 24" fill="none"
																																																																				xmlns="http://www.w3.org/2000/svg">
																																																																				<path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd"
																																																																								d="M17.7366 6.04606C19.4439 7.36388 20.8976 9.29455 21.9415 11.7091C22.0195 11.8924 22.0195 12.1067 21.9415 12.2812C19.8537 17.1103 16.1366 20 12 20H11.9902C7.86341 20 4.14634 17.1103 2.05854 12.2812C1.98049 12.1067 1.98049 11.8924 2.05854 11.7091C4.14634 6.87903 7.86341 4 11.9902 4H12C14.0683 4 16.0293 4.71758 17.7366 6.04606ZM8.09756 12C8.09756 14.1333 9.8439 15.8691 12 15.8691C14.1463 15.8691 15.8927 14.1333 15.8927 12C15.8927 9.85697 14.1463 8.12121 12 8.12121C9.8439 8.12121 8.09756 9.85697 8.09756 12Z"
																																																																								fill="currentColor"></path>
																																																																				<path
																																																																								d="M14.4308 11.997C14.4308 13.3255 13.3381 14.4115 12.0015 14.4115C10.6552 14.4115 9.5625 13.3255 9.5625 11.997C9.5625 11.8321 9.58201 11.678 9.61128 11.5228H9.66006C10.743 11.5228 11.621 10.6695 11.6601 9.60184C11.7674 9.58342 11.8845 9.57275 12.0015 9.57275C13.3381 9.57275 14.4308 10.6588 14.4308 11.997Z"
																																																																								fill="currentColor"></path>
																																																																</svg>
																																																												</a>
																																																								@endcan

																																																								@can("edit clients")
																																																												<a href="{{ route("client.update.get", $item->id) }}"
																																																																class="" data-bs-toggle="tooltip"
																																																																data-bs-original-title="Edit Client">
																																																																<svg width="32" viewBox="0 0 24 24" fill="none"
																																																																				xmlns="http://www.w3.org/2000/svg">
																																																																				<path opacity="0.4"
																																																																								d="M16.6643 21.9897H7.33488C5.88835 22.0796 4.46781 21.5781 3.3989 20.6011C2.4219 19.5312 1.92041 18.1107 2.01032 16.6652V7.33482C1.92041 5.88932 2.4209 4.46878 3.3979 3.39889C4.46781 2.42189 5.88835 1.92041 7.33488 2.01032H16.6643C18.1089 1.92041 19.5284 2.4209 20.5973 3.39789C21.5733 4.46878 22.0758 5.88832 21.9899 7.33482V16.6652C22.0788 18.1107 21.5783 19.5312 20.6013 20.6011C19.5314 21.5781 18.1109 22.0796 16.6643 21.9897Z"
																																																																								fill="currentColor"></path>
																																																																				<path
																																																																								d="M17.0545 10.3976L10.5018 16.9829C10.161 17.3146 9.7131 17.5 9.24574 17.5H6.95762C6.83105 17.5 6.71421 17.4512 6.62658 17.3634C6.53895 17.2756 6.5 17.1585 6.5 17.0317L6.55842 14.7195C6.56816 14.261 6.75315 13.8317 7.07446 13.5098L11.7189 8.8561C11.7967 8.77805 11.9331 8.77805 12.011 8.8561L13.6399 10.4785C13.747 10.5849 13.9028 10.6541 14.0683 10.6541C14.4286 10.6541 14.7109 10.3615 14.7109 10.0102C14.7109 9.83463 14.6428 9.67854 14.5357 9.56146C14.5065 9.52244 12.9554 7.97805 12.9554 7.97805C12.858 7.88049 12.858 7.71463 12.9554 7.61707L13.6078 6.95366C14.2114 6.34878 15.1851 6.34878 15.7888 6.95366L17.0545 8.22195C17.6485 8.81707 17.6485 9.79268 17.0545 10.3976Z"
																																																																								fill="currentColor"></path>
																																																																</svg>
																																																												</a>
																																																								@endcan

																																																								@can("delete clients")
																																																												<a href="#" class="remove-item-btn"
																																																																data-link="{{ route("client.delete.get", $item->id) }}"
																																																																data-bs-toggle="tooltip" data-bs-original-title="Delete Client">
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
