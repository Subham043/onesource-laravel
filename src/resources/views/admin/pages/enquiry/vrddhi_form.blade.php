@extends('admin.layouts.dashboard')



@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        @include('admin.includes.breadcrumb', ['page'=>'Vrddhi Form', 'page_link'=>route('enquiry.vrddhi_form.paginate.get'), 'list'=>['List']])
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Vrddhi Form</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="customerList">
                            <div class="row g-4 mb-3">
                                <div class="col-sm-auto">
                                    <a href="{{route('enquiry.vrddhi_form.excel.get')}}" download type="button" class="btn btn-info add-btn" id="create-btn"><i class="ri-file-excel-fill align-bottom me-1"></i> Excel Download</a>
                                </div>
                                <div class="col-sm">
                                    @include('admin.includes.search_list', ['link'=>route('enquiry.vrddhi_form.paginate.get'), 'search'=>$search])
                                </div>
                            </div>
                            <div class="table-responsive table-card mt-3 mb-1" id="image-container">
                                @if($data->total() > 0)
                                <table class="table align-middle table-nowrap" id="customerTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="sort" data-sort="customer_name">Name</th>
                                            <th class="sort" data-sort="customer_name">School Name</th>
                                            <th class="sort" data-sort="customer_name">Phone</th>
                                            <th class="sort" data-sort="customer_name">Father's Name</th>
                                            <th class="sort" data-sort="customer_name">Father's Email</th>
                                            <th class="sort" data-sort="customer_name">Father's Phone</th>
                                            <th class="sort" data-sort="customer_name">Mother's Name</th>
                                            <th class="sort" data-sort="customer_name">Mother's Email</th>
                                            <th class="sort" data-sort="customer_name">Mother's Phone</th>
                                            <th class="sort" data-sort="customer_name">Class</th>
                                            <th class="sort" data-sort="customer_name">Syllabus</th>
                                            <th class="sort" data-sort="customer_name">ID Card</th>
                                            <th class="sort" data-sort="date">Created On</th>
                                            <th class="sort" data-sort="action">Action</th>
                                            </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @foreach ($data->items() as $item)
                                        <tr>
                                            <td class="customer_name">{{$item->name}}</td>
                                            <td class="customer_name">{{$item->school_name}}</td>
                                            <td class="customer_name">{{$item->phone}}</td>
                                            <td class="customer_name">{{$item->father_name}}</td>
                                            <td class="customer_name">{{$item->father_email}}</td>
                                            <td class="customer_name">{{$item->father_phone}}</td>
                                            <td class="customer_name">{{$item->mother_name}}</td>
                                            <td class="customer_name">{{$item->mother_email}}</td>
                                            <td class="customer_name">{{$item->mother_phone}}</td>
                                            <td class="customer_name">{{$item->class}}</td>
                                            <td class="customer_name">{{$item->syllabus}}</td>
                                            <td class="customer_name">
                                                @if(!empty($item->card_link))
                                                    <img src="{{$item->card_link}}" alt="" class="img-preview">
                                                @endif
                                            </td>
                                            <td class="date">{{$item->created_at->diffForHumans()}}</td>
                                            <td>
                                                <div class="d-flex gap-2">

                                                    @can('delete enquiries')
                                                    <div class="remove">
                                                        <button class="btn btn-sm btn-danger remove-item-btn" data-link="{{route('enquiry.vrddhi_form.delete.get', $item->id)}}">Delete</button>
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


@section('javascript')
<script type="text/javascript" nonce="{{ csp_nonce() }}">
    const myViewer = new ImgPreviewer('#image-container',{
      // aspect ratio of image
        fillRatio: 0.9,
        // attribute that holds the image
        dataUrlKey: 'src',
        // additional styles
        style: {
            modalOpacity: 0.6,
            headerOpacity: 0,
            zIndex: 99
        },
        // zoom options
        imageZoom: {
            min: 0.1,
            max: 5,
            step: 0.1
        },
        // detect whether the parent element of the image is hidden by the css style
        bubblingLevel: 0,
    });
</script>
@stop
