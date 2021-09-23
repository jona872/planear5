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
		<form action="{{ route('relevamientos.update',$relevamiento->id) }}" method="POST" class="form-horizontal form-create">
			@csrf

			@method('PUT')
			<input name="id" type="hidden" value="{{ $relevamiento->id }}">

			<div class="card-header"><i class="fa fa-plus"></i> Editar Relevamiento </div>

			<div class="card-body">

				<div class="form-group row align-items-center has-success">
					<input name="user_id" type="hidden" value="{{ $relevamiento->user_id }}">
					<label for="creator" class="col-form-label text-md-right col-md-3">
						<strong> Creador </strong>
					</label>
					<div class="col-md-9 col-xl-7">
						<input type="text" id="creator" name="creator" value="{{ $relevamiento->creator }}" 
						class="form-control form-control-success" aria-required="true" aria-invalid="false" readonly>
					</div>
				</div>


				<div class="card-header"> Datos recolectados </div>
				<br>
				<div class="form-group row align-items-center has-success">
					<label for="project_name" class="col-form-label text-md-right col-md-3">
						<strong> PREGUNTA </strong>
					</label>
					<div class="col-md-9 col-xl-7">
						<input type="text" id="project_name" name="project_name" value="RESPUESTA" 
								class="form-control form-control-success" aria-required="true" aria-invalid="false">
					</div>
				</div>


				<div class="card-footer text-center">
					<a class="btn btn-danger" href="{{ route('relevamientos.index') }}">
						<i class="fa fa-ban"></i> Cancelar</a>
					<button type="submit" class="btn btn-primary">
						<i class="fa fa-download"></i> Guardar

					</button>
				</div>
		</form>
	</div>
</div>

@endsection