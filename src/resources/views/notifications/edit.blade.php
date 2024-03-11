@extends('layouts.main')

@section('content')
<div>
    <div class="col-sm-12 col-lg-12">
        <form id="loginForm" method="POST" action="{{route('notification.update.post', $notification->id)}}" class="form-horizontal">
            @csrf
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Update Notification</h4>
                    </div>
                    <div>
                        @can('add notifications')
                        <a href="{{route('notification.template.get')}}" class="btn btn-primary">Template</a>
                        @endcan
                        @can('add notifications')
                        <a href="{{route('notification.log.get')}}" class="btn btn-primary">Logs</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="label">Label:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="label" name="label" value="{{$notification->label}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="">Recurring Type:</label>
                        <div class="col-sm-10">
                            <div id="recurring-error"></div>
                            <div class="form-group row align-items-center">
                                <div class="col-lg-2 col-md-3 col-sm-12">
                                    <input class="form-check-input" type="radio" value="Daily" id="recurring_type_daily" name="recurring_type" {{!empty($notification->recurring_type) && $notification->recurring_type->value=='Daily' ? 'checked' : ''}}>
                                    <label class="form-check-label" for="recurring_type_daily">
                                        Daily :
                                    </label>
                                </div>
                                <div class="col-lg-10 col-md-9 col-sm-12">
                                    <div class="d-flex align-items-center mb-2">
                                        <input class="form-check-input col-auto" type="radio" value="First" id="recurring_daily_type_days" name="recurring_daily_type" {{!empty($notification->recurring_daily_type) && $notification->recurring_daily_type->value=='First' ? 'checked' : ''}}>
                                        <label class="form-check-label mx-1 col-8" for="recurring_daily_type_days">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="col-auto">Every</span> <input type="text" class="form-control col-auto" style="width: 70px;text-align:center" id="recurring_daily_days" name="recurring_daily_days" value="{{$notification->recurring_daily_days}}"> <span class="col-auto">days</span>
                                            </div>
                                        </label>
                                    </div>
                                    <div>
                                        <input class="form-check-input" type="radio" value="Second" id="recurring_daily_type_weekday" name="recurring_daily_type" {{!empty($notification->recurring_daily_type) && $notification->recurring_daily_type->value=='Second' ? 'checked' : ''}}>
                                        <label class="form-check-label" for="recurring_daily_type_weekday">
                                            Every weekday
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <div class="col-lg-2 col-md-3 col-sm-12">
                                    <input class="form-check-input" type="radio" value="Weekly" id="recurring_type_weekly" name="recurring_type" {{!empty($notification->recurring_type) && $notification->recurring_type->value=='Weekly' ? 'checked' : ''}}>
                                    <label class="form-check-label" for="recurring_type_weekly">
                                        Weekly :
                                    </label>
                                </div>
                                <div class="col-lg-10 col-md-9 col-sm-12">
                                    <div class="d-flex align-items-center mb-2">
                                        <label class="form-check-label mx-1 col-8">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="col-auto">Recur every</span> <input type="text" class="form-control col-auto" style="width: 70px;text-align:center" id="recurring_weekly_weeks" name="recurring_weekly_weeks" value="{{$notification->recurring_weekly_weeks}}"> <span class="col-auto">week(s) on:</span>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="col-auto">
                                            <input class="form-check-input" type="checkbox" value="true" id="recurring_weekly_sunday" name="recurring_weekly_sunday" {{!empty($notification->recurring_weekly_sunday) && $notification->recurring_weekly_sunday ? 'checked' : ''}}>
                                            <label class="form-check-label" for="recurring_weekly_sunday">
                                                Sun
                                            </label>
                                        </div>
                                        <div class="col-auto">
                                            <input class="form-check-input" type="checkbox" value="true" id="recurring_weekly_monday" name="recurring_weekly_monday" {{!empty($notification->recurring_weekly_monday) && $notification->recurring_weekly_monday ? 'checked' : ''}}>
                                            <label class="form-check-label" for="recurring_weekly_monday">
                                                Mon
                                            </label>
                                        </div>
                                        <div class="col-auto">
                                            <input class="form-check-input" type="checkbox" value="true" id="recurring_weekly_tuesday" name="recurring_weekly_tuesday" {{!empty($notification->recurring_weekly_tuesday) && $notification->recurring_weekly_tuesday ? 'checked' : ''}}>
                                            <label class="form-check-label" for="recurring_weekly_tuesday">
                                                Tue
                                            </label>
                                        </div>
                                        <div class="col-auto">
                                            <input class="form-check-input" type="checkbox" value="true" id="recurring_weekly_wednesday" name="recurring_weekly_wednesday" {{!empty($notification->recurring_weekly_wednesday) && $notification->recurring_weekly_wednesday ? 'checked' : ''}}>
                                            <label class="form-check-label" for="recurring_weekly_wednesday">
                                                Wed
                                            </label>
                                        </div>
                                        <div class="col-auto">
                                            <input class="form-check-input" type="checkbox" value="true" id="recurring_weekly_thursday" name="recurring_weekly_thursday" {{!empty($notification->recurring_weekly_thursday) && $notification->recurring_weekly_thursday ? 'checked' : ''}}>
                                            <label class="form-check-label" for="recurring_weekly_thursday">
                                                Thu
                                            </label>
                                        </div>
                                        <div class="col-auto">
                                            <input class="form-check-input" type="checkbox" value="true" id="recurring_weekly_friday" name="recurring_weekly_friday" {{!empty($notification->recurring_weekly_friday) && $notification->recurring_weekly_friday ? 'checked' : ''}}>
                                            <label class="form-check-label" for="recurring_weekly_friday">
                                                Fri
                                            </label>
                                        </div>
                                        <div class="col-auto">
                                            <input class="form-check-input" type="checkbox" value="true" id="recurring_weekly_saturday" name="recurring_weekly_saturday" {{!empty($notification->recurring_weekly_saturday) && $notification->recurring_weekly_saturday ? 'checked' : ''}}>
                                            <label class="form-check-label" for="recurring_weekly_saturday">
                                                Sat
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row noborder align-items-center">
                                <div class="col-lg-2 col-md-3 col-sm-12">
                                    <input class="form-check-input" type="radio" value="Monthly" id="recurring_type_monthly" name="recurring_type" {{!empty($notification->recurring_type) && $notification->recurring_type->value=='Monthly' ? 'checked' : ''}}>
                                    <label class="form-check-label" for="recurring_type_monthly">
                                        Monthly :
                                    </label>
                                </div>
                                <div class="col-lg-10 col-md-9 col-sm-12">
                                    <div class="d-flex align-items-center mb-2">
                                        <input class="form-check-input col-auto" type="radio" value="First" id="recurring_monthly_type_days" name="recurring_monthly_type" {{!empty($notification->recurring_monthly_type) && $notification->recurring_monthly_type->value=='First' ? 'checked' : ''}}>
                                        <label class="form-check-label mx-1 col-8" for="recurring_monthly_type_days">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="col-auto">Day</span> <input type="text" class="form-control col-auto" style="width: 70px;text-align:center" id="recurring_monthly_first_days" name="recurring_monthly_first_days" value="{{$notification->recurring_monthly_first_days}}"> <span class="col-auto">of every</span> <input type="text" class="form-control col-auto" style="width: 70px;text-align:center" id="recurring_monthly_first_months" name="recurring_monthly_first_months" value="{{$notification->recurring_monthly_first_months}}"> <span class="col-auto">month(s)</span>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <input class="form-check-input col-auto" type="radio" value="Second" id="recurring_monthly_type_months" name="recurring_monthly_type" {{!empty($notification->recurring_monthly_type) && $notification->recurring_monthly_type->value=='Second' ? 'checked' : ''}}>
                                        <label class="form-check-label mx-1 col-8" for="recurring_monthly_type_months">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="col-auto">The</span>
                                                <select class="form-select shadow-none" style="width: 170px" name="recurring_monthly_second_type" id="recurring_monthly_second_type">
                                                    <option value="First" {{!empty($notification->recurring_monthly_second_type) && $notification->recurring_monthly_second_type->value=='First' ? 'selected' : ''}}>First</option>
                                                    <option value="Second" {{!empty($notification->recurring_monthly_second_type) && $notification->recurring_monthly_second_type->value=='Second' ? 'selected' : ''}}>Second</option>
                                                    <option value="Third" {{!empty($notification->recurring_monthly_second_type) && $notification->recurring_monthly_second_type->value=='Third' ? 'selected' : ''}}>Third</option>
                                                    <option value="Fourth" {{!empty($notification->recurring_monthly_second_type) && $notification->recurring_monthly_second_type->value=='Fourth' ? 'selected' : ''}}>Fourth</option>
                                                </select>
                                                <select class="form-select shadow-none" style="width: 170px" name="recurring_monthly_second_days" id="recurring_monthly_second_days">
                                                    <option value="Sunday" {{!empty($notification->recurring_monthly_second_days) && $notification->recurring_monthly_second_days->value=='Sunday' ? 'selected' : ''}}>Sunday</option>
                                                    <option value="Monday" {{!empty($notification->recurring_monthly_second_days) && $notification->recurring_monthly_second_days->value=='Monday' ? 'selected' : ''}}>Monday</option>
                                                    <option value="Tuesday" {{!empty($notification->recurring_monthly_second_days) && $notification->recurring_monthly_second_days->value=='Tuesday' ? 'selected' : ''}}>Tuesday</option>
                                                    <option value="Wednesday" {{!empty($notification->recurring_monthly_second_days) && $notification->recurring_monthly_second_days->value=='Wednesday' ? 'selected' : ''}}>Wednesday</option>
                                                    <option value="Thursday" {{!empty($notification->recurring_monthly_second_days) && $notification->recurring_monthly_second_days->value=='Thursday' ? 'selected' : ''}}>Thursday</option>
                                                    <option value="Friday" {{!empty($notification->recurring_monthly_second_days) && $notification->recurring_monthly_second_days->value=='Friday' ? 'selected' : ''}}>Friday</option>
                                                    <option value="Saturday" {{!empty($notification->recurring_monthly_second_days) && $notification->recurring_monthly_second_days->value=='Saturday' ? 'selected' : ''}}>Saturday</option>
                                                </select>
                                                <span class="col-auto">of every</span>
                                                <input type="text" class="form-control col-auto" style="width: 70px;text-align:center" id="recurring_monthly_second_months" name="recurring_monthly_second_months" value="{{$notification->recurring_monthly_second_months}}">
                                                <span class="col-auto">month(s)</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="submitBtn">Update Notification</button>
                    <a href="{{route('notification.paginate.get')}}" class="btn btn-warning" id="submitBtn">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@stop

@section('javascript')

<script type="text/javascript" nonce="{{ csp_nonce() }}">

document.addEventListener("keydown", (e) => {
  if ((e.metaKey || e.ctrlKey) && e.key === "s") {
    e.preventDefault();
    document.getElementById('submitBtn').click();
    return false;
  }
});

// initialize the validation library
const validation = new JustValidate('#loginForm', {
      errorFieldCssClass: 'is-invalid',
      focusInvalidField: true,
      lockForm: true,
});
// apply rules to form fields
validation
  .addField('#label', [
    {
      rule: 'required',
      errorMessage: 'Label is required',
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
        formData.append('label',document.getElementById('label').value)
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
        }
        const response = await axios.post('{{route('notification.update.post', $notification->id)}}', formData)
        successToast(response.data.message)
        setInterval(window.location.replace("{{route('notification.paginate.get')}}"), 1500);
    }catch (error){
        if(error?.response?.data?.errors?.label){
            validation.showErrors({'#label': error?.response?.data?.errors?.label[0]})
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
        if(error?.response?.data?.message){
            errorToast(error?.response?.data?.message)
        }
    }finally{
        submitBtn.innerHTML =  `
            Update Notification
            `
        submitBtn.disabled = false;
    }
  });
</script>

@stop
