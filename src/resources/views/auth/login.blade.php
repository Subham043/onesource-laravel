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
                        <h2 class="mb-2 text-center">Sign In</h2>
                        <form action="dashboard.html">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email ID</label>
                                        <input type="email" class="form-control" id="email" aria-describedby="email" placeholder=" ">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" aria-describedby="password" placeholder=" ">
                                    </div>
                                </div>
                                <div class="col-lg-12 d-flex justify-content-between">
                                    <div class="form-check mb-3">
                                        <input type="checkbox" class="form-check-input" id="customCheck1">
                                        <label class="form-check-label" for="customCheck1">Remember Email ID</label>
                                    </div>
                                    <a href="ForgotPassword.html">Forgot Password?</a>
                                </div>
                            </div>
                            <div class="d-flex justify-content-right">
                                <button type="submit" class="btn btn-primary">Sign In</button>
                            </div>
                            <hr/>
                            <div class="d-flex justify-content-center mt-4">
                                Don’t have an account? &nbsp;<a href="register.html"> Click here to Register.</a>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
