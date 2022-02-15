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
		<form action="{{ route('relevamientos.update', $relevamiento->id) }}" method="POST" class="form-horizontal form-create">
			@csrf

			@method('PUT')
			<input name="id" type="hidden" value="{{ $relevamiento->id }}">
			<div class="card-header"><i class="fa fa-plus"></i> Editar Relevamiento </div>
			<div class="card-body">
				<div class="form-group row align-items-center">
					<label for="" class="col-form-label text-md-right col-md-3"><strong>Proyecto</strong></label>
					<div class="col-md-9 col-xl-7">
						<select name="project_id" class="form-control form-select">
							<option value=""> {{$actualP->project_name}} </option>
							@if (count($projects)>1)
							@foreach($projects ?? '' as $project)
							<option value="{{ $project->id }}">{{ $project->project_name }}</option>
							@endforeach
							@endif
						</select>
					</div>
				</div>

				<div class="form-group row align-items-center has-success">
					<label for="tool_id" class="col-form-label text-md-right col-md-3">
						<strong> Herramienta </strong>
					</label>
					<div class="col-md-9 col-xl-7">
						<input type="text" id="tool_id" name="tool_id" value="{{$tools->tool_name}}" readonly class="form-control form-control-success" aria-required="false" aria-invalid="false">
					</div>
				</div>

				<!-- PREGUNTAS -->

				<div class="card-header"> Preguntas asociadas a la Relevamiento </div>
				<br>
				@for($i = 0; $i < count($relevamientoData) ; $i++)
					<div class="form-group row align-items-center has-success">
						<label for="answer_name{{$i}}" class="col-form-label text-md-right col-md-3">
							<strong> {{$relevamientoData[$i]->data_question}} </strong>
						</label>
						<div class="col-md-9 col-xl-7">
						<input type="hidden" name="answer_id{{$i}}" class="form-control" value="{{ $relevamientoData[$i]->answer_id }}">
							<input type="text" id="answer_name{{$i}}" name="answer_name{{$i}}" class="form-control form-control-success" 
							aria-required="true" aria-invalid="false" value="{{ $relevamientoData[$i]->answer_name }}">
						</div>
					</div>

				@endfor


				
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