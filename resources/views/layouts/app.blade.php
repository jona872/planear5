<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<title>UNL</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- CSRF Token -->
	<script src="{{ asset('js/app.js') }}"></script>
	<link rel="stylesheet" href="{{ asset('css/app.css')}}">
	@stack('react-css-include')

</head>

<body>
	<div>
		@include('layouts.header')
		@yield('navbar')
	</div>
	<div>
		<main>
			@yield('content')
		</main>
	</div>
	@stack('react-js-include')
</body>

</html>