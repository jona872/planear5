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
		<form action="{{ route('relevamientos.poscreate') }}" method="POST" class="form-horizontal form-create">
			@csrf
			<div class="card-header"><i class="fa fa-plus"></i> Agregar Relevamiento </div>

			<div class="card-body">

				<div class="form-group row align-items-center">
					<label for="" class="col-form-label text-md-right col-md-3"><strong>Proyecto</strong></label>
					<div class="col-md-9 col-xl-7">
						<select name="project_id" class="form-control form-select">
							<option value=""> Seleccione Proyecto </option>
							@foreach($projects ?? '' as $project)
							<option value="{{ $project->id }}">{{ $project->project_name }}</option>
							@endforeach
						</select>
					</div>
				</div>
				
				<div class="form-group row align-items-center">
					<label for="" class="col-form-label text-md-right col-md-3"><strong>Herramienta</strong></label>
					<div class="col-md-9 col-xl-7">
						<select name="tool_id" class="form-control form-select">
							<option value=""> Seleccione Herramienta </option>
							@foreach($tools ?? '' as $tool)
							<option value="{{ $tool->id }}">{{ $tool->tool_name }}</option>
							@endforeach
						</select>
					</div>
				</div>

			</div>

			<div class="card-footer">
				<a class="btn btn-danger" href="{{ route('relevamientos.index') }}">
					<i class="fa fa-ban"></i> Cancelar</a>
				<button type="submit" class="btn btn-primary">
					<i class="fa fa-arrow-right"></i> Continuar
				</button>
			</div>
		</form>
	</div>
</div>
@endsection