@extends('layouts.auth')

@section('content')
<div class="row m-0 align-items-center bg-white">
    <div class="col-md-12">
        <div class="row justify-content-center">
            <a href="" class="navbar-brand  d-flex justify-content-center mb-3">
                <img src="{{asset('assets/images/logo.png')}}" alt="1Source" class="ms-3" />
            </a>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card iq-document-card d-flex justify-content-center mb-0 auth-card">
                    <div class="card-body">
                        <form action="pg.html">
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
                                                <label for="email" class="form-label">Name <sup>*</sup></label>
                                                <input type="text" class="form-control" id="name" aria-describedby="name" placeholder=" ">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="email" class="form-label">Phone <sup>*</sup></label>
                                                <input type="tel" class="form-control" id="phone" aria-describedby="phone" placeholder=" " required >
                                                <div class="invalid-feedback">
                                                    Please provide phone number.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="email" class="form-label">Email ID <sup>*</sup></label>
                                                <input type="email" class="form-control" id="email" aria-describedby="email" placeholder=" ">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="email" class="form-label">Company <sup>*</sup></label>
                                                <input type="text" class="form-control" id="name" aria-describedby="name" placeholder=" ">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="Address" class="form-label">Address<sup>*</sup></label>
                                                <textarea class="form-control" aria-label="Address"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="email" class="form-label">City <sup>*</sup></label>
                                                <input type="text" class="form-control" id="email" aria-describedby="City" placeholder=" ">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="email" class="form-label">State/Province<sup>*</sup></label>
                                                <select class="form-select form-select-sm" aria-label=".form-select-sm state">
                                                    <option selected="">State/Province</option>
                                                    <option value="AL">Alabama</option>
                                                    <option value="AK">Alaska</option>
                                                    <option value="AZ">Arizona</option>
                                                    <option value="AR">Arkansas</option>
                                                    <option value="CA">California</option>
                                                    <option value="CO">Colorado</option>
                                                    <option value="CT">Connecticut</option>
                                                    <option value="DE">Delaware</option>
                                                    <option value="DC">District Of Columbia</option>
                                                    <option value="FL">Florida</option>
                                                    <option value="GA">Georgia</option>
                                                    <option value="HI">Hawaii</option>
                                                    <option value="ID">Idaho</option>
                                                    <option value="IL">Illinois</option>
                                                    <option value="IN">Indiana</option>
                                                    <option value="IA">Iowa</option>
                                                    <option value="KS">Kansas</option>
                                                    <option value="KY">Kentucky</option>
                                                    <option value="LA">Louisiana</option>
                                                    <option value="ME">Maine</option>
                                                    <option value="MD">Maryland</option>
                                                    <option value="MA">Massachusetts</option>
                                                    <option value="MI">Michigan</option>
                                                    <option value="MN">Minnesota</option>
                                                    <option value="MS">Mississippi</option>
                                                    <option value="MO">Missouri</option>
                                                    <option value="MT">Montana</option>
                                                    <option value="NE">Nebraska</option>
                                                    <option value="NV">Nevada</option>
                                                    <option value="NH">New Hampshire</option>
                                                    <option value="NJ">New Jersey</option>
                                                    <option value="NM">New Mexico</option>
                                                    <option value="NY">New York</option>
                                                    <option value="NC">North Carolina</option>
                                                    <option value="ND">North Dakota</option>
                                                    <option value="OH">Ohio</option>
                                                    <option value="OK">Oklahoma</option>
                                                    <option value="OR">Oregon</option>
                                                    <option value="PA">Pennsylvania</option>
                                                    <option value="RI">Rhode Island</option>
                                                    <option value="SC">South Carolina</option>
                                                    <option value="SD">South Dakota</option>
                                                    <option value="TN">Tennessee</option>
                                                    <option value="TX">Texas</option>
                                                    <option value="UT">Utah</option>
                                                    <option value="VT">Vermont</option>
                                                    <option value="VA">Virginia</option>
                                                    <option value="WA">Washington</option>
                                                    <option value="WV">West Virginia</option>
                                                    <option value="WI">Wisconsin</option>
                                                    <option value="WY">Wyoming</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="email" class="form-label">Zip <sup>*</sup></label>
                                                <input type="text" class="form-control" id="email" aria-describedby="Zip" placeholder=" ">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="email" class="form-label">Website <sup>*</sup></label>
                                                <input type="url" class="form-control" id="email" aria-describedby="Website" placeholder=" ">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="email" class="form-label">Time Zone <sup>*</sup></label>
                                                <select class="form-select shadow-none">
                                                    <option selected="">Select</option>
                                                    <option value="Pacific/Honolulu">Pacific/Honolulu GMT-10:00</option>
                                                    <option value="America/Anchorage">America/Anchorage GMT-9:00</option>
                                                    <option value="America/Los_Angeles">America/Los_Angeles GMT-8:00</option>
                                                    <option value="America/Boise">America/Boise GMT-7:00</option>
                                                    <option value="America/Denver">America/Denver GMT-7:00</option>
                                                    <option value="America/Phoenix">America/Phoenix GMT-7:00</option>
                                                    <option value="America/Chicago">America/Chicago GMT-6:00</option>
                                                    <option value="America/Detroit">America/Detroit GMT-5:00</option>
                                                    <option value="America/New_York">America/New_York GMT-5:00</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 colddiv">
                                    <div class="row">
                                        <h3>Sign In Information </h3>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="email" class="form-label">Email ID <sup>*</sup> <span data-bs-toggle="tooltip" data-bs-original-title="This is your user ID on Sign In"><i class="icon">
                                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='currentColor'><circle cx='6' cy='6' r='4.5'/><path stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/><circle cx='6' cy='8.2' r='.6' fill='currentColor' stroke='none'/></svg>
                                </i></span></label>
                                                <input type="email" class="form-control" id="email" aria-describedby="email" placeholder=" ">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="password" aria-describedby="password" placeholder=" ">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="password" class="form-label">Confirm Password</label>
                                                <input type="password" class="form-control" id="password" aria-describedby="password" placeholder=" ">
                                            </div>
                                        </div>
                                        <h5 class="mt-5 mb-2">Account Recovery Questions</h5>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="email" class="form-label">Question 1<sup>*</sup></label>
                                                <select class="form-select form-select-sm" aria-label=".form-select-sm state">
                                                    <option selected="">What elementary school/high school did you attend? </option>
                                                    <option value="AL">What is your mother’s maiden name?</option>
                                                    <option value="AK">What is your favorite movie? </option>
                                                    <option value="AZ">What was your favorite sport in high school?</option>
                                                    <option value="AR">In what city did you meet your spouse/significant other?</option>
                                                    <option value="CA">What is the middle name of your youngest child?</option>
                                                    <option value="CO">In what city or town did your mother and father meet?</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="email" class="form-label">Answer 1 <sup>*</sup></label>
                                                <input type="email" class="form-control" id="email" aria-describedby="Answer 1 " placeholder=" ">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="email" class="form-label">Question 2<sup>*</sup></label>
                                                <select class="form-select form-select-sm" aria-label=".form-select-sm state">
                                                    <option selected="">What elementary school/high school did you attend? </option>
                                                    <option value="AL">What is your mother’s maiden name?</option>
                                                    <option value="AK">What is your favorite movie? </option>
                                                    <option value="AZ">What was your favorite sport in high school?</option>
                                                    <option value="AR">In what city did you meet your spouse/significant other?</option>
                                                    <option value="CA">What is the middle name of your youngest child?</option>
                                                    <option value="CO">In what city or town did your mother and father meet?</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="email" class="form-label">Answer 2 <sup>*</sup></label>
                                                <input type="email" class="form-control" id="email" aria-describedby="Answer 1 " placeholder=" ">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="email" class="form-label">Question 3<sup>*</sup></label>
                                                <select class="form-select form-select-sm" aria-label=".form-select-sm state">
                                                    <option selected="">What elementary school/high school did you attend? </option>
                                                    <option value="AL">What is your mother’s maiden name?</option>
                                                    <option value="AK">What is your favorite movie? </option>
                                                    <option value="AZ">What was your favorite sport in high school?</option>
                                                    <option value="AR">In what city did you meet your spouse/significant other?</option>
                                                    <option value="CA">What is the middle name of your youngest child?</option>
                                                    <option value="CO">In what city or town did your mother and father meet?</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="email" class="form-label">Answer 3 <sup>*</sup></label>
                                                <input type="email" class="form-control" id="email" aria-describedby="Answer 1 " placeholder=" ">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row justify-content-center">
                                <div class="d-flex justify-content-right">
                                    <button type="submit" class="btn btn-primary">Pay and Create Account </button>
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
