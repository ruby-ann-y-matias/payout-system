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

	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import Materialize CSS-->
	<link type="text/css" rel="stylesheet" href="{{ asset('css/materialize.min.css')}}"  media="screen,projection"/>
	<!-- Import custom CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>
<body>

	<div class="row">
		<div class="col s12 m4">

	<nav>
		<div class="nav-wrapper">
			<a href="#!" class="brand-logo"><img src="{{ asset('img/wagewave.jpg') }}" width="30%"></a>
			<a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
			<ul class="right hide-on-med-and-down">
		        <li>
			        <a href="{{ route('logout') }}"
			        onclick="event.preventDefault();
			        document.getElementById('logout-form').submit();">
			        <i class="material-icons">power_settings_new</i>
			        </a>

			        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			          {{ csrf_field() }}
			        </form>
		        </li>
			</ul>
		</div>
	</nav>

	<ul class="sidenav" id="mobile-demo">
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

		</div>
	</div>

	@yield('content')

	<!-- Import jQuery -->      
	<script type="text/javascript" src="{{ asset('lib/jquery-3.3.1.min.js') }}"></script>
	<!--Import Materialize JS-->
	<script type="text/javascript" src="{{ asset('js/materialize.min.js') }}"></script>

	<script type="text/javascript">

	  $(document).ready(function() {
	    $('.sidenav').sidenav();
	  });

	</script>

	@yield('indiv_js')

</body>
</html>