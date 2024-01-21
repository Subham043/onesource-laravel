@extends('layouts.main')

@section('content')
<div>
    <div class="col-sm-12 col-lg-12">
        <form id="loginForm" method="POST" action="{{route('client.create.post')}}" class="form-horizontal">
            @csrf
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Client Details</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="name">Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                            @error('name')
                                <div class="invalid-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="email">Email:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" name="email" value="{{old('email')}}">
                            @error('email')
                                <div class="invalid-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="phone">Phone:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}">
                            @error('phone')
                                <div class="invalid-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="address">Address:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="address" id="address" rows="5">{{old('address')}}</textarea>
                            @error('address')
                                <div class="invalid-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Client</button>
                    <a href="{{route('client.paginate.get')}}" class="btn btn-warning" id="submitBtn">Cancel</a>
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
  .addField('#email', [
    {
      rule: 'required',
      errorMessage: 'Email is required',
    },
  ])
  .addField('#phone', [
    {
      rule: 'required',
      errorMessage: 'Phone is required',
    },
  ])
  .addField('#address', [
    {
      rule: 'required',
      errorMessage: 'Address is required',
    },
  ])
  .onSuccess((event) => {
    event.target.submit();
  });
</script>

@stop
