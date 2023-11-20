@extends('layouts.main')

@section('content')
<div>
    <div class="col-sm-12 col-lg-12">
        <form id="loginForm" method="POST" action="{{route('user.update.post', $data->id)}}" class="form-horizontal">
            @csrf
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">User Details</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="name">Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="name"
                                value="{{$data->name}}">
                                @error('name')
                                    <div class="invalid-message">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="email">Email ID:</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" readonly disabled aria-describedby="email"
                                value="{{$data->email}}">
                                @error('email')
                                    <div class="invalid-message">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="phone">Phone: <span data-bs-toggle="tooltip" data-bs-original-title="Phone Format: No dashes (0001234567)"><i class="icon">
                            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='currentColor'><circle cx='6' cy='6' r='4.5'/><path stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/><circle cx='6' cy='8.2' r='.6' fill='currentColor' stroke='none'/></svg>
                       </i></span></label>
                        <div class="col-sm-10">
                            <input type="tel" class="form-control" id="phone" name="phone" readonly disabled aria-describedby="phone"
                                value="{{$data->phone}}">
                                @error('phone')
                                    <div class="invalid-message">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="phone">Role:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="role" name="role" readonly disabled aria-describedby="role"
                                value="{{$data->current_role}}">
                                @error('role')
                                    <div class="invalid-message">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="timezone">Time Zone :</label>
                        <div class="col-sm-10">
                            <select id="timezone" name="timezone" class="form-select shadow-none">
                                <option value="" {{empty($data->timezone) ? 'selected' : ''}}>Select</option>
                                <option value="Pacific/Honolulu GMT-10:00" {{!empty($data->timezone) && $data->timezone->value == 'Pacific/Honolulu GMT-10:00' ? 'selected' : ''}}>Pacific/Honolulu GMT-10:00</option>
                                <option value="America/Anchorage GMT-9:00" {{!empty($data->timezone) && $data->timezone->value == 'America/Anchorage GMT-9:00' ? 'selected' : ''}}>America/Anchorage GMT-9:00</option>
                                <option value="America/Los_Angeles GMT-8:00" {{!empty($data->timezone) && $data->timezone->value == 'America/Los_Angeles GMT-8:00' ? 'selected' : ''}}>America/Los_Angeles GMT-8:00</option>
                                <option value="America/Boise GMT-7:00" {{!empty($data->timezone) && $data->timezone->value == 'America/Boise GMT-7:00' ? 'selected' : ''}}>America/Boise GMT-7:00</option>
                                <option value="America/Denver GMT-7:00" {{!empty($data->timezone) && $data->timezone->value == 'America/Denver GMT-7:00' ? 'selected' : ''}}>America/Denver GMT-7:00</option>
                                <option value="America/Phoenix GMT-7:00" {{!empty($data->timezone) && $data->timezone->value == 'America/Phoenix GMT-7:00' ? 'selected' : ''}}>America/Phoenix GMT-7:00</option>
                                <option value="America/Chicago GMT-6:00" {{!empty($data->timezone) && $data->timezone->value == 'America/Chicago GMT-6:00' ? 'selected' : ''}}>America/Chicago GMT-6:00</option>
                                <option value="America/Detroit GMT-5:00" {{!empty($data->timezone) && $data->timezone->value == 'America/Detroit GMT-5:00' ? 'selected' : ''}}>America/Detroit GMT-5:00</option>
                                <option value="America/New_York GMT-5:00" {{!empty($data->timezone) && $data->timezone->value == 'America/New_York GMT-5:00' ? 'selected' : ''}}>America/New_York GMT-5:00</option>
                            </select>
                            @error('timezone')
                                <div class="invalid-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div id="client_div" class="form-group row {{$data->current_role==='Client' ? 'd-flex' : 'd-none'}}">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="client">Client: <span data-bs-toggle="tooltip" data-bs-original-title="Shown Only If Role Is Client"><i class="icon">
                                     <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='currentColor'><circle cx='6' cy='6' r='4.5'/><path stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/><circle cx='6' cy='8.2' r='.6' fill='currentColor' stroke='none'/></svg>
                                </i></span></label>
                        <div class="col-sm-10">
                            <select id="client" name="client" class="form-select shadow-none">
                                <option value="" {{empty($data->member_profile_created_by_auth->client->id) ? 'selected' : ''}}>Select Client</option>
                                @foreach ($client as $item)
                                    <option value="{{$item->id}}" {{$data->member_profile_created_by_auth->client->id == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                            @error('client')
                                <div class="invalid-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div id="billing_rate_div" class="form-group row  {{$data->current_role==='Client' || $data->current_role==='Writer' ? 'd-flex' : 'd-none'}}">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="billing_rate">Billing Rate : <span data-bs-toggle="tooltip" data-bs-original-title="Billing rate should look like 000.00 (no dollar sign)"><i class="icon">
                                     <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='currentColor'><circle cx='6' cy='6' r='4.5'/><path stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/><circle cx='6' cy='8.2' r='.6' fill='currentColor' stroke='none'/></svg>
                                </i></span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="billing_rate" name="billing_rate" value="{{$data->member_profile_created_by_auth->billing_rate}}">
                            @error('billing_rate')
                                <div class="invalid-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div id="tool_div" class="form-group row  {{$data->current_role==='Writer' ? 'd-flex' : 'd-none'}}">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="tool">Tools :</label>
                        <div class="col-sm-10">
                            <select class="form-select shadow-none" id="tool" name="tool[]" multiple>
                                <option value="" {{empty($data->member_profile_created_by_auth->tools) ? 'selected' : ''}}>Select Tools</option>
                                @foreach ($tool as $item)
                                    <option value="{{$item->id}}" {{(collect($data->member_profile_created_by_auth->tools->pluck('id'))->contains($item->id)) ? 'selected' : ''}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" id="submitBtn" class="btn btn-primary">Update User</button>
                    <a href="{{route('user.paginate.get')}}" class="btn btn-warning" id="submitBtn">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@stop


@section('javascript')
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
  .addField('#timezone', [
    {
      rule: 'required',
      errorMessage: 'Timezone is required',
    },
  ])
  .addField('#role', [
    {
      rule: 'required',
      errorMessage: 'Role is required',
    },
  ])
  .addField('#client', [
    {
        validator: (value, fields) => {
        if (fields['#role'] && fields['#role'].elem) {
            const roleValue = fields['#role'].elem.value;

            if((roleValue === 'Client') && value.length==0){
                return false;
            }
            return true;
        }

            return true;
        },
        errorMessage: 'Client is required',
    },
  ])
  .addField('#billing_rate', [
    {
        validator: (value, fields) => {
        if (fields['#role'] && fields['#role'].elem) {
            const roleValue = fields['#role'].elem.value;

            if((roleValue === 'Client' || roleValue === 'Writer') && value.length==0){
                return false;
            }
            return true;
        }

            return true;
        },
        errorMessage: 'Billing rate is required',
    },
  ])
  .addField('#tool', [
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
        formData.append('name',document.getElementById('name').value)
        formData.append('timezone',document.getElementById('timezone').value)
        formData.append('role',document.getElementById('role').value)
        if(document.getElementById('role').value=='Client'){
            formData.append('client',document.getElementById('client').value)
            formData.append('billing_rate',document.getElementById('billing_rate').value)
        }
        if(document.getElementById('role').value=='Writer'){
            formData.append('billing_rate',document.getElementById('billing_rate').value)
            if(document.getElementById('tool')?.length>0){
                for (let index = 0; index < document.getElementById('tool').length; index++) {
                    if(document.getElementById('tool')[index].selected) {
                        formData.append('tool[]',document.getElementById('tool')[index].value)
                    }
                }
            }
        }

        const response = await axios.post('{{route('user.update.post', $data->id)}}', formData)
        successToast(response.data.message)
        setInterval(window.location.replace("{{route('user.paginate.get')}}"), 1500);
    }catch (error){
        if(error?.response?.data?.errors?.name){
            validation.showErrors({'#name': error?.response?.data?.errors?.name[0]})
        }
        if(error?.response?.data?.errors?.timezone){
            validation.showErrors({'#timezone': error?.response?.data?.errors?.timezone[0]})
        }
        if(error?.response?.data?.errors?.role){
            validation.showErrors({'#role': error?.response?.data?.errors?.role[0]})
        }
        if(error?.response?.data?.errors?.billing_rate){
            validation.showErrors({'#billing_rate': error?.response?.data?.errors?.billing_rate[0]})
        }
        if(error?.response?.data?.errors?.tool){
            validation.showErrors({'#tool': error?.response?.data?.errors?.tool[0]})
        }
        if(error?.response?.data?.errors?.client){
            validation.showErrors({'#client': error?.response?.data?.errors?.client[0]})
        }
        if(error?.response?.data?.message){
            errorToast(error?.response?.data?.message)
        }
    }finally{
        submitBtn.innerHTML =  `
            Update User
            `
        submitBtn.disabled = false;
    }
  });

  document.getElementById('role').addEventListener("change", function(){
    if(document.getElementById('role').value==='Client'){
        document.getElementById('client_div').classList.add('d-flex');
        document.getElementById('client_div').classList.remove('d-none');
    }else{
        document.getElementById('client_div').classList.add('d-none');
        document.getElementById('client_div').classList.remove('d-flex');
    }
    if(document.getElementById('role').value==='Writer'){
        document.getElementById('tool_div').classList.add('d-flex');
        document.getElementById('tool_div').classList.remove('d-none');
    }else{
        document.getElementById('tool_div').classList.add('d-none');
        document.getElementById('tool_div').classList.remove('d-flex');
    }
    if(document.getElementById('role').value==='Writer' || document.getElementById('role').value==='Client'){
        document.getElementById('billing_rate_div').classList.add('d-flex');
        document.getElementById('billing_rate_div').classList.remove('d-none');
    }else{
        document.getElementById('billing_rate_div').classList.add('d-none');
        document.getElementById('billing_rate_div').classList.remove('d-flex');
    }
  });
</script>

@stop
