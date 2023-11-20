@extends('layouts.auth')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/intlTelInput.css')}}" type="text/css" />
@stop

@section('content')
<div class="row m-0 align-items-center bg-white">
    <div class="col-md-12">
        <div class="row justify-content-center">
            <a href="{{route('login.get')}}" class="navbar-brand  d-flex justify-content-center mb-3">
                <img src="{{asset('assets/images/logo.png')}}" alt="1Source" class="ms-3" />
            </a>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card iq-document-card d-flex justify-content-center mb-0 auth-card">
                    <div class="card-body">
                        <form id="loginForm" method="POST" action="{{route('register.post')}}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 d-flex justify-content-end">
                                    <span> <sup>*</sup>mandatory</span>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <h3 class="mb-2 text-left">Register</h3>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="name" class="form-label">Name <sup>*</sup></label>
                                                <input type="text" class="form-control" id="name" name="name" aria-describedby="name" value="{{old('name')}}">
                                                @error('name')
                                                    <div class="invalid-message">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="phone" class="form-label">Phone <sup>*</sup></label>
                                                <input type="tel" class="form-control" id="phone" name="phone" aria-describedby="phone" value="{{old('phone')}}" >
                                                @error('phone')
                                                    <div class="invalid-message">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="company" class="form-label">Company <sup>*</sup></label>
                                                <input type="text" class="form-control" id="company" name="company" value="{{old('company')}}" aria-describedby="company">
                                                @error('company')
                                                    <div class="invalid-message">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="address" class="form-label">Address<sup>*</sup></label>
                                                <textarea class="form-control" id="address" name="address" aria-label="address">{{old('address')}}</textarea>
                                                @error('address')
                                                    <div class="invalid-message">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="city" class="form-label">City <sup>*</sup></label>
                                                <input type="text" class="form-control" id="city" name="city" value="{{old('city')}}" aria-describedby="city">
                                                @error('name')
                                                    <div class="invalid-message">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="state" class="form-label">State/Province<sup>*</sup></label>
                                                <select class="form-select form-select-sm" id="state" name="state" aria-label="state">
                                                    <option value="" {{empty(old('state')) ? 'selected' : ''}}>State/Province</option>
                                                    <option value="AL" {{!empty(old('state')) && old('state') == 'AL' ? 'selected' : ''}}>Alabama</option>
                                                    <option value="AK" {{!empty(old('state')) && old('state') == 'AK' ? 'selected' : ''}}>Alaska</option>
                                                    <option value="AZ" {{!empty(old('state')) && old('state') == 'AZ' ? 'selected' : ''}}>Arizona</option>
                                                    <option value="AR" {{!empty(old('state')) && old('state') == 'AR' ? 'selected' : ''}}>Arkansas</option>
                                                    <option value="CA" {{!empty(old('state')) && old('state') == 'CA' ? 'selected' : ''}}>California</option>
                                                    <option value="CO" {{!empty(old('state')) && old('state') == 'CO' ? 'selected' : ''}}>Colorado</option>
                                                    <option value="CT" {{!empty(old('state')) && old('state') == 'CT' ? 'selected' : ''}}>Connecticut</option>
                                                    <option value="DE" {{!empty(old('state')) && old('state') == 'DE' ? 'selected' : ''}}>Delaware</option>
                                                    <option value="DC" {{!empty(old('state')) && old('state') == 'DC' ? 'selected' : ''}}>District Of Columbia</option>
                                                    <option value="FL" {{!empty(old('state')) && old('state') == 'FL' ? 'selected' : ''}}>Florida</option>
                                                    <option value="GA" {{!empty(old('state')) && old('state') == 'GA' ? 'selected' : ''}}>Georgia</option>
                                                    <option value="HI" {{!empty(old('state')) && old('state') == 'HI' ? 'selected' : ''}}>Hawaii</option>
                                                    <option value="ID" {{!empty(old('state')) && old('state') == 'ID' ? 'selected' : ''}}>Idaho</option>
                                                    <option value="IL" {{!empty(old('state')) && old('state') == 'IL' ? 'selected' : ''}}>Illinois</option>
                                                    <option value="IN" {{!empty(old('state')) && old('state') == 'IN' ? 'selected' : ''}}>Indiana</option>
                                                    <option value="IA" {{!empty(old('state')) && old('state') == 'IA' ? 'selected' : ''}}>Iowa</option>
                                                    <option value="KS" {{!empty(old('state')) && old('state') == 'KS' ? 'selected' : ''}}>Kansas</option>
                                                    <option value="KY" {{!empty(old('state')) && old('state') == 'KY' ? 'selected' : ''}}>Kentucky</option>
                                                    <option value="LA" {{!empty(old('state')) && old('state') == 'LA' ? 'selected' : ''}}>Louisiana</option>
                                                    <option value="ME" {{!empty(old('state')) && old('state') == 'ME' ? 'selected' : ''}}>Maine</option>
                                                    <option value="MD" {{!empty(old('state')) && old('state') == 'MD' ? 'selected' : ''}}>Maryland</option>
                                                    <option value="MA" {{!empty(old('state')) && old('state') == 'MA' ? 'selected' : ''}}>Massachusetts</option>
                                                    <option value="MI" {{!empty(old('state')) && old('state') == 'MI' ? 'selected' : ''}}>Michigan</option>
                                                    <option value="MN" {{!empty(old('state')) && old('state') == 'MN' ? 'selected' : ''}}>Minnesota</option>
                                                    <option value="MS" {{!empty(old('state')) && old('state') == 'MS' ? 'selected' : ''}}>Mississippi</option>
                                                    <option value="MO" {{!empty(old('state')) && old('state') == 'MO' ? 'selected' : ''}}>Missouri</option>
                                                    <option value="MT" {{!empty(old('state')) && old('state') == 'MT' ? 'selected' : ''}}>Montana</option>
                                                    <option value="NE" {{!empty(old('state')) && old('state') == 'NE' ? 'selected' : ''}}>Nebraska</option>
                                                    <option value="NV" {{!empty(old('state')) && old('state') == 'NV' ? 'selected' : ''}}>Nevada</option>
                                                    <option value="NH" {{!empty(old('state')) && old('state') == 'NH' ? 'selected' : ''}}>New Hampshire</option>
                                                    <option value="NJ" {{!empty(old('state')) && old('state') == 'NJ' ? 'selected' : ''}}>New Jersey</option>
                                                    <option value="NM" {{!empty(old('state')) && old('state') == 'NM' ? 'selected' : ''}}>New Mexico</option>
                                                    <option value="NY" {{!empty(old('state')) && old('state') == 'NY' ? 'selected' : ''}}>New York</option>
                                                    <option value="NC" {{!empty(old('state')) && old('state') == 'NC' ? 'selected' : ''}}>North Carolina</option>
                                                    <option value="ND" {{!empty(old('state')) && old('state') == 'ND' ? 'selected' : ''}}>North Dakota</option>
                                                    <option value="OH" {{!empty(old('state')) && old('state') == 'OH' ? 'selected' : ''}}>Ohio</option>
                                                    <option value="OK" {{!empty(old('state')) && old('state') == 'OK' ? 'selected' : ''}}>Oklahoma</option>
                                                    <option value="OR" {{!empty(old('state')) && old('state') == 'OR' ? 'selected' : ''}}>Oregon</option>
                                                    <option value="PA" {{!empty(old('state')) && old('state') == 'PA' ? 'selected' : ''}}>Pennsylvania</option>
                                                    <option value="RI" {{!empty(old('state')) && old('state') == 'RI' ? 'selected' : ''}}>Rhode Island</option>
                                                    <option value="SC" {{!empty(old('state')) && old('state') == 'SC' ? 'selected' : ''}}>South Carolina</option>
                                                    <option value="SD" {{!empty(old('state')) && old('state') == 'SD' ? 'selected' : ''}}>South Dakota</option>
                                                    <option value="TN" {{!empty(old('state')) && old('state') == 'TN' ? 'selected' : ''}}>Tennessee</option>
                                                    <option value="TX" {{!empty(old('state')) && old('state') == 'TX' ? 'selected' : ''}}>Texas</option>
                                                    <option value="UT" {{!empty(old('state')) && old('state') == 'UT' ? 'selected' : ''}}>Utah</option>
                                                    <option value="VT" {{!empty(old('state')) && old('state') == 'VT' ? 'selected' : ''}}>Vermont</option>
                                                    <option value="VA" {{!empty(old('state')) && old('state') == 'VA' ? 'selected' : ''}}>Virginia</option>
                                                    <option value="WA" {{!empty(old('state')) && old('state') == 'WA' ? 'selected' : ''}}>Washington</option>
                                                    <option value="WV" {{!empty(old('state')) && old('state') == 'WV' ? 'selected' : ''}}>West Virginia</option>
                                                    <option value="WI" {{!empty(old('state')) && old('state') == 'WI' ? 'selected' : ''}}>Wisconsin</option>
                                                    <option value="WY" {{!empty(old('state')) && old('state') == 'WY' ? 'selected' : ''}}>Wyoming</option>
                                                </select>
                                                @error('state')
                                                    <div class="invalid-message">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="zip" class="form-label">Zip <sup>*</sup></label>
                                                <input type="text" class="form-control" id="zip" name="zip" aria-describedby="zip" value="{{old('zip')}}">
                                                @error('zip')
                                                    <div class="invalid-message">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="website" class="form-label">Website <sup>*</sup></label>
                                                <input type="url" class="form-control" id="website" name="website" aria-describedby="website" value="{{old('website')}}">
                                                @error('website')
                                                    <div class="invalid-message">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="timezone" class="form-label">Time Zone <sup>*</sup></label>
                                                <select class="form-select shadow-none" id="timezone" name="timezone">
                                                    <option value="" {{empty(old('timezone')) ? 'selected' : ''}}>Select</option>
                                                    <option value="Pacific/Honolulu GMT-10:00" {{!empty(old('timezone')) && old('timezone') == 'Pacific/Honolulu GMT-10:00' ? 'selected' : ''}}>Pacific/Honolulu GMT-10:00</option>
                                                    <option value="America/Anchorage GMT-9:00" {{!empty(old('timezone')) && old('timezone') == 'America/Anchorage GMT-9:00' ? 'selected' : ''}}>America/Anchorage GMT-9:00</option>
                                                    <option value="America/Los_Angeles GMT-8:00" {{!empty(old('timezone')) && old('timezone') == 'America/Los_Angeles GMT-8:00' ? 'selected' : ''}}>America/Los_Angeles GMT-8:00</option>
                                                    <option value="America/Boise GMT-7:00" {{!empty(old('timezone')) && old('timezone') == 'America/Boise GMT-7:00' ? 'selected' : ''}}>America/Boise GMT-7:00</option>
                                                    <option value="America/Denver GMT-7:00" {{!empty(old('timezone')) && old('timezone') == 'America/Denver GMT-7:00' ? 'selected' : ''}}>America/Denver GMT-7:00</option>
                                                    <option value="America/Phoenix GMT-7:00" {{!empty(old('timezone')) && old('timezone') == 'America/Phoenix GMT-7:00' ? 'selected' : ''}}>America/Phoenix GMT-7:00</option>
                                                    <option value="America/Chicago GMT-6:00" {{!empty(old('timezone')) && old('timezone') == 'America/Chicago GMT-6:00' ? 'selected' : ''}}>America/Chicago GMT-6:00</option>
                                                    <option value="America/Detroit GMT-5:00" {{!empty(old('timezone')) && old('timezone') == 'America/Detroit GMT-5:00' ? 'selected' : ''}}>America/Detroit GMT-5:00</option>
                                                    <option value="America/New_York GMT-5:00" {{!empty(old('timezone')) && old('timezone') == 'America/New_York GMT-5:00' ? 'selected' : ''}}>America/New_York GMT-5:00</option>
                                                </select>
                                                @error('timezone')
                                                    <div class="invalid-message">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 colddiv">
                                    <div class="row">
                                        <h3>Sign In Information </h3>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="email" class="form-label">Email ID <sup>*</sup> <span data-bs-toggle="tooltip" data-bs-original-title="This is your user ID on Sign In & Check your spam folder for verification email."><i class="icon">
                                                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='currentColor'><circle cx='6' cy='6' r='4.5'/><path stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/><circle cx='6' cy='8.2' r='.6' fill='currentColor' stroke='none'/></svg>
                                                </i></span></label>
                                                <input type="email" class="form-control" id="email" name="email" aria-describedby="email" value="{{old('email')}}">
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
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                                <div class="input-group mb-3">
                                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" aria-describedby="confirm_password" aria-describedby="confirm_password-show">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-light input-group-text" type="button" id="confirm_password-show">
                                                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M12 16.01C14.2091 16.01 16 14.2191 16 12.01C16 9.80087 14.2091 8.01001 12 8.01001C9.79086 8.01001 8 9.80087 8 12.01C8 14.2191 9.79086 16.01 12 16.01Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M2 11.98C8.09 1.31996 15.91 1.32996 22 11.98" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M22 12.01C15.91 22.67 8.09 22.66 2 12.01" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div id="confirm_password_error" class="invalid-message">@error('confirm_password'){{ $message }}@enderror</div>
                                            </div>
                                        </div>
                                        <h5 class="mt-5 mb-2">Account Recovery Questions</h5>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="question_1" class="form-label">Question 1<sup>*</sup></label>
                                                <select class="form-select form-select-sm" aria-label="question_1" id="question_1" name="question_1">
                                                    <option value="What elementary school/high school did you attend?" {{empty(old('question_1')) || old('question_1') == 'What elementary school/high school did you attend?' ? 'selected' : ''}}>What elementary school/high school did you attend? </option>
                                                    <option value="What is your mother’s maiden name?" {{!empty(old('question_1')) && old('question_1') == 'What is your mother’s maiden name?' ? 'selected' : ''}}>What is your mother’s maiden name?</option>
                                                    <option value="What is your favorite movie?" {{!empty(old('question_1')) && old('question_1') == 'What is your favorite movie?' ? 'selected' : ''}}>What is your favorite movie? </option>
                                                    <option value="What was your favorite sport in high school?" {{!empty(old('question_1')) && old('question_1') == 'What was your favorite sport in high school?' ? 'selected' : ''}}>What was your favorite sport in high school?</option>
                                                    <option value="In what city did you meet your spouse/significant other?" {{!empty(old('question_1')) && old('question_1') == 'In what city did you meet your spouse/significant other?' ? 'selected' : ''}}>In what city did you meet your spouse/significant other?</option>
                                                    <option value="What is the middle name of your youngest child?" {{!empty(old('question_1')) && old('question_1') == 'What is the middle name of your youngest child?' ? 'selected' : ''}}>What is the middle name of your youngest child?</option>
                                                    <option value="In what city or town did your mother and father meet?" {{!empty(old('question_1')) && old('question_1') == 'In what city or town did your mother and father meet?' ? 'selected' : ''}}>In what city or town did your mother and father meet?</option>
                                                </select>
                                                @error('question_1')
                                                    <div class="invalid-message">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="answer_1" class="form-label">Answer 1 <sup>*</sup></label>
                                                <input type="text" class="form-control" id="answer_1" name="answer_1" aria-describedby="answer_1" value="{{old('answer_1')}}">
                                                @error('answer_1')
                                                    <div class="invalid-message">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="question_2" class="form-label">Question 2<sup>*</sup></label>
                                                <select class="form-select form-select-sm" aria-label="question_2" id="question_2" name="question_2">
                                                    <option value="What elementary school/high school did you attend?" {{empty(old('question_2')) || old('question_2') == 'What elementary school/high school did you attend?' ? 'selected' : ''}}>What elementary school/high school did you attend? </option>
                                                    <option value="What is your mother’s maiden name?" {{!empty(old('question_2')) && old('question_2') == 'What is your mother’s maiden name?' ? 'selected' : ''}}>What is your mother’s maiden name?</option>
                                                    <option value="What is your favorite movie?" {{!empty(old('question_2')) && old('question_2') == 'What is your favorite movie?' ? 'selected' : ''}}>What is your favorite movie? </option>
                                                    <option value="What was your favorite sport in high school?" {{!empty(old('question_2')) && old('question_2') == 'What was your favorite sport in high school?' ? 'selected' : ''}}>What was your favorite sport in high school?</option>
                                                    <option value="In what city did you meet your spouse/significant other?" {{!empty(old('question_2')) && old('question_2') == 'In what city did you meet your spouse/significant other?' ? 'selected' : ''}}>In what city did you meet your spouse/significant other?</option>
                                                    <option value="What is the middle name of your youngest child?" {{!empty(old('question_2')) && old('question_2') == 'What is the middle name of your youngest child?' ? 'selected' : ''}}>What is the middle name of your youngest child?</option>
                                                    <option value="In what city or town did your mother and father meet?" {{!empty(old('question_2')) && old('question_2') == 'In what city or town did your mother and father meet?' ? 'selected' : ''}}>In what city or town did your mother and father meet?</option>
                                                </select>
                                                @error('question_2')
                                                    <div class="invalid-message">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="answer_2" class="form-label">Answer 2 <sup>*</sup></label>
                                                <input type="text" class="form-control" id="answer_2" name="answer_2" aria-describedby="answer_2" value="{{old('answer_2')}}">
                                                @error('answer_2')
                                                    <div class="invalid-message">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="question_3" class="form-label">Question 3<sup>*</sup></label>
                                                <select class="form-select form-select-sm" id="question_3" name="question_3" aria-label="question_3">
                                                    <option value="What elementary school/high school did you attend?" {{empty(old('question_3')) || old('question_3') == 'What elementary school/high school did you attend?' ? 'selected' : ''}}>What elementary school/high school did you attend? </option>
                                                    <option value="What is your mother’s maiden name?" {{!empty(old('question_3')) && old('question_3') == 'What is your mother’s maiden name?' ? 'selected' : ''}}>What is your mother’s maiden name?</option>
                                                    <option value="What is your favorite movie?" {{!empty(old('question_3')) && old('question_3') == 'What is your favorite movie?' ? 'selected' : ''}}>What is your favorite movie? </option>
                                                    <option value="What was your favorite sport in high school?" {{!empty(old('question_3')) && old('question_3') == 'What was your favorite sport in high school?' ? 'selected' : ''}}>What was your favorite sport in high school?</option>
                                                    <option value="In what city did you meet your spouse/significant other?" {{!empty(old('question_3')) && old('question_3') == 'In what city did you meet your spouse/significant other?' ? 'selected' : ''}}>In what city did you meet your spouse/significant other?</option>
                                                    <option value="What is the middle name of your youngest child?" {{!empty(old('question_3')) && old('question_3') == 'What is the middle name of your youngest child?' ? 'selected' : ''}}>What is the middle name of your youngest child?</option>
                                                    <option value="In what city or town did your mother and father meet?" {{!empty(old('question_3')) && old('question_3') == 'In what city or town did your mother and father meet?' ? 'selected' : ''}}>In what city or town did your mother and father meet?</option>
                                                </select>
                                                @error('question_3')
                                                    <div class="invalid-message">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="answer_3" class="form-label">Answer 3 <sup>*</sup></label>
                                                <input type="text" class="form-control" id="answer_3" name="answer_3" aria-describedby="answer_3" value="{{old('answer_3')}}">
                                                @error('answer_3')
                                                    <div class="invalid-message">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row justify-content-center">
                                <div class="d-flex justify-content-right">
                                    <button type="submit" class="btn btn-primary">Pay and Create Account</button>
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
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>

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

