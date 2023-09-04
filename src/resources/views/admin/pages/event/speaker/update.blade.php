@extends('admin.layouts.dashboard')

@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- qualificationt page title -->
        @can('list events')
        @include('admin.includes.breadcrumb', ['page'=>'Speaker', 'page_link'=>route('event.speaker.paginate.get'), 'list'=>['Update']])
        @endcan
        <!-- end page title -->

        <div class="row" id="image-container">
            @include('admin.includes.back_button', ['link'=>route('event.speaker.paginate.get')])
            <div class="col-lg-12">
                <form id="countryForm" method="post" action="{{route('event.speaker.update.post', $data->id)}}" enctype="multipart/form-data">
                @csrf
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Speaker Detail</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-xxl-4 col-md-4">
                                        @include('admin.includes.input', ['key'=>'name', 'label'=>'Name', 'value'=>$data->name])
                                    </div>
                                    <div class="col-xxl-4 col-md-4">
                                        @include('admin.includes.input', ['key'=>'designation', 'label'=>'Designation', 'value'=>$data->designation])
                                    </div>
                                    <div class="col-xxl-4 col-md-4">
                                        @include('admin.includes.input', ['key'=>'qualification', 'label'=>'Qualification', 'value'=>$data->qualification])
                                    </div>
                                    <div class="col-xxl-4 col-md-4">
                                        @include('admin.includes.file_input', ['key'=>'image', 'label'=>'Image'])
                                        @if(!empty($data->image_link))
                                            <img src="{{$data->image_link}}" alt="" class="img-preview">
                                        @endif
                                    </div>
                                    <div class="col-xxl-4 col-md-4">
                                        @include('admin.includes.input', ['key'=>'image_title', 'label'=>'Image Title', 'value'=>$data->image_title])
                                    </div>
                                    <div class="col-xxl-4 col-md-4">
                                        @include('admin.includes.input', ['key'=>'image_alt', 'label'=>'Image Alt', 'value'=>$data->image_alt])
                                    </div>
                                    <div class="col-xxl-12 col-md-12">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light" id="submitBtn">Update</button>
                                    </div>

                                </div>
                                <!--end row-->
                            </div>

                        </div>
                    </div>

                </form>
            </div>
            <!--end col-->
        </div>
        <!--end row-->



    </div> <!-- container-fluid -->
</div><!-- End Page-content -->



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

<script type="text/javascript" nonce="{{ csp_nonce() }}">
// initialize the validation library
const validation = new JustValidate('#countryForm', {
      errorFieldCssClass: 'is-invalid',
});
// apply rules to form fields
validation
.addField('#name', [
    {
      rule: 'required',
      errorMessage: 'Name is required',
    },
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Name is invalid',
    },
  ])
  .addField('#designation', [
    {
      rule: 'required',
      errorMessage: 'Designation is required',
    },
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Designation is invalid',
    },
  ])
  .addField('#qualification', [
    {
        rule: 'required',
        errorMessage: 'Qualification is required',
    },
  ])
  .addField('#image', [
    {
        rule: 'minFilesCount',
        value: 0,
    },
    {
        rule: 'maxFilesCount',
        value: 1,
    },
    {
        rule: 'files',
        value: {
        files: {
            extensions: ['jpeg', 'jpg', 'png', 'webp'],
            maxSize: 500000,
            minSize: 1,
            types: ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'],
        },
        },
    },
  ])
  .addField('#image_title', [
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Image Title is invalid',
    },
  ])
  .addField('#image_alt', [
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Image Alt is invalid',
    },
  ])
  .onSuccess(async (event) => {
    var submitBtn = document.getElementById('submitBtn')
    submitBtn.innerHTML = spinner
    submitBtn.disabled = true;
    try {
        var formData = new FormData();
        formData.append('name',document.getElementById('name').value)
        formData.append('designation',document.getElementById('designation').value)
        formData.append('qualification',document.getElementById('qualification').value)
        formData.append('image_alt',document.getElementById('image_alt').value)
        formData.append('image_title',document.getElementById('image_title').value)
        if((document.getElementById('image').files).length>0){
            formData.append('image',document.getElementById('image').files[0])
        }
        const response = await axios.post('{{route('event.speaker.update.post', $data->id)}}', formData)
        successToast(response.data.message)
    }catch (error){
        if(error?.response?.data?.errors?.name){
            validation.showErrors({'#name': error?.response?.data?.errors?.name[0]})
        }
        if(error?.response?.data?.errors?.designation){
            validation.showErrors({'#designation': error?.response?.data?.errors?.designation[0]})
        }
        if(error?.response?.data?.errors?.qualification){
            validation.showErrors({'#qualification': error?.response?.data?.errors?.qualification[0]})
        }
        if(error?.response?.data?.errors?.image_alt){
            validation.showErrors({'#image_alt': error?.response?.data?.errors?.image_alt[0]})
        }
        if(error?.response?.data?.errors?.image_title){
            validation.showErrors({'#image_title': error?.response?.data?.errors?.image_title[0]})
        }
        if(error?.response?.data?.errors?.image){
            validation.showErrors({'#image': error?.response?.data?.errors?.image[0]})
        }
        if(error?.response?.data?.message){
            errorToast(error?.response?.data?.message)
        }
    }finally{
        submitBtn.innerHTML =  `
            Update
            `
        submitBtn.disabled = false;
    }
  });
</script>
@stop
