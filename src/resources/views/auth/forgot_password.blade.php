@extends('layouts.auth')

@section('content')
<div class="row m-0 align-items-center bg-white vh-100">
    <div class="col-md-12">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card iq-document-card d-flex justify-content-center mb-0 auth-card">
                    <div class="card-body">
                        <a href="" class="navbar-brand  d-flex justify-content-center mb-3">
                            <img src="{{asset('assets/images/logo.png')}}" alt="1Source" class="ms-3" />
                        </a>
                        <h2 class="mb-2 text-center">Forgot Password?</h2>
                        <p class="text-center">Please enter your email ID</p>
                        <form action="ForgotPassword-message.html">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="email" class="form-label"> Email ID</label>
                                        <input type="email" class="form-control" id="email" aria-describedby="email" placeholder=" ">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
