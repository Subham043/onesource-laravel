@extends('layouts.main')

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
                <div class="card repeater-document pb-0 mb-0">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="header-title">
                            <h4 class="card-title">Documents</h4>
                        </div>
                        <div class="col-sm-auto">
                            <button data-repeater-create class="btn btn-primary" type="button">Add Document</button>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div id="document-error mt-2"></div>
                    </div>
                    <div class="card-body" data-repeater-list="documents">
                        <div class="form-group row justify-content-between" data-repeater-item>
                            <div class="col-sm-11">
                                <input class="form-control document-input" type="file" name="document[]">
                            </div>
                            <div class="col-sm-1">
                                <button data-repeater-delete class="btn btn-danger" type="button">-</button>
                            </div>
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
<script src="{{asset('assets/js/plugins/jquery.js')}}"></script>
<script src="{{asset('assets/js/plugins/jquery.repeater.js')}}"></script>

<script type="text/javascript" nonce="{{ csp_nonce() }}">

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
  .addField('.document-input', [
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
        const document_input_selector = document.querySelectorAll('.document-input');
        for (let document_index = 0; document_index < document_input_selector.length; document_index++) {
            if((document_input_selector[document_index].files).length>0){
                formData.append('documents[]',document_input_selector[document_index].files[0])
            }
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
            validation.showErrors({'.document-input': error?.response?.data?.errors?.documents[0]})
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


(function( $ ) {
    $(document).ready(function() {
        $('.repeater-document').repeater({
            initEmpty:false,
            isFirstItemUndeletable: true,
            show: function () {
                $(this).slideDown();
            },
            hide: function (deleteElement) {
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
                        ['<button><b>YES</b></button>', function (instance, toast) {

                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                            $(this).slideUp(deleteElement);

                        }, true],
                        ['<button>NO</button>', function (instance, toast) {

                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                        }],
                    ],
                    onClosing: function(instance, toast, closedBy){
                        console.info('Closing | closedBy: ' + closedBy);
                    },
                    onClosed: function(instance, toast, closedBy){
                        console.info('Closed | closedBy: ' + closedBy);
                    }
                });
            },
            ready: function (setIndexes) {
            }
        });
    });
})(jQuery);
</script>
@stop
