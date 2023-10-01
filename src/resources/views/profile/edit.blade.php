@extends('layouts.main')

@section('content')
    <div>
        <div class="col-sm-12 col-lg-12">
            <form id="profileForm" method="POST" action="{{route('profile.edit.post')}}" class="form-horizontal">
                @csrf
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Profile Details</h4>
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
                            <label class="control-label col-sm-2 align-self-center mb-0" for="email">Email:</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="email"
                                    value="{{$data->email}}">
                                    @error('email')
                                        <div class="invalid-message">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-2 align-self-center mb-0" for="phone">Phone:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="phone" name="phone" aria-describedby="phone"
                                    value="{{$data->phone}}">
                                    @error('phone')
                                        <div class="invalid-message">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-2 align-self-center mb-0" for="old_password">Current Password:</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="old_password" name="old_password">
                                @error('old_password')
                                    <div class="invalid-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-2 align-self-center mb-0" for="password">Password:</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password" name="password">
                                @error('password')
                                    <div class="invalid-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-2 align-self-center mb-0" for="confirm_password">Confirm
                                Password:</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                                @error('confirm_password')
                                    <div class="invalid-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-sm-2 align-self-center mb-0" for="timezone">Time Zone
                                :</label>
                            <div class="col-sm-10">
                                <select class="form-select shadow-none" id="timezone" name="timezone">
                                    <option value="" {{empty(old('timezone')) ? 'selected' : ''}}>Select</option>
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
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop


@section('javascript')
<script type="text/javascript" nonce="{{ csp_nonce() }}">

// initialize the validation library
const validation = new JustValidate('#profileForm', {
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
  .addField('#phone', [
    {
      rule: 'required',
      errorMessage: 'Phone is required',
    },
  ])
  .addField('#timezone', [
    {
      rule: 'required',
      errorMessage: 'Timezone is required',
    },
  ])
  .addField('#email', [
    {
      rule: 'required',
      errorMessage: 'Email is required',
    },
    {
      rule: 'email',
      errorMessage: 'Email is invalid!',
    },
  ])
  .addField('#old_password', [
    {
      rule: 'required',
      errorMessage: 'Current Password is required',
    },
  ])
  .addField('#password', [
    {
      rule: 'required',
      errorMessage: 'Password is required',
    },
    {
      rule: 'strongPassword',
    }
  ])
  .addField('#confirm_password', [
    {
      rule: 'required',
      errorMessage: 'Confirm Password is required',
    },
    {
        validator: (value, fields) => {
        if (fields['#password'] && fields['#password'].elem) {
            const repeatPasswordValue = fields['#password'].elem.value;

            return value === repeatPasswordValue;
        }

        return true;
        },
        errorMessage: 'Password and Confirm Password must be same',
    },
  ])
  .onSuccess((event) => {
    event.target.submit();
  });
</script>

@stop
