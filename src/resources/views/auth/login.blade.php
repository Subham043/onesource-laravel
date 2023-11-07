@extends('layouts.auth')

@section('content')
<div class="row m-0 align-items-center bg-white vh-100">
    <div class="col-md-12">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card iq-document-card d-flex justify-content-center mb-0 auth-card">
                    <div class="card-body">
                        <a href="{{route('login.get')}}" class="navbar-brand  d-flex justify-content-center mb-3">
                            <img src="{{asset('assets/images/logo.png')}}" alt="1Source" class="ms-3" />
                        </a>
                        <h2 class="mb-2 text-center">Sign In</h2>
                        <form id="loginForm" method="POST" action="{{route('login.post')}}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email ID</label>
                                        <input type="email" class="form-control" id="email" name="email" aria-describedby="email">
                                        @error('email')
                                            <div class="invalid-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" id="password" name="password" aria-describedby="password" aria-describedby="password-show">
                                            <div class="input-group-append">
                                                <button class="btn btn-dark input-group-text" type="button" id="password-show">
                                                  show
                                                </button>
                                            </div>
                                        </div>
                                        @error('password')
                                            <div class="invalid-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 d-flex justify-content-between">
                                    <div class="form-check mb-3">
                                        <input type="checkbox" class="form-check-input" id="customCheck1">
                                        <label class="form-check-label" for="customCheck1">Remember Email ID</label>
                                    </div>
                                    <a href="{{route('forgot_password.get')}}">Forgot Password?</a>
                                </div>
                            </div>
                            <div class="d-flex justify-content-right">
                                <button type="submit" class="btn btn-primary">Sign In</button>
                            </div>
                            <hr/>
                            <div class="d-flex justify-content-center mt-4">
                                Don’t have an account? &nbsp;<a href="{{route('register.get')}}"> Click here to Register.</a>

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

document.getElementById('password-show').addEventListener("click", function(){
    const password = document.getElementById('password');
    if(password.getAttribute("type") == 'password'){
        password.setAttribute("type", "text") ;
        document.getElementById('password-show').innerText = "hide"
    }else{
        password.setAttribute("type", "password");
        document.getElementById('password-show').innerText = "show"
    }
})

// initialize the validation library
const validation = new JustValidate('#loginForm', {
      errorFieldCssClass: 'is-invalid',
      focusInvalidField: true,
      lockForm: true,
});
// apply rules to form fields
validation
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
  .addField('#password', [
    {
      rule: 'required',
      errorMessage: 'Password is required',
    },
  ])
  .onSuccess((event) => {
    event.target.submit();
  });
</script>

@stop
