<!DOCTYPE html>
<html lang="en" dir="ltr">

				<head>
								<meta charset="utf-8">
								<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
								<title>1Source | Appointment Management</title>
								<!-- Favicon -->
								<link rel="shortcut icon" href="{{ asset("assets/images/favicon.ico") }}" />
								<!-- H1source Design  Css Built -->
								<link rel="stylesheet" href="{{ asset("assets/css/iziToast.min.css") }}" />
								<link rel="stylesheet" href="{{ asset("assets/css/1source.css") }}" />
								<!-- Custom Css -->
								<link rel="stylesheet" href="{{ asset("assets/css/custom.css") }}" />
								<!-- Fullcalender CSS -->
								<link rel='stylesheet' href="{{ asset("assets/vendor/fullcalendar/core/main.css") }}" />
								<link rel='stylesheet' href="{{ asset("assets/vendor/fullcalendar/daygrid/main.css") }}" />
								<link rel='stylesheet' href="{{ asset("assets/vendor/fullcalendar/timegrid/main.css") }}" />
								<link rel='stylesheet' href="{{ asset("assets/vendor/fullcalendar/list/main.css") }}" />
								<style nonce="{{ csp_nonce() }}">
												.header-auth-img {
																object-fit: contain;
																height: 50px;
																width: 50px;
																border: 1px solid #ccc;
																border-radius: 50%;
												}
								</style>
								@yield("css")
				</head>

				<body class="">
								<div class="cwrapper">
												<main class="main-content">
																<div class="conatiner-fluid py-0">
																				@yield("content")
																</div>
												</main>
								</div>
				</body>

</html>
