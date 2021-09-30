<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<title>UNL</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- CSRF Token -->
	<!-- <script src="{{ asset('js/app.js') }}"></script> -->


	<!-- IMPORTANTE -->
	<!-- <link rel="stylesheet" href="{{ asset('css/app2.css')}}"> -->
	<link rel="stylesheet" href="{{ asset('css/admin.css')}}">
	<link rel="stylesheet" href="{{ asset('fonts/bootstrap-icons/font/bootstrap-icons.css')}}">
	<!-- <link rel="stylesheet" href="{{ asset('css/appTest.css')}}"> -->


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
		<div class="sidebar">
			<nav class="sidebar-nav ps">
				<ul class="nav">
					<li class="nav-title">Principal</li>
					<li class="nav-item"><a class="nav-link" href="/projects"><i class="nav-icon icon-plane"></i>Proyectos</a></li>
					<li class="nav-item"><a class="nav-link" href="/tools"><i class="nav-icon icon-globe"></i> Herramientas</a></li>
					<li class="nav-item"><a class="nav-link" href="/relevamientos"><i class="nav-icon icon-ghost"></i> Relevamientos</a></li>
					<li class="nav-item"><a class="nav-link" href="/plots"><i class="nav-icon icon-drop"></i> Graficar Datos</a></li>
					<li class="nav-item"><a class="nav-link" href="/calcs"><i class="nav-icon icon-graduation"></i> Registrar Docente</a></li>
					<li class="nav-item"><a class="nav-link" href="/register"><i class="nav-icon icon-graduation"></i> Registrar Docente</a></li>
					<!-- <li class="nav-item"><a class="nav-link" href="http://127.0.0.1:8000/admin/bulk-actions"><i class="nav-icon icon-book-open"></i> #6: Bulk Actions</a></li>
					<li class="nav-item"><a class="nav-link" href="http://127.0.0.1:8000/admin/tags"><i class="nav-icon icon-tag"></i> #7: Tags</a></li> -->

					<li class="nav-item"> </li>
					<li class="nav-title">Administrativo</li>
					<li class="nav-item"><a class="nav-link" href="http://127.0.0.1:8000/admin/admin-users"><i class="nav-icon icon-user"></i> Administrar Usuarios</a></li>

				</ul>

				<div class="ps__rail-x" style="left: 0px; bottom: 0px;">
					<div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
				</div>
				<div class="ps__rail-y" style="top: 0px; right: 0px;">
					<div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
				</div>
			</nav>
			<button class="sidebar-minimizer brand-minimizer" type="button"></button>
		</div> <!-- SIDEBAR -->

		<!-- CONTENT -->
		<main class="main">

			<div id="app" class="container-fluid">
				<!-- <div class="modals">
					
				</div> -->
				<!-- <div>
					<div class="notifications" style="width: 300px; bottom: 0px; right: 0px;"><span>notifications</span>
					</div>
				</div> -->

				@yield('content')


				<!-- <div class="welcome-quote">
					Welcome-quote
				</div> -->
			</div>

		</main><!-- CONTENT -->

	</div>



	<footer class="app-footer">
		<div class="container-fluid">
			<div class="container-xl">
				<span class="pull-right">
					@yield('footer')
					<!-- Powered by <a href="https://docs.brackets.sk/" target="_blank">Craftable.</a> -->
				</span>
			</div>
		</div>
	</footer>




	<!-- <div id="header">
		<div id="headerContent">
			<nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
				<div class="container-fluid">
					<a class="navbar-brand" href="{{ url('/') }}"> FICH UNL </a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
						<span class="navbar-toggler-icon"></span>
					</button>
				</div>
			</nav>
		</div>
	</div> -->



	@stack('react-js-include')
	<!-- <script src="/js/admin.js"></script> -->
	<script src="{{ asset('js/admin.js') }}"></script>
	<!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
	<script src="{{ asset('assets/front/js/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/front/js/jquery-migrate-3.0.1.min.js') }}"></script>
	<script src="{{ asset('assets/front/js/popper.min.js') }}"></script>
	<script src="{{ asset('assets/front/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/front/js/jquery.easing.1.3.js') }}"></script>
	<script src="{{ asset('assets/front/js/jquery.waypoints.min.js') }}"></script>
	<script src="{{ asset('assets/front/js/jquery.stellar.min.js') }}"></script>
	<script src="{{ asset('assets/front/js/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('assets/front/js/jquery.magnific-popup.min.js') }}"></script>
	<script src="{{ asset('assets/front/js/aos.js') }}"></script>
	<script src="{{ asset('assets/front/js/jquery.animateNumber.min.js') }}"></script>
	<script src="{{ asset('assets/front/js/scrollax.min.js') }}"></script>
	@yield('footer-scripts')
	<!-- // ACA -->
	<!-- <script src="http://code.jquery.com/jquery-1.9.1.js"></script> -->
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	@include('scripts.tmp')

</body>

</html>