@extends('layouts.main')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/select2.min.css')}}" type="text/css" />
<style nonce="{{ csp_nonce() }}">
    .select2-container{
        width: 100% !important;
    }
</style>
@stop

@section('content')
<div>
    <div class="col-sm-12 col-lg-12">
        <form id="loginForm" method="post" action="{{route('notification.send.post')}}" class="form-horizontal">
            @csrf
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Send Notification</h4>
                    </div>
                    <div>
                        @can('add events')
                        <a href="{{route('notification.paginate.get')}}" class="btn btn-primary">Settings</a>
                        @endcan
                        @can('add events')
                        <a href="{{route('notification.template.get')}}" class="btn btn-primary">Template</a>
                        @endcan
                        @can('add events')
                        <a href="{{route('event.create.get')}}" class="btn btn-primary">Logs</a>
                        @endcan
                        <a href="{{route('dashboard.get')}}" class="btn btn-primary">Return To Dashboard</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Sent Notification to :</label>
                        <div class="col-sm-10">
                            <input class="form-check-input" type="radio" name="notificationType" id="clientNotification" value="client" checked>
                            <label class="form-check-label" for="clientNotification">
                                Client
                            </label>
                            <input class="form-check-input" type="radio" name="notificationType" id="writerNotification" value="writer">
                            <label class="form-check-label" for="writerNotification">
                                Writer
                            </label>

                        </div>
                    </div>
                    <div id="notification-type-error"></div>
                    <div class="form-group row" id="client-wrapper">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="client">Client:</label>
                        <div class="col-sm-10">
                            <select class="form-select shadow-none" id="client" name="client">
                                <option selected value="">Select Client</option>
                                @foreach($clients as $client)
                                    <option value="{{$client->id}}">{{$client->name}}</option>
                                @endforeach
                            </select></div>
                    </div>
                    <div class="form-group row d-none" id="writer-wrapper">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="writer">Writer:</label>
                        <div class="col-sm-10">
                            <select class="form-select shadow-none" id="writer" name="writer">
                                <option selected value="">Select Writer</option>
                                @foreach($writers as $writer)
                                    <option value="{{$writer->id}}">{{$writer->name}}</option>
                                @endforeach
                            </select></div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="submitBtn">Send Notification</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop

@section('javascript')
<script src="{{asset('assets/js/plugins/jquery.js')}}"></script>
<script src="{{ asset('assets/js/plugins/select2.min.js') }}"></script>

<script type="text/javascript" nonce="{{ csp_nonce() }}">

  document.querySelector('#clientNotification').addEventListener("input", function(){
    if(document.querySelector('#clientNotification').checked){
        document.getElementById('client-wrapper').classList.remove('d-none');
        document.getElementById('writer-wrapper').classList.add('d-none');
    }else{
        document.getElementById('writer-wrapper').classList.remove('d-none');
        document.getElementById('client-wrapper').classList.add('d-none');
    }
  });

  document.querySelector('#writerNotification').addEventListener("input", function(){
    if(document.querySelector('#writerNotification').checked){
        document.getElementById('writer-wrapper').classList.remove('d-none');
        document.getElementById('client-wrapper').classList.add('d-none');
    }else{
        document.getElementById('client-wrapper').classList.remove('d-none');
        document.getElementById('writer-wrapper').classList.add('d-none');
    }
  });

    const validation = new JustValidate('#loginForm', {
      errorFieldCssClass: 'is-invalid',
      focusInvalidField: true,
      lockForm: true,
    });

    // apply rules to form fields
validation
  .addField('#clientNotification', [
    {
        validator: (value, fields) => true
    },
  ],{
      errorsContainer: '#notification-type-error',
    })
  .addField('#writer', [
    {
        validator: (value, fields) => true
    },
  ])
  .addField('#client', [
    {
        validator: (value, fields) => true
    },
  ])
  .onSuccess(async(event) => {
    // event.target.submit();
    var submitBtn = document.getElementById('submitBtn');
    submitBtn.innerHTML = spinner
    submitBtn.disabled = true;
    try {
        var formData = new FormData();
        if(document.querySelector('input[name="notificationType"]:checked')){
            formData.append('notificationType',document.querySelector('input[name="notificationType"]:checked').value)
            if(document.querySelector('input[name="notificationType"]:checked').value=="client"){
                formData.append('client',document.getElementById('client').value)
            }else{
                formData.append('writer',document.getElementById('writer').value)
            }
        }
        const response = await axios.post('{{route('notification.send.post')}}', formData)
        successToast(response.data.message)
        // event.target.reset();
        // setInterval(window.location.replace("{{route('notification.paginate.get')}}"), 1500);
        // setInterval(location.reload(), 1500);
    }catch (error){
        // console.log(error);
        if(error?.response?.data?.errors?.notificationType){
            validation.showErrors({'#clientNotification': error?.response?.data?.errors?.notificationType[0]})
        }
        if(error?.response?.data?.errors?.writer){
            validation.showErrors({'#writer': error?.response?.data?.errors?.writer[0]})
        }
        if(error?.response?.data?.errors?.client){
            validation.showErrors({'#client': error?.response?.data?.errors?.client[0]})
        }
        if(error?.response?.data?.message){
            errorToast(error?.response?.data?.message)
        }
    }finally{
        submitBtn.innerHTML =  `
            Send Notification
            `
        submitBtn.disabled = false;
    }
  });


(function( $ ) {
    $('#client').select2();
    $('#writer').select2();
})(jQuery);
</script>

@stop
