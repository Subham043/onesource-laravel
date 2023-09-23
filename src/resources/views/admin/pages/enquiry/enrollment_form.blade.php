@extends('admin.layouts.dashboard')



@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        @include('admin.includes.breadcrumb', ['page'=>'Enrollment Form Enquiry', 'page_link'=>route('enquiry.enrollment_form.paginate.get'), 'list'=>['List']])
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Enrollment Form Enquiry</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="customerList">
                            <div class="row g-4 mb-3">
                                <div class="col-sm-auto">
                                    <a href="{{route('enquiry.enrollment_form.excel.get')}}" download type="button" class="btn btn-info add-btn" id="create-btn"><i class="ri-file-excel-fill align-bottom me-1"></i> Excel Download</a>
                                </div>
                                <div class="col-sm">
                                    @include('admin.includes.search_list', ['link'=>route('enquiry.enrollment_form.paginate.get'), 'search'=>$search])
                                </div>
                            </div>
                            <div class="table-responsive table-card mt-3 mb-1" id="image-container">
                                @if($data->total() > 0)
                                <table class="table align-middle table-nowrap" id="customerTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="sort" data-sort="customer_name">Name</th>
                                            <th class="sort" data-sort="customer_name">Email</th>
                                            <th class="sort" data-sort="customer_name">Phone</th>
                                            <th class="sort" data-sort="customer_name">Course</th>
                                            <th class="sort" data-sort="customer_name">Branch</th>
                                            <th class="sort" data-sort="customer_name">Amount</th>
                                            <th class="sort" data-sort="customer_name">Payment Status</th>
                                            <th class="sort" data-sort="date">Created On</th>
                                            <th class="sort" data-sort="action">Action</th>
                                            </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @foreach ($data->items() as $item)
                                        <tr>
                                            <td class="customer_name">{{$item->name}}</td>
                                            <td class="customer_name">{{$item->email}}</td>
                                            <td class="customer_name">{{$item->phone}}</td>
                                            <td class="customer_name">{{$item->course->name}}</td>
                                            <td class="customer_name">{{$item->branch->name}}</td>
                                            <td class="customer_name">{{$item->discounted_amount}}</td>
                                            <td class="customer_name">{{$item->payment_status->value}}</td>
                                            <td class="date">{{$item->created_at->diffForHumans()}}</td>
                                            <td>
                                                <div class="d-flex gap-2">

                                                    @can('delete enquiries')
                                                    <div class="remove">
                                                        <button class="btn btn-sm btn-danger remove-item-btn" data-link="{{route('enquiry.enrollment_form.delete.get', $item->id)}}">Delete</button>
                                                    </div>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                @else
                                    @include('admin.includes.no_result')
                                @endif
                            </div>
                            {{$data->onEachSide(5)->links('admin.includes.pagination')}}
                        </div>
                    </div><!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div>
</div>

@stop
