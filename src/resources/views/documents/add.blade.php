@extends('layouts.main')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/filepond.min.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/css/filepond-plugin-image-preview.min.css')}}" type="text/css" />
@stop

@section('content')
<div>
    <div class="col-sm-12 col-lg-12">
        <form id="loginForm" method="POST" action="{{route('document.create.post')}}" class="form-horizontal">
            @csrf
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Event Details</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="event">Event Name:</label>
                        <div class="col-sm-10">
                             <select class="form-select shadow-none" id="event" name="event">
                                <option selected="" value="">Select Event</option>
                                @foreach($events as $event)
                                <option value="{{$event->id}}">{{$event->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <div class="card pb-0 mb-0">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="header-title">
                            <h4 class="card-title">Documents</h4>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div id="document-error mt-2"></div>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            <input class="form-control filepond" type="file" name="upload" id="upload" multiple data-allow-reorder="true" data-max-file-size="5MB" data-max-files="3">
                        </div>
                    </div>
                    <div class="card my-0">
                        <div class="card-body pt-0">
                            <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                            <a href="{{route('document.paginate.get')}}" class="btn btn-warning" id="submitBtn">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@stop

@section('javascript')
<script src="{{ asset('assets/js/plugins/filepond.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/filepond-plugin-image-preview.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/filepond-plugin-file-validate-size.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/filepond-plugin-image-exif-orientation.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/filepond-plugin-file-encode.min.js') }}"></script>

<script type="text/javascript" nonce="{{ csp_nonce() }}">

FilePond.registerPlugin(FilePondPluginImagePreview);
const inputUploadElement = document.querySelector('#upload');
// Create the FilePond instance
const pond = FilePond.create(inputUploadElement,{allowMultiple: true});

// initialize the validation library
const validation = new JustValidate('#loginForm', {
      errorFieldCssClass: 'is-invalid',
      focusInvalidField: true,
      lockForm: true,
});
// apply rules to form fields
validation
  .addField('#event', [
    {
      rule: 'required',
      errorMessage: 'Event is required',
    },
  ])
  .addField('#upload', [
    {
        validator: (value, fields) => true
    },
  ], {
      errorsContainer: '#document-error',
    })
  .onSuccess(async(event) => {
    // event.target.submit();
    var submitBtn = document.getElementById('submitBtn');
    submitBtn.innerHTML = spinner
    submitBtn.disabled = true;
    try {
        var formData = new FormData();
        formData.append('event',document.getElementById('event').value)
        for (let document_index = 0; document_index < pond.getFiles().length; document_index++) {
            formData.append('documents[]',pond.getFiles()[document_index].file)
        }

        const response = await axios.post('{{route('document.create.post')}}', formData)
        successToast(response.data.message)
        event.target.reset();
        setInterval(window.location.replace("{{route('document.paginate.get')}}"), 1500);
    }catch (error){
        if(error?.response?.data?.errors?.event){
            validation.showErrors({'#event': error?.response?.data?.errors?.event[0]})
        }
        if(error?.response?.data?.errors?.documents){
            validation.showErrors({'#upload': error?.response?.data?.errors?.documents[0]})
        }
        if(error?.response?.data?.message){
            errorToast(error?.response?.data?.message)
        }
    }finally{
        submitBtn.innerHTML =  `
            Submit
            `
        submitBtn.disabled = false;
    }
  });

</script>
@stop
