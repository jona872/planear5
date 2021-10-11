@extends('layouts.app')

@section('content')
<div class="container-xl">
	<div class="card">

		<form action="{{ route('relevamientos.export-tool') }}" method="POST" class="form-horizontal form-create">
			@csrf

			<div class="card-header"><i class="fa fa-plus"></i> Seleccione datos a exportar </div>

			<div class="card-body">

				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
						<strong>Seleccione el proyecto</strong>
						<select id="pList" name="pList" class="form-control form-select">
							<option value=""> Seleccione Proyecto </option>
							@foreach($projects ?? '' as $project)
							<option value="{{ $project->id }}">{{ $project->project_name }}</option>
							<input hidden name="pName" value="{{ $project->project_name }}" />
							@endforeach
						</select>

					</div>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
						<strong>Seleccione la herramienta</strong>
						<select id="tList" name="tList" class="form-control form-select">
							<option value=""> Seleccione Herramienta </option>
						</select>

					</div>
				</div>


				<div class="col-xs-12 col-sm-12 col-md-12 text-center">
					<a href="/relevamientos" class="btn btn-danger">Cancelar </a>
					<button type="submit" class="btn btn-primary">Continuar</button>
				</div>

			</div>
		</form>
	</div>
</div>

@endsection

@section('footer-scripts')
@include('scripts.getProjectTools')
@endsection