@extends('layouts.app')
<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
<!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
@section('content')

@if ($errors->any())
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif


<div class="row">
	<div class="col-lg-12 margin-tb">
		<div class="pull-top">
			<h2>Aregar Proyecto</h2>
		</div>
		<div class="pull-right">
			<a class="btn btn-primary" href="{{ route('tools.index') }}"> Back</a>
		</div>
	</div>
</div>

<form action="{{ route('tools.store') }}" method="POST">
	@csrf

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group">
				<strong>Nombre Herramienta:</strong>
				<input type="text" name="tool_name" class="form-control" placeholder="Nombre de Herramienta">
			</div>
		</div>


		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group">
				<strong>Creador:</strong>
				<input type="text" readonly name="project_creator" class="form-control" value="{{ Auth::user()->name }}">
			</div>
		</div>


		<div class="col-xs-12 col-sm-12 col-md-12 text-center">
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>

	</div>
</form>




<!-- For defining autocomplete -->
<!-- <input class="ui-widget" type="text" id='city_search'> -->

<!-- For displaying selected option value from autocomplete suggestion -->
<!-- <inpu/t type="text" id='cityid' readonly> -->

@endsection

<!-- @push('react-js-include') -->
<!-- @section('footer-scripts')
@include('scripts.citySearch')
@endsection -->