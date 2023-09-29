<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>1Source | Appointment Management</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}" />
    <!-- H1source Design  Css Built -->
    <link rel="stylesheet" href="{{asset('assets/css/iziToast.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/1source.css')}}" />
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}" />
    <!-- Fullcalender CSS -->
    <link rel='stylesheet' href="{{asset('assets/vendor/fullcalendar/core/main.css')}}" />
    <link rel='stylesheet' href="{{asset('assets/vendor/fullcalendar/daygrid/main.css')}}" />
    <link rel='stylesheet' href="{{asset('assets/vendor/fullcalendar/timegrid/main.css')}}" />
    <link rel='stylesheet' href="{{asset('assets/vendor/fullcalendar/list/main.css')}}" />
    @yield('css')
</head>

<body class="  ">
    <div class="cwrapper">
        <!-- loader Start -->
        @include('includes.loader')
        <!-- loader END -->
        @include('includes.sidebar')
        <main class="main-content">
            <div class="position-relative iq-banner">
                <!--Nav Start-->
                @include('includes.header')
                <!-- Nav Header Component Start -->
                <div class="iq-navbar-header" style="height: 175px;">
                    <div class="container-fluid iq-container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="flex-wrap d-flex justify-content-between align-items-center">
                                    <div>
                                        <h1>Dashboard</h1>
                                    </div>
                                    <div> <a href="add-job.html" class="btn btn-link btn-soft-light">Add An Event</a>
                                        <a href="all-events.html" class="btn btn-link btn-soft-light">
                                            View All Events
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- Nav Header Component End -->
                <!--Nav End-->
            </div>
            <div class="conatiner-fluid content-inner mt-n5 py-0">
                @yield('content')
            </div>
            <!-- Footer Section Start -->
            @include('includes.footer')
            <!-- Footer Section End -->
        </main>
    </div>
    <!-- Wrapper End-->
    <!-- offcanvas start -->
    <!-- Library Bundle Script -->
    <script src="{{asset('assets/js/core/libs.min.js')}}"></script>
    <!-- External Library Bundle Script -->
    <script src="{{asset('assets/js/core/external.min.js')}}"></script>
    <!-- fslightbox Script -->
    <script src="{{asset('assets/js/plugins/fslightbox.js')}}"></script>
    <!-- Settings Script -->
    <script src="{{asset('assets/js/plugins/setting.js')}}"></script>
    <!-- Slider-tab Script -->
    <script src="{{asset('assets/js/plugins/slider-tabs.js')}}"></script>
    <!-- Form Wizard Script -->
    <script src="{{asset('assets/js/plugins/form-wizard.js')}}"></script>
    <!-- App Script -->
    <script src="{{asset('assets/js/1source.js')}}" defer></script>
    <!-- Fullcalender Javascript -->
    <script src="{{asset('assets/vendor/fullcalendar/core/main.js')}}"></script>
    <script src="{{asset('assets/vendor/fullcalendar/daygrid/main.js')}}"></script>
    <script src="{{asset('assets/vendor/fullcalendar/timegrid/main.js')}}"></script>
    <script src="{{asset('assets/vendor/fullcalendar/list/main.js')}}"></script>
    <script src="{{asset('assets/vendor/fullcalendar/interaction/main.js')}}"></script>
    <script src="{{asset('assets/vendor/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/calender.js')}}"></script>
    <!-- Axios Script -->
    <script src="{{asset('assets/js/plugins/axios.min.js')}}"></script>
    <!-- Toast Script -->
    <script src="{{asset('assets/js/plugins/iziToast.min.js')}}"></script>
    <!-- Validate Script -->
    <script src="{{asset('assets/js/plugins/just-validate.production.min.js')}}"></script>

    <script type="text/javascript" nonce="{{ csp_nonce() }}">
        @if (session('success_status'))

            iziToast.success({
                title: 'Success',
                message: '{{ Session::get('success_status') }}',
                position: 'bottomCenter',
                timeout:6000
            });

        @endif
        @if (session('error_status'))

            iziToast.error({
                title: 'Error',
                message: '{{ Session::get('error_status') }}',
                position: 'bottomCenter',
                timeout:6000
            });

        @endif

    </script>

    <script type="text/javascript" nonce="{{ csp_nonce() }}">

        const errorToast = (message) =>{
            iziToast.error({
                title: 'Error',
                message: message,
                position: 'bottomCenter',
                timeout:7000
            });
        }
        const successToast = (message) =>{
            iziToast.success({
                title: 'Success',
                message: message,
                position: 'bottomCenter',
                timeout:6000
            });
        }

        const spinner = `
            <span class="d-flex align-items-center">
                <span class="spinner-border flex-shrink-0" role="status">
                    <span class="visually-hidden">Loading...</span>
                </span>
                <span class="flex-grow-1 ms-2">
                    Loading...
                </span>
            </span>
        `;

    </script>

    @yield('javascript')
</body>

</html>
