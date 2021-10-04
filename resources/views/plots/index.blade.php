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
		<form action="{{ route('plots.process') }}" method="POST" class="form-horizontal form-create">
			@csrf
			@method('POST')
			<div class="card-header"><i class="fa fa-plus"></i> Generar Grafico </div>

			<div class="card-body">

				<div class="form-group row align-items-center">
					<label for="project_name" class="col-form-label text-md-right col-md-3"><strong>Proyecto</strong></label>
					<div class="col-md-6 col-xl-6">
						<select name="project_id" class="form-control form-select">
							<option value=""> Seleccione Proyecto </option>
							@foreach($projects as $project)
							<option value="{{ $project->id }}">{{ $project->project_name }}</option>
							@endforeach
						</select>
					</div>
				</div>


				<div class="form-group row align-items-center">
					<label for="" class="col-form-label text-md-right col-md-3"><strong>Tipo de Grafico</strong></label>
					<div class="col-md-6 col-xl-6">
						<select name="plot_id" class="form-control form-select">
							<option value="1"> Linea </option>
							<option value="2"> Barra </option>
							<option value="3"> Doughnut </option>
							<option value="4"> Pie / Torta </option>
						</select>
					</div>
				</div>

				<div class="form-group row align-items-center">
					<label for="" class="col-form-label text-md-right col-md-3"><strong>Método</strong></label>
					<div class="col-md-6 col-xl-6">
						<select name="metodo_id" class="form-control form-select">
							<option value="1"> Promedio </option>
							<option value="2"> Tipo 2 </option>
							<option value="3"> Tipo 3 </option>

						</select>
					</div>
				</div>

			</div>

			<div class="card-footer">
				<button type="submit" class="btn btn-primary"> <i class="fa fa-arrow-right "></i> Continuar </button>
			</div>

		</form>
	</div>
</div>





@endsection

@push('react-js-include')
<!-- //react components -->

@section('footer-scripts')
<script type="text/javascript">
	$(document).ready(function() {
		console.log('PlotController');
	});
</script>

@endsection