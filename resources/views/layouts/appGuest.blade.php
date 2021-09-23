<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<title>UNL</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- CSRF Token -->
	

	<!-- IMPORTANTE -->
	<link rel="stylesheet" href="{{ asset('css/admin.css')}}">

	@stack('react-css-include')
</head>

<body class="app header-fixed sidebar-fixed sidebar-lg-show">

	<!-- NAVBAR -->
	<header class="app-header navbar">
		<!-- Hidden Burger icon -->
		<button class="navbar-toggler sidebar-toggler d-lg-none" type="button" data-toggle="sidebar-show">
			<span class="navbar-toggler-icon"></span>
		</button>

		<a href="http://127.0.0.1:8000/admin" class="navbar-brand">
			<h1>UNL</h1>
		</a>
		<!-- Nav's Right side -->
		<ul class="navbar-nav ml-auto">
					<!-- Authentication Links -->
					@guest
					<li class="nav-item">
						<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
					</li>
					@if (Route::has('register'))
					<li class="nav-item">
						<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
					</li>
					@endif
					@else
					<li class="nav-item dropdown">
						<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
							{{ Auth::user()->name }} <span class="caret"></span>
						</a>

						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
								{{ __('Logout') }}
							</a>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</div>
					</li>
					@endguest
				</ul>

	</header> <!-- /NAVBAR -->


	<div class="app-body">
		<!-- SIDEBAR -->

		<!-- CONTENT -->
		<main class="main">

			<div id="app" class="container-fluid">
				<div class="modals">
					<!---->
				</div>
				<div>
					<div class="notifications" style="width: 300px; bottom: 0px; right: 0px;"><span></span></div>
				</div>
				<div class="welcome-quote">
					@yield('content')
				</div>
			</div>

		</main><!-- CONTENT -->

	</div>


	@stack('react-js-include')
	<script src="{{ asset('js/admin.js') }}"></script>
</body>

</html>