@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                        <div class="flex-wrap card-header d-flex justify-content-between align-items-center mb-3">
                            <div class="header-title">
                                <h4 class="mb-0 card-title">Customers Details</h4>
                            </div>
                            <div class="header-title">
                                <a href="{{route('customer.reset_password.get', $data->id)}}" class="btn btn-primary">Send Password Reset Link </a>
                                <a href="{{route('customer.status.get', $data->id)}}"
                                    class="btn btn-primary">{{$data->is_blocked ? 'Activate' : 'Deactivate'}} </a>
                            </div>
                        </div>
                        <form id="loginForm" method="POST" action="{{route('customer.update.post', $data->id)}}" class="card-body">
                            @csrf
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0" for="name">Name:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name" aria-describedby="name"
                                        value="{{$data->name}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0" for="email">Email:</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email" name="email" aria-describedby="email"
                                        value="{{$data->email}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0" for="phone">Phone:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="phone" name="phone" aria-describedby="phone"
                                        value="{{$data->phone}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0"
                                    for="company">Company:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="company" name="company" aria-describedby="company"
                                        value="{{$data->profile->company}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0" for="address">Address
                                    :</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" aria-label="address" id="address" name="address">{{$data->profile->address}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0" for="city">City :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="city" name="city" aria-describedby="city"
                                        value="{{$data->profile->city}}">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0" for="state">State/Province
                                    :</label>
                                <div class="col-sm-10">
                                    <select class="form-select form-select-sm" id="state" name="state" aria-label="state">
                                        <option value="" {{empty(old('state')) ? 'selected' : ''}}>State/Province</option>
                                        <option value="AL" {{$data->profile->state->value == 'AL' ? 'selected' : ''}}>Alabama</option>
                                        <option value="AK" {{$data->profile->state->value == 'AK' ? 'selected' : ''}}>Alaska</option>
                                        <option value="AZ" {{$data->profile->state->value == 'AZ' ? 'selected' : ''}}>Arizona</option>
                                        <option value="AR" {{$data->profile->state->value == 'AR' ? 'selected' : ''}}>Arkansas</option>
                                        <option value="CA" {{$data->profile->state->value == 'CA' ? 'selected' : ''}}>California</option>
                                        <option value="CO" {{$data->profile->state->value == 'CO' ? 'selected' : ''}}>Colorado</option>
                                        <option value="CT" {{$data->profile->state->value == 'CT' ? 'selected' : ''}}>Connecticut</option>
                                        <option value="DE" {{$data->profile->state->value == 'DE' ? 'selected' : ''}}>Delaware</option>
                                        <option value="DC" {{$data->profile->state->value == 'DC' ? 'selected' : ''}}>District Of Columbia</option>
                                        <option value="FL" {{$data->profile->state->value == 'FL' ? 'selected' : ''}}>Florida</option>
                                        <option value="GA" {{$data->profile->state->value == 'GA' ? 'selected' : ''}}>Georgia</option>
                                        <option value="HI" {{$data->profile->state->value == 'HI' ? 'selected' : ''}}>Hawaii</option>
                                        <option value="ID" {{$data->profile->state->value == 'ID' ? 'selected' : ''}}>Idaho</option>
                                        <option value="IL" {{$data->profile->state->value == 'IL' ? 'selected' : ''}}>Illinois</option>
                                        <option value="IN" {{$data->profile->state->value == 'IN' ? 'selected' : ''}}>Indiana</option>
                                        <option value="IA" {{$data->profile->state->value == 'IA' ? 'selected' : ''}}>Iowa</option>
                                        <option value="KS" {{$data->profile->state->value == 'KS' ? 'selected' : ''}}>Kansas</option>
                                        <option value="KY" {{$data->profile->state->value == 'KY' ? 'selected' : ''}}>Kentucky</option>
                                        <option value="LA" {{$data->profile->state->value == 'LA' ? 'selected' : ''}}>Louisiana</option>
                                        <option value="ME" {{$data->profile->state->value == 'ME' ? 'selected' : ''}}>Maine</option>
                                        <option value="MD" {{$data->profile->state->value == 'MD' ? 'selected' : ''}}>Maryland</option>
                                        <option value="MA" {{$data->profile->state->value == 'MA' ? 'selected' : ''}}>Massachusetts</option>
                                        <option value="MI" {{$data->profile->state->value == 'MI' ? 'selected' : ''}}>Michigan</option>
                                        <option value="MN" {{$data->profile->state->value == 'MN' ? 'selected' : ''}}>Minnesota</option>
                                        <option value="MS" {{$data->profile->state->value == 'MS' ? 'selected' : ''}}>Mississippi</option>
                                        <option value="MO" {{$data->profile->state->value == 'MO' ? 'selected' : ''}}>Missouri</option>
                                        <option value="MT" {{$data->profile->state->value == 'MT' ? 'selected' : ''}}>Montana</option>
                                        <option value="NE" {{$data->profile->state->value == 'NE' ? 'selected' : ''}}>Nebraska</option>
                                        <option value="NV" {{$data->profile->state->value == 'NV' ? 'selected' : ''}}>Nevada</option>
                                        <option value="NH" {{$data->profile->state->value == 'NH' ? 'selected' : ''}}>New Hampshire</option>
                                        <option value="NJ" {{$data->profile->state->value == 'NJ' ? 'selected' : ''}}>New Jersey</option>
                                        <option value="NM" {{$data->profile->state->value == 'NM' ? 'selected' : ''}}>New Mexico</option>
                                        <option value="NY" {{$data->profile->state->value == 'NY' ? 'selected' : ''}}>New York</option>
                                        <option value="NC" {{$data->profile->state->value == 'NC' ? 'selected' : ''}}>North Carolina</option>
                                        <option value="ND" {{$data->profile->state->value == 'ND' ? 'selected' : ''}}>North Dakota</option>
                                        <option value="OH" {{$data->profile->state->value == 'OH' ? 'selected' : ''}}>Ohio</option>
                                        <option value="OK" {{$data->profile->state->value == 'OK' ? 'selected' : ''}}>Oklahoma</option>
                                        <option value="OR" {{$data->profile->state->value == 'OR' ? 'selected' : ''}}>Oregon</option>
                                        <option value="PA" {{$data->profile->state->value == 'PA' ? 'selected' : ''}}>Pennsylvania</option>
                                        <option value="RI" {{$data->profile->state->value == 'RI' ? 'selected' : ''}}>Rhode Island</option>
                                        <option value="SC" {{$data->profile->state->value == 'SC' ? 'selected' : ''}}>South Carolina</option>
                                        <option value="SD" {{$data->profile->state->value == 'SD' ? 'selected' : ''}}>South Dakota</option>
                                        <option value="TN" {{$data->profile->state->value == 'TN' ? 'selected' : ''}}>Tennessee</option>
                                        <option value="TX" {{$data->profile->state->value == 'TX' ? 'selected' : ''}}>Texas</option>
                                        <option value="UT" {{$data->profile->state->value == 'UT' ? 'selected' : ''}}>Utah</option>
                                        <option value="VT" {{$data->profile->state->value == 'VT' ? 'selected' : ''}}>Vermont</option>
                                        <option value="VA" {{$data->profile->state->value == 'VA' ? 'selected' : ''}}>Virginia</option>
                                        <option value="WA" {{$data->profile->state->value == 'WA' ? 'selected' : ''}}>Washington</option>
                                        <option value="WV" {{$data->profile->state->value == 'WV' ? 'selected' : ''}}>West Virginia</option>
                                        <option value="WI" {{$data->profile->state->value == 'WI' ? 'selected' : ''}}>Wisconsin</option>
                                        <option value="WY" {{$data->profile->state->value == 'WY' ? 'selected' : ''}}>Wyoming</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0" for="zip">Zip :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="zip" name="zip" aria-describedby="zip"
                                        value="{{$data->profile->zip}}">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0" for="timezone">Time Zone
                                    :</label>
                                <div class="col-sm-10">
                                    <select class="form-select shadow-none" id="timezone" name="timezone">
                                        <option value="" {{empty(old('timezone')) ? 'selected' : ''}}>Select</option>
                                        <option value="Pacific/Honolulu GMT-10:00" {{$data->timezone->value == 'Pacific/Honolulu GMT-10:00' ? 'selected' : ''}}>Pacific/Honolulu GMT-10:00</option>
                                        <option value="America/Anchorage GMT-9:00" {{$data->timezone->value == 'America/Anchorage GMT-9:00' ? 'selected' : ''}}>America/Anchorage GMT-9:00</option>
                                        <option value="America/Los_Angeles GMT-8:00" {{$data->timezone->value == 'America/Los_Angeles GMT-8:00' ? 'selected' : ''}}>America/Los_Angeles GMT-8:00</option>
                                        <option value="America/Boise GMT-7:00" {{$data->timezone->value == 'America/Boise GMT-7:00' ? 'selected' : ''}}>America/Boise GMT-7:00</option>
                                        <option value="America/Denver GMT-7:00" {{$data->timezone->value == 'America/Denver GMT-7:00' ? 'selected' : ''}}>America/Denver GMT-7:00</option>
                                        <option value="America/Phoenix GMT-7:00" {{$data->timezone->value == 'America/Phoenix GMT-7:00' ? 'selected' : ''}}>America/Phoenix GMT-7:00</option>
                                        <option value="America/Chicago GMT-6:00" {{$data->timezone->value == 'America/Chicago GMT-6:00' ? 'selected' : ''}}>America/Chicago GMT-6:00</option>
                                        <option value="America/Detroit GMT-5:00" {{$data->timezone->value == 'America/Detroit GMT-5:00' ? 'selected' : ''}}>America/Detroit GMT-5:00</option>
                                        <option value="America/New_York GMT-5:00" {{$data->timezone->value == 'America/New_York GMT-5:00' ? 'selected' : ''}}>America/New_York GMT-5:00</option>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0" for="website">Website
                                    :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="website" name="website" aria-describedby="website"
                                        value="{{$data->profile->website}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Registration
                                    Date :</label>
                                <div class="col-sm-10">
                                    {{$data->created_at->format('d M Y')}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Renewal Date
                                    :</label>
                                <div class="col-sm-10">
                                    {{$data->currentPayment->payment_renewal_date->format('d M Y')}}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Status
                                    :</label>
                                <div class="col-sm-10">
                                    {{$data->is_blocked ? 'Blocked' : 'Active'}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Payment
                                    Status :</label>
                                <div class="col-sm-10">
                                    Done, on {{$data->currentPayment->payment_date->format('d M Y')}} | Payment Mode | Transaction id: xx445498 | $ 300.00
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
  .addField('#phone', [
    {
      rule: 'required',
      errorMessage: 'Phone is required',
    },
  ])
  .addField('#company', [
    {
      rule: 'required',
      errorMessage: 'Company is required',
    },
  ])
  .addField('#address', [
    {
      rule: 'required',
      errorMessage: 'Address is required',
    },
  ])
  .addField('#city', [
    {
      rule: 'required',
      errorMessage: 'City is required',
    },
  ])
  .addField('#state', [
    {
      rule: 'required',
      errorMessage: 'State is required',
    },
  ])
  .addField('#zip', [
    {
      rule: 'required',
      errorMessage: 'Zip is required',
    },
  ])
  .addField('#website', [
    {
      rule: 'required',
      errorMessage: 'Website is required',
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
  .onSuccess((event) => {
    event.target.submit();
  });
</script>

@stop
