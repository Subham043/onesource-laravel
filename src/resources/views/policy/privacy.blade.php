@extends('layouts.auth')

@section('css')
    <style nonce="{{ csp_nonce() }}">
        .min-dvh-100{
            min-height: 100dvh;
        }
    </style>
@stop

@section('content')
<div class="row m-0 bg-white min-dvh-100">
    <div class="col-md-12">
        <div class="row justify-content-center text-center">
            <a href="{{route('login.get')}}" class="navbar-brand  d-flex justify-content-center mb-3">
                <img src="{{asset('assets/images/logo.png')}}" alt="1Source" class="ms-3" />
            </a>
            <h1>Privacy Policy</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-12">
                test
            </div>
        </div>
    </div>
</div>
@stop
