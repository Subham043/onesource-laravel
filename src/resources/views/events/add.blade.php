@extends('layouts.main')

@section('content')
<div>
    <div class="col-sm-12 col-lg-12">
        <form id="loginForm" method="POST" action="{{route('event.create.post')}}" class="form-horizontal">
            @csrf
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Event Details</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Event Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="client">Client:</label>
                        <div class="col-sm-10">
                            <select class="form-select shadow-none" id="client" name="client">
                                <option selected value="">Select Client</option>
                                @foreach($clients as $client)
                                    <option value="{{$client->id}}">{{$client->name}}</option>
                                @endforeach
                            </select></div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="invRate">Invoice Rate:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="invoice_rate" name="invoice_rate">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="start_date">Start Date:</label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control" id="start_date" name="start_date">
                        </div>
                        <label class="control-label col-sm-2 align-self-center mb-0" for="start_time">Start Time:</label>
                        <div class="col-sm-3">
                            <input type="time" class="form-control" id="start_time" name="start_time">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="endt_date">End Date:</label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>
                        <label class="control-label col-sm-2 align-self-center mb-0" for="end_time">End Time:</label>
                        <div class="col-sm-3">
                            <input type="time" class="form-control" id="end_time" name="end_time">
                        </div>
                    </div>
                    <div class="form-group row noborder">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="is_recurring_event">Recurring Event:</label>
                        <div class="col-sm-10">
                            <input class="form-check-input" type="checkbox" value="1" id="is_recurring_event" name="is_recurring_event">
                        </div>
                        <div class="col-sm-12">
                            <div id="recurring-error"></div>
                        </div>
                    </div>
                    <div class="form-group row noborder">
                        <label class="control-label col-sm-2 align-self-center mb-0" for=""></label>
                        <div class="col-sm-10">
                            <input class="form-check-input" type="radio" value="Daily" id="recurring_type_daily" name="recurring_type">
                            <label class="form-check-label" for="recurring_type_daily">
                                Daily
                            </label>
                            <input class="form-check-input" type="radio" value="Weekly" id="recurring_type_weekly" name="recurring_type">
                            <label class="form-check-label" for="recurring_type_weekly">
                                Weekly
                            </label>
                            <input class="form-check-input" type="radio" value="Monthly" id="recurring_type_monthly" name="recurring_type">
                            <label class="form-check-label" for="recurring_type_monthly">
                                Monthly
                            </label>
                            <input class="form-check-input" type="radio" value="Yearly" id="recurring_type_yearly" name="recurring_type">
                            <label class="form-check-label" for="recurring_type_yearly">
                                Yearly
                            </label>
                            <div class="row mt-4">
                                <div class="col-sm-2"> <input class="form-check-input" type="radio" value="Every" name="recurring_type" id="recurring_type_every">
                                    <label class="form-check-label" for="recurring_type_every">
                                        Every
                                    </label>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="recurring_days" id="recurring_days">
                                </div>
                                <label class="control-label col-sm-2 align-self-center mb-0" for="recurring_days">Days</label>
                                <div class="col-sm-2">
                                    <input class="form-check-input" type="radio" value="Every Week Day" name="recurring_type" id="recurring_type_week_day">
                                    <label class="form-check-label" for="recurring_type_week_day">
                                        Every Week Day
                                    </label>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <label class="control-label col-sm-2 align-self-center mb-0" for="recurring_end_date">End Date:</label>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control" name="recurring_end_date" id="recurring_end_date"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card repeater-writer">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="header-title">
                        <h4 class="card-title">Assign Details</h4>
                    </div>
                    <div class="col-sm-auto">
                        <button data-repeater-create class="btn btn-primary" type="button">Add Writer</button>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div id="writer-error mt-2"></div>
                </div>
                <div class="card-body">
                    <div class="col-12" data-repeater-list="writer">
                        <div class="form-group row" data-repeater-item>
                            <label class="control-label col-sm-2 align-self-center mb-0">Writer:</label>
                            <div class="col-sm-4">
                                <select class="form-select shadow-none writer-id-input" name="writer_id[]">
                                    <option selected value="">Select Writer</option>
                                    @foreach($writers as $writer)
                                        <option value="{{$writer->id}}">{{$writer->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="control-label col-sm-2 align-self-center mb-0">Billing Rate:</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control billing-rate-input" name="billing_rate[]">
                            </div>
                            <div class="col-sm-1">
                                <button data-repeater-delete class="btn btn-danger" type="button">-</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card repeater-document">
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
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Notes</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <textarea class="form-control" id="notes" name="notes" aria-label="Notes"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" id="submitBtn">Create Event</button>
                    <a href="{{route('event.paginate.get')}}" class="btn btn-warning" id="submitBtn">Cancel</a>
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
  .addField('#name', [
    {
      rule: 'required',
      errorMessage: 'Name is required',
    },
  ])
  .addField('#client', [
    {
      rule: 'required',
      errorMessage: 'Client is required',
    },
  ])
  .addField('#invoice_rate', [
    {
      rule: 'required',
      errorMessage: 'Invoice Rate is required',
    },
  ])
  .addField('#start_date', [
    {
      rule: 'required',
      errorMessage: 'Start Date is required',
    },
  ])
  .addField('#start_time', [
    {
      rule: 'required',
      errorMessage: 'Start Time is required',
    },
  ])
  .addField('#end_date', [
    {
      rule: 'required',
      errorMessage: 'End Date is required',
    },
  ])
  .addField('#end_time', [
    {
      rule: 'required',
      errorMessage: 'End Time is required',
    },
  ])
  .addField('.writer-id-input', [
    {
        validator: (value, fields) => true
    },
  ],{
      errorsContainer: '#writer-error',
    })
  .addField('.billing-rate-input', [
    {
        validator: (value, fields) => true
    },
  ],{
      errorsContainer: '#writer-error',
    })
  .addField('.document-input', [
    {
        validator: (value, fields) => true
    },
  ], {
      errorsContainer: '#document-error',
    })
  .addField('#notes', [
    {
        validator: (value, fields) => true
    }
  ])
  .addField('#recurring_end_date', [
    {
        validator: (value, fields) => true
    },
  ])
  .addField('#recurring_days', [
    {
        validator: (value, fields) => true
    },
  ])
  .addField('#recurring_type_weekly', [
    {
        validator: (value, fields) => true
    },
  ],{
      errorsContainer: '#recurring-error',
    })
  .onSuccess(async(event) => {
    // event.target.submit();
    var submitBtn = document.getElementById('submitBtn');
    submitBtn.innerHTML = spinner
    submitBtn.disabled = true;
    try {
        var formData = new FormData();
        formData.append('name',document.getElementById('name').value)
        formData.append('client',document.getElementById('client').value)
        formData.append('invoice_rate',document.getElementById('invoice_rate').value)
        formData.append('start_date',document.getElementById('start_date').value)
        formData.append('end_date',document.getElementById('end_date').value)
        formData.append('start_time',document.getElementById('start_time').value)
        formData.append('end_time',document.getElementById('end_time').value)
        formData.append('notes',document.getElementById('notes').value)
        formData.append('is_recurring_event',document.getElementById('is_recurring_event').checked ? 1 : 0)
        if(document.getElementById('is_recurring_event').checked){
            if(document.querySelector('input[name="recurring_type"]:checked')){
                formData.append('recurring_type',document.querySelector('input[name="recurring_type"]:checked').value)
                if(document.querySelector('input[name="recurring_type"]:checked').value=="Every"){
                    formData.append('recurring_days',document.getElementById('recurring_days').value)
                }
            }
            formData.append('recurring_end_date',document.getElementById('recurring_end_date').value)
        }
        const writer_input_selector = document.querySelectorAll('.writer-id-input');
        const billing_rate_input_selector = document.querySelectorAll('.billing-rate-input');
        for (let writer_index = 0; writer_index < writer_input_selector.length; writer_index++) {
            formData.append('writer_ids[]',writer_input_selector[writer_index].value)
        }
        for (let billing_index = 0; billing_index < billing_rate_input_selector.length; billing_index++) {
            formData.append('billing_rates[]',billing_rate_input_selector[billing_index].value)
        }
        const document_input_selector = document.querySelectorAll('.document-input');
        for (let document_index = 0; document_index < document_input_selector.length; document_index++) {
            if((document_input_selector[document_index].files).length>0){
                formData.append('documents[]',document_input_selector[document_index].files[0])
            }
        }

        const response = await axios.post('{{route('event.create.post')}}', formData)
        successToast(response.data.message)
        event.target.reset();
        setInterval(window.location.replace("{{route('event.paginate.get')}}"), 1500);
        // setInterval(location.reload(), 1500);
    }catch (error){
        if(error?.response?.data?.errors?.name){
            validation.showErrors({'#name': error?.response?.data?.errors?.name[0]})
        }
        if(error?.response?.data?.errors?.client){
            validation.showErrors({'#client': error?.response?.data?.errors?.client[0]})
        }
        if(error?.response?.data?.errors?.invoice_rate){
            validation.showErrors({'#invoice_rate': error?.response?.data?.errors?.invoice_rate[0]})
        }
        if(error?.response?.data?.errors?.start_date){
            validation.showErrors({'#start_date': error?.response?.data?.errors?.start_date[0]})
        }
        if(error?.response?.data?.errors?.end_date){
            validation.showErrors({'#end_date': error?.response?.data?.errors?.end_date[0]})
        }
        if(error?.response?.data?.errors?.start_time){
            validation.showErrors({'#start_time': error?.response?.data?.errors?.start_time[0]})
        }
        if(error?.response?.data?.errors?.end_time){
            validation.showErrors({'#end_time': error?.response?.data?.errors?.end_time[0]})
        }
        if(error?.response?.data?.errors?.recurring_days){
            validation.showErrors({'#recurring_days': error?.response?.data?.errors?.recurring_days[0]})
        }
        if(error?.response?.data?.errors?.recurring_end_date){
            validation.showErrors({'#recurring_end_date': error?.response?.data?.errors?.recurring_end_date[0]})
        }
        if(error?.response?.data?.errors?.notes){
            validation.showErrors({'#notes': error?.response?.data?.errors?.notes[0]})
        }
        if(error?.response?.data?.errors?.recurring_type){
            validation.showErrors({'#recurring_type_weekly': error?.response?.data?.errors?.recurring_type[0]})
        }
        if(error?.response?.data?.errors?.documents){
            validation.showErrors({'.document-input': error?.response?.data?.errors?.documents[0]})
        }
        if(error?.response?.data?.errors?.writer_ids){
            validation.showErrors({'.writer-id-input': error?.response?.data?.errors?.writer_ids[0]})
        }
        if(error?.response?.data?.errors?.billing_rates){
            validation.showErrors({'.billing-rate-input': error?.response?.data?.errors?.billing_rates[0]})
        }
        if(error?.response?.data?.message){
            errorToast(error?.response?.data?.message)
        }
    }finally{
        submitBtn.innerHTML =  `
            Create Event
            `
        submitBtn.disabled = false;
    }
  });


(function( $ ) {
    $(document).ready(function() {
        $('.repeater-writer').repeater({
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
