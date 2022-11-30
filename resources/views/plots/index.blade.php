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
					<label for="" class="col-form-label text-md-right col-md-3"><strong>Proyecto</strong></label>
					<div class="col-md-9 col-xl-7">
						<select id="pList" name="pList" class="form-control form-select">
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
						<select id="tList" name="tList" class="form-control form-select">
							<option value=""> Seleccione Herramienta </option>
						</select>

					</div>
				</div>


				<div class="form-group row align-items-center">
					<label for="" class="col-form-label text-md-right col-md-3"><strong>Tipo de Grafico</strong></label>
					<div class="col-md-6 col-xl-6">
						<select name="plot_id" class="form-control form-select">
							<option value="1"> Linea </option>
							<option value="2"> Barra </option>
							<option value="3"> Dona </option>
							<option value="4"> Torta </option>
						</select>
					</div>
				</div>

				<div class="form-group row align-items-center">
					<label for="" class="col-form-label text-md-right col-md-3"><strong>Método</strong></label>
					<div class="col-md-6 col-xl-6">
						<select name="metodo_id" class="form-control form-select">
							<option value="1"> Media </option>
							<option value="2"> Media Aritmetica </option>
							<option value="3"> Dispersion </option>
							<option value="4"> Suma </option>

						</select>
					</div>
				</div>
				<div class="form-group row align-items-center has-success">
					<label for="plotTitle" class="col-form-label text-md-right col-md-3">
						<strong> Titulo del grafico </strong>
					</label>
					<div class="col-md-9 col-xl-7">
						<input type="text" id="plotTitle" name="plotTitle" placeholder="Titulo del grafico" class="form-control form-control-success" 
                        aria-required="true" aria-invalid="false">
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
@include('scripts.getProjectTools')
@endsection