@extends('layouts.main')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/select2.min.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/css/filepond.min.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/css/filepond-plugin-image-preview.min.css')}}" type="text/css" />
@stop

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
                        <label class="control-label col-sm-2 align-self-center mb-0" for="invRate">Invoice Rate: <span data-bs-toggle="tooltip" data-bs-original-title="Invoice rate should look like 000.00 (no dollar sign)"><i class="icon">
                            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='currentColor'><circle cx='6' cy='6' r='4.5'/><path stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/><circle cx='6' cy='8.2' r='.6' fill='currentColor' stroke='none'/></svg>
                       </i></span></label>
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
                        <label class="control-label col-sm-2 align-self-center mb-0" for="end_date">End Date:</label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>
                        <label class="control-label col-sm-2 align-self-center mb-0" for="end_time">End Time:</label>
                        <div class="col-sm-3">
                            <input type="time" class="form-control" id="end_time" name="end_time">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="is_recurring_event">Recurring Event:</label>
                        <div class="col-sm-10">
                            <input class="form-check-input" type="checkbox" value="1" id="is_recurring_event" name="is_recurring_event">
                        </div>
                    </div>
                    <div id="recurring_block_div" class="form-group row noborder d-none">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="">Recurring Type:</label>
                        <div class="col-sm-10">
                            <div id="recurring-error"></div>
                            <div class="form-group row align-items-center">
                                <div class="col-lg-2 col-md-3 col-sm-12">
                                    <input class="form-check-input" type="radio" value="Daily" id="recurring_type_daily" name="recurring_type">
                                    <label class="form-check-label" for="recurring_type_daily">
                                        Daily
                                    </label>
                                </div>
                                <div class="col-lg-10 col-md-9 col-sm-12 d-none" id="recurring_type_daily_options">
                                    <div class="d-flex align-items-center mb-2">
                                        <input class="form-check-input col-auto" type="radio" value="First" id="recurring_daily_type_days" name="recurring_daily_type">
                                        <label class="form-check-label mx-1 col-8" for="recurring_daily_type_days">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="col-auto">Every</span> <input type="text" class="form-control col-auto" style="width: 70px;text-align:center" id="recurring_daily_days" name="recurring_daily_days" value="1"> <span class="col-auto">days</span>
                                            </div>
                                        </label>
                                    </div>
                                    <div>
                                        <input class="form-check-input" type="radio" value="Second" id="recurring_daily_type_weekday" name="recurring_daily_type">
                                        <label class="form-check-label" for="recurring_daily_type_weekday">
                                            Every weekday
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <div class="col-lg-2 col-md-3 col-sm-12">
                                    <input class="form-check-input" type="radio" value="Weekly" id="recurring_type_weekly" name="recurring_type">
                                    <label class="form-check-label" for="recurring_type_weekly">
                                        Weekly
                                    </label>
                                </div>
                                <div class="col-lg-10 col-md-9 col-sm-12 d-none" id="recurring_type_weekly_options">
                                    <div class="d-flex align-items-center mb-2">
                                        <label class="form-check-label mx-1 col-8">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="col-auto">Recur every</span> <input type="text" class="form-control col-auto" style="width: 70px;text-align:center" id="recurring_weekly_weeks" name="recurring_weekly_weeks" value="1"> <span class="col-auto">week(s) on:</span>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="col-auto">
                                            <input class="form-check-input" type="checkbox" value="true" id="recurring_weekly_sunday" name="recurring_weekly_sunday">
                                            <label class="form-check-label" for="recurring_weekly_sunday">
                                                Sun
                                            </label>
                                        </div>
                                        <div class="col-auto">
                                            <input class="form-check-input" type="checkbox" value="true" id="recurring_weekly_monday" name="recurring_weekly_monday">
                                            <label class="form-check-label" for="recurring_weekly_monday">
                                                Mon
                                            </label>
                                        </div>
                                        <div class="col-auto">
                                            <input class="form-check-input" type="checkbox" value="true" id="recurring_weekly_tuesday" name="recurring_weekly_tuesday">
                                            <label class="form-check-label" for="recurring_weekly_tuesday">
                                                Tue
                                            </label>
                                        </div>
                                        <div class="col-auto">
                                            <input class="form-check-input" type="checkbox" value="true" id="recurring_weekly_wednesday" name="recurring_weekly_wednesday">
                                            <label class="form-check-label" for="recurring_weekly_wednesday">
                                                Wed
                                            </label>
                                        </div>
                                        <div class="col-auto">
                                            <input class="form-check-input" type="checkbox" value="true" id="recurring_weekly_thursday" name="recurring_weekly_thursday">
                                            <label class="form-check-label" for="recurring_weekly_thursday">
                                                Thu
                                            </label>
                                        </div>
                                        <div class="col-auto">
                                            <input class="form-check-input" type="checkbox" value="true" id="recurring_weekly_friday" name="recurring_weekly_friday">
                                            <label class="form-check-label" for="recurring_weekly_friday">
                                                Fri
                                            </label>
                                        </div>
                                        <div class="col-auto">
                                            <input class="form-check-input" type="checkbox" value="true" id="recurring_weekly_saturday" name="recurring_weekly_saturday">
                                            <label class="form-check-label" for="recurring_weekly_saturday">
                                                Sat
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <div class="col-lg-2 col-md-3 col-sm-12">
                                    <input class="form-check-input" type="radio" value="Monthly" id="recurring_type_monthly" name="recurring_type">
                                    <label class="form-check-label" for="recurring_type_monthly">
                                        Monthly
                                    </label>
                                </div>
                                <div class="col-lg-10 col-md-9 col-sm-12 d-none" id="recurring_type_monthly_options">
                                    <div class="d-flex align-items-center mb-2">
                                        <input class="form-check-input col-auto" type="radio" value="First" id="recurring_monthly_type_days" name="recurring_monthly_type">
                                        <label class="form-check-label mx-1 col-8" for="recurring_monthly_type_days">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="col-auto">Day</span> <input type="text" class="form-control col-auto" style="width: 70px;text-align:center" id="recurring_monthly_first_days" name="recurring_monthly_first_days" value="1"> <span class="col-auto">of every</span> <input type="text" class="form-control col-auto" style="width: 70px;text-align:center" id="recurring_monthly_first_months" name="recurring_monthly_first_months" value="1"> <span class="col-auto">month(s)</span>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <input class="form-check-input col-auto" type="radio" value="Second" id="recurring_monthly_type_months" name="recurring_monthly_type">
                                        <label class="form-check-label mx-1 col-8" for="recurring_monthly_type_months">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="col-auto">The</span>
                                                <select class="form-select shadow-none" style="width: 170px" name="recurring_monthly_second_type" id="recurring_monthly_second_type">
                                                    <option value="First">First</option>
                                                    <option value="Second">Second</option>
                                                    <option value="Third">Third</option>
                                                    <option value="Fourth">Fourth</option>
                                                </select>
                                                <select class="form-select shadow-none" style="width: 170px" name="recurring_monthly_second_days" id="recurring_monthly_second_days">
                                                    <option value="Sunday">Sunday</option>
                                                    <option value="Monday">Monday</option>
                                                    <option value="Tuesday">Tuesday</option>
                                                    <option value="Wednesday">Wednesday</option>
                                                    <option value="Thursday">Thursday</option>
                                                    <option value="Friday">Friday</option>
                                                    <option value="Saturday">Saturday</option>
                                                </select>
                                                <span class="col-auto">of every</span>
                                                <input type="text" class="form-control col-auto" style="width: 70px;text-align:center" id="recurring_monthly_second_months" name="recurring_monthly_second_months" value="1">
                                                <span class="col-auto">month(s)</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-0 align-items-center">
                                <div class="col-lg-2 col-md-3 col-sm-12">
                                    <input class="form-check-input" type="radio" value="Yearly" id="recurring_type_yearly" name="recurring_type">
                                    <label class="form-check-label" for="recurring_type_yearly">
                                        Yearly
                                    </label>
                                </div>
                                <div class="col-lg-10 col-md-9 col-sm-12 d-none" id="recurring_type_yearly_options">
                                    <div class="d-flex align-items-center mb-2">
                                        <label class="form-check-label mx-1 col-8">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="col-auto">Every</span>
                                                <select class="form-select shadow-none" style="width: 170px" name="recurring_yearly_months" id="recurring_yearly_months">
                                                    <option value="1">January</option>
                                                    <option value="2">February</option>
                                                    <option value="3">March</option>
                                                    <option value="4">April</option>
                                                    <option value="5">May</option>
                                                    <option value="6">June</option>
                                                    <option value="7">July</option>
                                                    <option value="8">August</option>
                                                    <option value="9">September</option>
                                                    <option value="10">October</option>
                                                    <option value="11">November</option>
                                                    <option value="12">December</option>
                                                </select>
                                                <input type="text" class="form-control col-auto" style="width: 70px;text-align:center" id="recurring_yearly_days" name="recurring_yearly_days" value="1">
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="recurring_block_time_div" class="form-group row d-none">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="recurring_end_date">Recurring End Date:</label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control" id="recurring_end_date" name="recurring_end_date">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="fuzion_id">1FUZION:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fuzion_id" name="fuzion_id">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="is_active">Active:</label>
                        <div class="col-sm-10">
                            <select class="form-select shadow-none" id="is_active" name="is_active">
                                <option selected value="1">YES</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row noborder">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="is_prep_ready">Is Prep Ready:</label>
                        <div class="col-sm-10">
                            <select class="form-select shadow-none" id="is_prep_ready" name="is_prep_ready">
                                <option value="1">YES</option>
                                <option selected value="0">No</option>
                            </select>
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
                        <div class="form-group row align-items-center" data-repeater-item>
                            <label class="control-label col-sm-2 align-self-center mb-0">Writer:</label>
                            <div class="col-sm-4">
                                <select class="form-select shadow-none writer-id-input" name="writer_id[]">
                                    <option selected value="">Select Writer</option>
                                    @foreach($writers as $writer)
                                        <option value="{{$writer->id}}">{{$writer->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="control-label col-sm-2 align-self-center mb-0">Billing Rate: <span data-bs-toggle="tooltip" data-bs-original-title="Billing rate should look like 000.00 (no dollar sign)"><i class="icon">
                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='currentColor'><circle cx='6' cy='6' r='4.5'/><path stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/><circle cx='6' cy='8.2' r='.6' fill='currentColor' stroke='none'/></svg>
                           </i></span></label>
                            <div class="col-sm-3 billing-rate-div">
                                <input type="text" class="form-control billing-rate-input" name="billing_rate[]">
                            </div>
                            <div class="col-sm-1">
                                <button data-repeater-delete class="btn btn-danger" type="button">-</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
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
<script src="{{ asset('assets/js/plugins/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/filepond.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/filepond-plugin-image-preview.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/filepond-plugin-file-validate-size.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/filepond-plugin-image-exif-orientation.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/filepond-plugin-file-encode.min.js') }}"></script>

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
const pond = FilePond.create(inputUploadElement,{allowMultiple: true});

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
  .addField('#upload', [
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
  .addField('#fuzion_id', [
    {
        validator: (value, fields) => true
    },
  ])
  .addField('#recurring_end_date', [
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
        formData.append('fuzion_id',document.getElementById('fuzion_id').value)
        formData.append('client',document.getElementById('client').value)
        formData.append('invoice_rate',document.getElementById('invoice_rate').value)
        formData.append('start_date',document.getElementById('start_date').value)
        formData.append('start_time',document.getElementById('start_time').value)
        formData.append('end_date',document.getElementById('end_date').value)
        formData.append('end_time',document.getElementById('end_time').value)
        formData.append('notes',document.getElementById('notes').value)
        formData.append('is_active',document.getElementById('is_active').value)
        formData.append('is_prep_ready',document.getElementById('is_prep_ready').value)
        formData.append('is_recurring_event',document.getElementById('is_recurring_event').checked ? 1 : 0)
        if(document.getElementById('is_recurring_event').checked){
            formData.append('recurring_end_date',document.getElementById('recurring_end_date').value)
            if(document.querySelector('input[name="recurring_type"]:checked')){
                formData.append('recurring_type',document.querySelector('input[name="recurring_type"]:checked').value)
                if(document.querySelector('input[name="recurring_type"]:checked').value=="Daily"){
                    if(document.querySelector('input[name="recurring_daily_type"]:checked')){
                        formData.append('recurring_daily_type',document.querySelector('input[name="recurring_daily_type"]:checked').value)
                        if(document.querySelector('input[name="recurring_daily_type"]:checked') && document.querySelector('input[name="recurring_daily_type"]:checked').value=="First"){
                            formData.append('recurring_daily_days',document.getElementById('recurring_daily_days').value)
                        }
                    }
                }
                if(document.querySelector('input[name="recurring_type"]:checked').value=="Weekly"){
                    formData.append('recurring_weekly_weeks',document.getElementById('recurring_weekly_weeks').value)
                    formData.append('recurring_weekly_sunday',document.getElementById('recurring_weekly_sunday').checked ? 1 : 0)
                    formData.append('recurring_weekly_monday',document.getElementById('recurring_weekly_monday').checked ? 1 : 0)
                    formData.append('recurring_weekly_tuesday',document.getElementById('recurring_weekly_tuesday').checked ? 1 : 0)
                    formData.append('recurring_weekly_wednesday',document.getElementById('recurring_weekly_wednesday').checked ? 1 : 0)
                    formData.append('recurring_weekly_thursday',document.getElementById('recurring_weekly_thursday').checked ? 1 : 0)
                    formData.append('recurring_weekly_friday',document.getElementById('recurring_weekly_friday').checked ? 1 : 0)
                    formData.append('recurring_weekly_saturday',document.getElementById('recurring_weekly_saturday').checked ? 1 : 0)
                }
                if(document.querySelector('input[name="recurring_type"]:checked').value=="Monthly"){
                    if(document.querySelector('input[name="recurring_monthly_type"]:checked')){
                        formData.append('recurring_monthly_type',document.querySelector('input[name="recurring_monthly_type"]:checked').value)
                        if(document.querySelector('input[name="recurring_monthly_type"]:checked') && document.querySelector('input[name="recurring_monthly_type"]:checked').value=="First"){
                            formData.append('recurring_monthly_first_days',document.getElementById('recurring_monthly_first_days').value)
                            formData.append('recurring_monthly_first_months',document.getElementById('recurring_monthly_first_months').value)
                        }
                        if(document.querySelector('input[name="recurring_monthly_type"]:checked').value=="Second"){
                            formData.append('recurring_monthly_second_type',document.getElementById('recurring_monthly_second_type').value)
                            formData.append('recurring_monthly_second_days',document.getElementById('recurring_monthly_second_days').value)
                            formData.append('recurring_monthly_second_months',document.getElementById('recurring_monthly_second_months').value)
                        }
                    }
                }
                if(document.querySelector('input[name="recurring_type"]:checked').value=="Yearly"){
                    formData.append('recurring_yearly_months',document.getElementById('recurring_yearly_months').value)
                    formData.append('recurring_yearly_days',document.getElementById('recurring_yearly_days').value)
                }
            }
        }
        const writer_input_selector = document.querySelectorAll('.writer-id-input');
        const billing_rate_input_selector = document.querySelectorAll('.billing-rate-input');
        for (let writer_index = 0; writer_index < writer_input_selector.length; writer_index++) {
            if(writer_input_selector[writer_index].value.length>0){
                formData.append('writer_ids[]',writer_input_selector[writer_index].value)
            }
        }
        for (let billing_index = 0; billing_index < billing_rate_input_selector.length; billing_index++) {
            if(billing_rate_input_selector[billing_index].value.length>0){
                formData.append('billing_rates[]',billing_rate_input_selector[billing_index].value)
            }
        }
        for (let document_index = 0; document_index < pond.getFiles().length; document_index++) {
            formData.append('documents[]',pond.getFiles()[document_index].file)
        }

        const response = await axios.post('{{route('event.create.post')}}', formData)
        successToast(response.data.message)
        event.target.reset();
        setInterval(window.location.replace("{{route('event.paginate.get')}}"), 1500);
        // setInterval(location.reload(), 1500);
    }catch (error){
        // console.log(error);
        if(error?.response?.data?.errors?.name){
            validation.showErrors({'#name': error?.response?.data?.errors?.name[0]})
        }
        if(error?.response?.data?.errors?.fuzion_id){
            validation.showErrors({'#fuzion_id': error?.response?.data?.errors?.fuzion_id[0]})
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
        if(error?.response?.data?.errors?.start_time){
            validation.showErrors({'#start_time': error?.response?.data?.errors?.start_time[0]})
        }
        if(error?.response?.data?.errors?.recurring_end_date){
            validation.showErrors({'#recurring_end_date': error?.response?.data?.errors?.recurring_end_date[0]})
        }
        if(error?.response?.data?.errors?.end_date){
            validation.showErrors({'#end_date': error?.response?.data?.errors?.end_date[0]})
        }
        if(error?.response?.data?.errors?.end_time){
            validation.showErrors({'#end_time': error?.response?.data?.errors?.end_time[0]})
        }
        if(error?.response?.data?.errors?.notes){
            validation.showErrors({'#notes': error?.response?.data?.errors?.notes[0]})
        }
        if(error?.response?.data?.errors?.recurring_type){
            validation.showErrors({'#recurring_type_weekly': error?.response?.data?.errors?.recurring_type[0]})
        }
        if(error?.response?.data?.errors?.recurring_daily_type){
            validation.showErrors({'#recurring_type_weekly': error?.response?.data?.errors?.recurring_daily_type[0]})
        }
        if(error?.response?.data?.errors?.recurring_daily_days){
            validation.showErrors({'#recurring_type_weekly': error?.response?.data?.errors?.recurring_daily_days[0]})
        }
        if(error?.response?.data?.errors?.recurring_weekly_weeks){
            validation.showErrors({'#recurring_type_weekly': error?.response?.data?.errors?.recurring_weekly_weeks[0]})
        }
        if(error?.response?.data?.errors?.recurring_monthly_type){
            validation.showErrors({'#recurring_type_weekly': error?.response?.data?.errors?.recurring_monthly_type[0]})
        }
        if(error?.response?.data?.errors?.recurring_monthly_first_days){
            validation.showErrors({'#recurring_type_weekly': error?.response?.data?.errors?.recurring_monthly_first_days[0]})
        }
        if(error?.response?.data?.errors?.recurring_monthly_first_months){
            validation.showErrors({'#recurring_type_weekly': error?.response?.data?.errors?.recurring_monthly_first_months[0]})
        }
        if(error?.response?.data?.errors?.recurring_monthly_second_type){
            validation.showErrors({'#recurring_type_weekly': error?.response?.data?.errors?.recurring_monthly_second_type[0]})
        }
        if(error?.response?.data?.errors?.recurring_monthly_second_days){
            validation.showErrors({'#recurring_type_weekly': error?.response?.data?.errors?.recurring_monthly_second_days[0]})
        }
        if(error?.response?.data?.errors?.recurring_monthly_second_months){
            validation.showErrors({'#recurring_type_weekly': error?.response?.data?.errors?.recurring_monthly_second_months[0]})
        }
        if(error?.response?.data?.errors?.recurring_yearly_months){
            validation.showErrors({'#recurring_type_weekly': error?.response?.data?.errors?.recurring_yearly_months[0]})
        }
        if(error?.response?.data?.errors?.recurring_yearly_days){
            validation.showErrors({'#recurring_type_weekly': error?.response?.data?.errors?.recurring_yearly_days[0]})
        }
        if(error?.response?.data?.errors?.recurring_weekly_sunday){
            validation.showErrors({'#recurring_type_weekly': error?.response?.data?.errors?.recurring_weekly_sunday[0]})
        }
        if(error?.response?.data?.errors?.recurring_weekly_monday){
            validation.showErrors({'#recurring_type_weekly': error?.response?.data?.errors?.recurring_weekly_monday[0]})
        }
        if(error?.response?.data?.errors?.recurring_weekly_tuesday){
            validation.showErrors({'#recurring_type_weekly': error?.response?.data?.errors?.recurring_weekly_tuesday[0]})
        }
        if(error?.response?.data?.errors?.recurring_weekly_wednesday){
            validation.showErrors({'#recurring_type_weekly': error?.response?.data?.errors?.recurring_weekly_wednesday[0]})
        }
        if(error?.response?.data?.errors?.recurring_weekly_thursday){
            validation.showErrors({'#recurring_type_weekly': error?.response?.data?.errors?.recurring_weekly_thursday[0]})
        }
        if(error?.response?.data?.errors?.recurring_weekly_friday){
            validation.showErrors({'#recurring_type_weekly': error?.response?.data?.errors?.recurring_weekly_friday[0]})
        }
        if(error?.response?.data?.errors?.recurring_weekly_sunday){
            validation.showErrors({'#recurring_type_weekly': error?.response?.data?.errors?.recurring_weekly_sunday[0]})
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

  document.getElementById('is_recurring_event').addEventListener("change", function(){
    if(document.getElementById('is_recurring_event').checked){
        document.getElementById('recurring_block_div').classList.add('d-flex');
        document.getElementById('recurring_block_div').classList.remove('d-none');
        document.getElementById('recurring_block_time_div').classList.add('d-flex');
        document.getElementById('recurring_block_time_div').classList.remove('d-none');
    }else{
        document.getElementById('recurring_block_div').classList.add('d-none');
        document.getElementById('recurring_block_div').classList.remove('d-flex');
        document.getElementById('recurring_block_time_div').classList.add('d-none');
        document.getElementById('recurring_block_time_div').classList.remove('d-flex');
    }
  });

  document.getElementById('recurring_type_daily').addEventListener("change", function(){
    if(document.getElementById('recurring_type_daily').checked){
        document.getElementById('recurring_type_daily_options').classList.add('d-block');
        document.getElementById('recurring_type_daily_options').classList.remove('d-none');
        document.getElementById('recurring_type_yearly_options').classList.add('d-none');
        document.getElementById('recurring_type_yearly_options').classList.remove('d-block');
        document.getElementById('recurring_type_monthly_options').classList.add('d-none');
        document.getElementById('recurring_type_monthly_options').classList.remove('d-block');
        document.getElementById('recurring_type_weekly_options').classList.add('d-none');
        document.getElementById('recurring_type_weekly_options').classList.remove('d-block');
    }
  });

  document.getElementById('recurring_type_weekly').addEventListener("change", function(){
    if(document.getElementById('recurring_type_weekly').checked){
        document.getElementById('recurring_type_weekly_options').classList.add('d-block');
        document.getElementById('recurring_type_weekly_options').classList.remove('d-none');
        document.getElementById('recurring_type_yearly_options').classList.add('d-none');
        document.getElementById('recurring_type_yearly_options').classList.remove('d-block');
        document.getElementById('recurring_type_monthly_options').classList.add('d-none');
        document.getElementById('recurring_type_monthly_options').classList.remove('d-block');
        document.getElementById('recurring_type_daily_options').classList.add('d-none');
        document.getElementById('recurring_type_daily_options').classList.remove('d-block');
    }
  });

  document.getElementById('recurring_type_monthly').addEventListener("change", function(){
    if(document.getElementById('recurring_type_monthly').checked){
        document.getElementById('recurring_type_monthly_options').classList.add('d-block');
        document.getElementById('recurring_type_monthly_options').classList.remove('d-none');
        document.getElementById('recurring_type_yearly_options').classList.add('d-none');
        document.getElementById('recurring_type_yearly_options').classList.remove('d-block');
        document.getElementById('recurring_type_weekly_options').classList.add('d-none');
        document.getElementById('recurring_type_weekly_options').classList.remove('d-block');
        document.getElementById('recurring_type_daily_options').classList.add('d-none');
        document.getElementById('recurring_type_daily_options').classList.remove('d-block');
    }
  });

  document.getElementById('recurring_type_yearly').addEventListener("change", function(){
    if(document.getElementById('recurring_type_yearly').checked){
        document.getElementById('recurring_type_yearly_options').classList.add('d-block');
        document.getElementById('recurring_type_yearly_options').classList.remove('d-none');
        document.getElementById('recurring_type_monthly_options').classList.add('d-none');
        document.getElementById('recurring_type_monthly_options').classList.remove('d-block');
        document.getElementById('recurring_type_weekly_options').classList.add('d-none');
        document.getElementById('recurring_type_weekly_options').classList.remove('d-block');
        document.getElementById('recurring_type_daily_options').classList.add('d-none');
        document.getElementById('recurring_type_daily_options').classList.remove('d-block');
    }
  });


(function( $ ) {
    // $('.js-example-basic-single').select2();

    // $('.writer-id-input').on('input', function () {
    //     const data = @json($writers);
    //     const event = data.filter((item)=>item.id==$(this).val());
    //     if(event.length>0){
    //         $(this).parent().parent().find('.billing-rate-div .billing-rate-input').val(event[0].member_profile_created_by_auth.billing_rate);
    //     }else{
    //         $(this).parent().parent().find('.billing-rate-div .billing-rate-input').val('');
    //     }
    // });
    // $('#client').on('input', function () {
    //     const data = @json($clients);
    //     const event = data.filter((item)=>item.id==$(this).val());
    //     if(event.length>0){
    //         $('#invoice_rate').val(event[0].member_profile_created_by_auth.billing_rate);
    //     }else{
    //         $('#invoice_rate').val('');
    //     }
    // });
    $(document).ready(function() {
        $('.repeater-writer').repeater({
            initEmpty:true,
            isFirstItemUndeletable: true,
            show: function () {
                var dd = $(this).children().children();
                $(this).slideDown();
                $('.writer-id-input').on('input', function () {
                    const data = @json($writers);
                    const event = data.filter((item)=>item.id==$(this).val());
                    if(event.length>0){
                        $(this).parent().parent().find('.billing-rate-div .billing-rate-input').val(event[0].member_profile_created_by_auth.billing_rate);
                    }else{
                        $(this).parent().parent().find('.billing-rate-div .billing-rate-input').val('');
                    }
                });
                // $('.js-example-basic-single').select2("destroy");
                $('select[name="'+dd[0].attributes.name.nodeValue+'"]').select2();
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
                    onClosing: function(instance, toast, closedBy){},
                    onClosed: function(instance, toast, closedBy){}
                });
            },
            ready: function (setIndexes) {}
        });
    });
})(jQuery);
</script>

@stop
