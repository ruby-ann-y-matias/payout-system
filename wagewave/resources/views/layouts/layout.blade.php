<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
	<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

	<title>{{ config('app.name') }}</title>

	<link href="https://fonts.googleapis.com/css?family=Kavoon|Tillana" rel="stylesheet">

	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import Materialize CSS-->
	<link type="text/css" rel="stylesheet" href="{{ asset('css/materialize.min.css')}}"  media="screen,projection"/>
	<!-- Import custom CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>
<body class="grey lighten-2">

	<ul id="slideOut" class="sidenav fixed z-depth-2 indigo darken-2">
		<li class="center no-padding cyan lighten-5">
			<div id="brand">
				<div class="row">
					<img id="layoutImg" src="{{ asset('img/wagewave.jpg') }}" width="50%" class="responsive-img">

					<h6 class="grey-text">v1.0.0</h6>
				</div>
			</div>
		</li>
		<li><a class="waves-effect" href="{{ url('/home') }}">
			<i class="material-icons">dashboard</i><b>Dashboard</b></a>
		</li>
		<li><a class="waves-effect" href="{{ url('/employees') }}">
			<i class="material-icons">people</i><b>Employees</b></a>
		</li>
		<li><a class="waves-effect" href="{{ url('/payout') }}">
			<i class="material-icons">payment</i><b>Payout</b></a>
		</li>
		<li><a class="waves-effect" href="{{ url('/timesheet') }}">
			<i class="material-icons">timer</i><b>Timesheet</b></a>
		</li>
		<li><a class="waves-effect" href="{{ url('/jobs') }}">
			<i class="material-icons">build</i><b>Jobs</b></a>
		</li>
		<li><a class="waves-effect" href="{{ url('/settings') }}">
			<i class="material-icons">settings</i><b>Settings</b></a>
		</li>
		<li id="closeBtn"><a class="sidenav-close" href="#!">
			<i class="material-icons">close</i><b>Close</b></a>
		</li>
	</ul>

	<header>
		<nav class="cyan lighten-5" role="navigation">
			<div class="nav-wrapper">
				<img id="navImg" src="{{ asset('img/wagewave.jpg') }}" class="responsive-img">

				<ul class="right">
					<li>
						<a class="right dropdown-trigger btn" data-target="userDropdown" href="#">
							<i class="material-icons">account_circle</i>
						</a>
					</li>
				</ul>

				<ul class="dropdown-content" id="userDropdown">
					<li>
				        <a href="{{ route('logout') }}"
				        onclick="event.preventDefault();
				        document.getElementById('logout-form').submit();">
				        <i class="material-icons">power_settings_new</i> Logout
				        </a>

				        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				          {{ csrf_field() }}
				        </form>
				    </li>
				</ul>

				<a class="sidenav-trigger btn" href="#" data-target="slideOut">
					<i class="material-icons">menu</i>
				</a>
			</div>
		</nav>

		@yield('breadcrumb')

	</header>

	@yield('content')

	<script src="{{ asset('js/sweetalert.min.js') }}"></script>

    <!-- Include this after the sweet alert js file -->
    @include('sweet::alert')

	<!-- Import jQuery -->      
	<script type="text/javascript" src="{{ asset('lib/jquery-3.3.1.min.js') }}"></script>
	<!--Import Materialize JS-->
	<script type="text/javascript" src="{{ asset('js/materialize.min.js') }}"></script>

	<script type="text/javascript">

		$(document).ready(function() {
			$('.sidenav').sidenav();
			$('.dropdown-trigger').dropdown();
		});

	</script>

	@yield('indiv_js')

</body>
</html>