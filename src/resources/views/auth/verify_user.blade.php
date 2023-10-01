@extends('layouts.auth')

@section('content')
<div class="row m-0 align-items-center bg-white vh-100">
    <div class="col-md-12">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card iq-document-card d-flex justify-content-center mb-0 auth-card">
                    <div class="card-body">
                        <a href="{{route('login.get')}}" class="navbar-brand  d-flex justify-content-center mb-3">
                            <img src="{{asset('assets/images/logo.png')}}" alt="1Source" class="ms-3" />
                        </a>
                        <h2 class="mb-2 text-center">Verify Email.</h2>
                        <p class="text-center">{{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}</p>
                        <form id="loginForm" method="POST" action="{{route('verification.send')}}">
                            @csrf
                            <div class="d-flex justify-content-center gap-5">
                                <button type="submit" class="btn btn-primary">Resend Verification Email</button>
                                <a href="{{route('logout.get')}}" class="btn btn-danger">{{ __('Log Out') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
