@extends('layouts.app')

@section('content')

@if (session()->has('success'))
<div class="modals alert alert-success">
	@if(is_array(session('success')))
	<ul>
		@foreach (session('success') as $message)
		<li>{{ $message }}</li>
		@endforeach
	</ul>
	@else
	{{ session('success') }}
	@endif
</div>
@endif
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
		<form action="{{ route('relevamientos.import-preview') }}" method='POST' files=true id='file' enctype="multipart/form-data">
			@csrf
			<div class="card-header"><i class="fa fa-plus"></i> Agregar Relevamientos </div>

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

				<div class="form-group row align-items-center">
					<label for="" class="col-form-label text-md-right col-md-3"></label>
					<div class="col-md-9 col-xl-7">
						<div class="input-group">
							<div class="custom-file">
								<input type="file" name="file" class="custom-file-input" id="chooseFile" lang="es">
								<label class="custom-file-label" for="inputGroupFile04">Seleccionar Archivo</label>
							</div>
						</div>
					</div>
				</div>

			</div>

			<div class="card-footer">
				<a class="btn btn-danger" href="{{ route('relevamientos.index') }}">
					<i class="fa fa-ban"></i> Cancelar</a>

				<button type="submit" class="btn btn-primary">
					<i class="fa fa-arrow-right"></i>&nbsp; Continuar
				</button>
				
			</div>
		</form>
	</div>
</div>

@endsection

@section('footer-scripts')

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		console.log("picker");
		bsCustomFileInput.init()

	});
</script>

@endsection