@extends('layouts.app')

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
		<form action="{{ route('projects.update',$projects[0]->id) }}" method="POST" class="form-horizontal form-create">
			@csrf
			@method('PUT')
			<input name="id" type="hidden" value="{{ $projects[0]->id }}">

			<div class="card-header"><i class="fa fa-plus"></i> Editar Proyecto </div>

			<div class="card-body">

				<div class="form-group row align-items-center has-success">
					<label for="project_name" class="col-form-label text-md-right col-md-3">
						<strong> Nombre Proyecto </strong>
					</label>
					<div class="col-md-9 col-xl-7">
						<input type="text" id="project_name" name="project_name" value="{{ $projects[0]->project_name }}" class="form-control form-control-success" aria-required="true" aria-invalid="false">
					</div>
				</div>

				<div class="form-group row align-items-center">
					<label for="" class="col-form-label text-md-right col-md-3"><strong>Ciudad</strong></label>
					<div class="col-md-9 col-xl-7">
						<select name="city_id" class="form-control form-select">
							@if($cities ?? '' )
							<option value="">{{ $projects[0]->city_name }}</option>
							@foreach($cities ?? '' as $city)
							<option value="{{ $city->id }}">{{ $city->city_name }}</option>
							@endforeach
							@endif
						</select>
					</div>
				</div>



				<div class="form-group row align-items-center has-success">
					<label for="project_creator" class="col-form-label text-md-right col-md-3">
						<strong> Creador </strong>
					</label>
					<div class="col-md-9 col-xl-7">
						<input type="text" id="project_creator" name="project_creator" value="{{ Auth::user()->name }}" readonly class="form-control form-control-success" aria-required="false" aria-invalid="false">
					</div>
				</div>

				<div class="form-group row align-items-center has-success">
					<label for="project_latitud" class="col-form-label text-md-right col-md-3"><strong>Latitud</strong></label>
					<div class="col-md-9 col-xl-7">
						<input type="text" id="project_latitud" name="project_latitud" value="{{ $projects[0]->project_latitud }}" class="form-control form-control-success" aria-required="false" aria-invalid="false">
					</div>
				</div>

				<div class="form-group row align-items-center has-success">
					<label for="project_longitud" class="col-form-label text-md-right col-md-3"><strong>Longitud</strong></label>
					<div class="col-md-9 col-xl-7">
						<input type="text" id="project_longitud" name="project_longitud" value="{{ $projects[0]->project_longitud }}" class="form-control form-control-success" aria-required="false" aria-invalid="false">
					</div>
				</div>

			</div>

			<div class="card-footer text-center">
				<a class="btn btn-danger" href="{{ route('projects.index') }}">
					<i class="fa fa-ban"></i> Cancelar</a>
				<button type="submit" class="btn btn-primary">
					<i class="fa fa-download"></i> Guardar

				</button>
			</div>
		</form>
	</div>
</div>

@endsection