document.getElementById('confirm_password-show').addEventListener("click", function(){
    const password = document.getElementById('confirm_password');
    if(password.getAttribute("type") == 'password'){
        password.setAttribute("type", "text") ;
        document.getElementById('confirm_password-show').innerHTML = `<svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M14.83 9.17999C14.2706 8.61995 13.5576 8.23846 12.7813 8.08386C12.0049 7.92926 11.2002 8.00851 10.4689 8.31152C9.73758 8.61453 9.11264 9.12769 8.67316 9.78607C8.23367 10.4444 7.99938 11.2184 8 12.01C7.99916 13.0663 8.41619 14.08 9.16004 14.83" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M12 16.01C13.0609 16.01 14.0783 15.5886 14.8284 14.8384C15.5786 14.0883 16 13.0709 16 12.01" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M17.61 6.39004L6.38 17.62C4.6208 15.9966 3.14099 14.0944 2 11.99C6.71 3.76002 12.44 1.89004 17.61 6.39004Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M20.9994 3L17.6094 6.39" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M6.38 17.62L3 21" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M19.5695 8.42999C20.4801 9.55186 21.2931 10.7496 21.9995 12.01C17.9995 19.01 13.2695 21.4 8.76953 19.23" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>`
    }else{
        password.setAttribute("type", "password");
        document.getElementById('confirm_password-show').innerHTML = `<svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M12 16.01C14.2091 16.01 16 14.2191 16 12.01C16 9.80087 14.2091 8.01001 12 8.01001C9.79086 8.01001 8 9.80087 8 12.01C8 14.2191 9.79086 16.01 12 16.01Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M2 11.98C8.09 1.31996 15.91 1.32996 22 11.98" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M22 12.01C15.91 22.67 8.09 22.66 2 12.01" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>`
    }
})

