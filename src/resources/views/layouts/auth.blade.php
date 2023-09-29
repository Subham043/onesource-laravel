<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>1Source | Appointment Management</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}" />
    <!-- H1source Design  Css Built -->
    <link rel="stylesheet" href="{{asset('assets/css/1source.css')}}" />
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}" />

    @yield('css')
</head>

<body class="  ">
    <div class="cwrapper">
        <!-- loader Start -->
        @include('includes.loader')
        <!-- loader END -->
        <div class="wrapper">
            <section class="login-content">
                @yield('content')
            </section>
        </div>
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

    @yield('javascript')
</body>

</html>
