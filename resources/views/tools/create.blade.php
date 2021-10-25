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



<div class="container-xl">
	<div class="card">
		<form action="{{ route('tools.store') }}" method="POST" class="form-horizontal form-create">
			@csrf
			<div class="card-header"><i class="fa fa-plus"></i> Agregar Herramienta </div>

			<div class="card-body">

				<div class="form-group row align-items-center has-success">
					<label for="tool_name" class="col-form-label text-md-right col-md-3">
						<strong> Nombre Herramienta </strong>
					</label>
					<div class="col-md-9 col-xl-7">
						<input type="text" id="tool_name" name="tool_name" placeholder="Nombre Herramienta" class="form-control form-control-success" aria-required="true" aria-invalid="false">
					</div>
				</div>

				<div class="form-group row align-items-center has-success">
					<label for="project_creator" class="col-form-label text-md-right col-md-3">
						<strong> Creador </strong>
					</label>
					<div class="col-md-9 col-xl-7">
						<input type="text" id="project_creator" name="project_creator" class="form-control form-control-success" aria-required="true" aria-invalid="false" value="{{ Auth::user()->name }}" readonly>
						<input type="text" id="user_id" name="user_id" class="form-control form-control-success" value="{{ Auth::user()->id }}" hidden>
					</div>
				</div>


				<div class="col-xs-12 col-sm-12 col-md-12 text-center">
					<a class="btn btn-danger" href="{{ route('tools.index') }}">
						<i class="fa fa-ban"></i> Cancelar</a>
					<button type="submit" class="btn btn-primary">
						<i class="fa fa-download"></i> Guardar
					</button>
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