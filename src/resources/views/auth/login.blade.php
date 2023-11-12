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
                                                <button class="btn btn-light input-group-text" type="button" id="password-show">
                                                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12 16.01C14.2091 16.01 16 14.2191 16 12.01C16 9.80087 14.2091 8.01001 12 8.01001C9.79086 8.01001 8 9.80087 8 12.01C8 14.2191 9.79086 16.01 12 16.01Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M2 11.98C8.09 1.31996 15.91 1.32996 22 11.98" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M22 12.01C15.91 22.67 8.09 22.66 2 12.01" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                        <div id="password_error" class="invalid-message">@error('password'){{ $message }}@enderror</div>
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
        document.getElementById('password-show').innerHTML = `<svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M14.83 9.17999C14.2706 8.61995 13.5576 8.23846 12.7813 8.08386C12.0049 7.92926 11.2002 8.00851 10.4689 8.31152C9.73758 8.61453 9.11264 9.12769 8.67316 9.78607C8.23367 10.4444 7.99938 11.2184 8 12.01C7.99916 13.0663 8.41619 14.08 9.16004 14.83" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M12 16.01C13.0609 16.01 14.0783 15.5886 14.8284 14.8384C15.5786 14.0883 16 13.0709 16 12.01" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M17.61 6.39004L6.38 17.62C4.6208 15.9966 3.14099 14.0944 2 11.99C6.71 3.76002 12.44 1.89004 17.61 6.39004Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M20.9994 3L17.6094 6.39" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M6.38 17.62L3 21" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M19.5695 8.42999C20.4801 9.55186 21.2931 10.7496 21.9995 12.01C17.9995 19.01 13.2695 21.4 8.76953 19.23" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>`
    }else{
        password.setAttribute("type", "password");
        document.getElementById('password-show').innerHTML = `<svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M12 16.01C14.2091 16.01 16 14.2191 16 12.01C16 9.80087 14.2091 8.01001 12 8.01001C9.79086 8.01001 8 9.80087 8 12.01C8 14.2191 9.79086 16.01 12 16.01Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M2 11.98C8.09 1.31996 15.91 1.32996 22 11.98" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M22 12.01C15.91 22.67 8.09 22.66 2 12.01" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>`
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
  ], {
    errorsContainer: '#password_error'
  })
  .onSuccess((event) => {
    event.target.submit();
  });
</script>

@stop