const countryData = window.intlTelInput(document.querySelector("#phone"), {
    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js",
    autoInsertDialCode: true,
    initialCountry: "in",
    nationalMode: false,
    geoIpLookup: callback => {
        fetch("https://ipapi.co/json")
        .then(res => res.json())
        .then(data => callback(data.country_code))
        .catch(() => callback("us"));
    },
});

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
  .addField('#question_1', [
    {
      rule: 'required',
      errorMessage: 'Question 1 is required',
    },
  ])
  .addField('#answer_1', [
    {
      rule: 'required',
      errorMessage: 'Answer 1 is required',
    },
  ])
  .addField('#question_2', [
    {
      rule: 'required',
      errorMessage: 'Question 2 is required',
    },
  ])
  .addField('#answer_2', [
    {
      rule: 'required',
      errorMessage: 'Answer 2 is required',
    },
  ])
  .addField('#question_3', [
    {
      rule: 'required',
      errorMessage: 'Question 3 is required',
    },
  ])
  .addField('#answer_3', [
    {
      rule: 'required',
      errorMessage: 'Answer 3 is required',
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
  .addField('#password', [
    {
      rule: 'required',
      errorMessage: 'Password is required',
    },
    {
      rule: 'strongPassword',
    }
  ], {
    errorsContainer: '#password_error'
  })
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
  ], {
    errorsContainer: '#confirm_password_error'
  })
  .onSuccess((event) => {
    event.target.submit();
  });
</script>

@stop
