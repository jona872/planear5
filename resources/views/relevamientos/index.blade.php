@extends('layouts.app')

@section('content')
<?php
session()->forget('toolData');
session()->forget('tid');
session()->forget('pid');
?>

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

<div class="row">
	<div class="col">
		<div class="card">
			<!-- TITLE -->
			<div class="card-header"><i class="fa fa-align-justify"></i> Relevamientos
				<a href="/relevamientos/pre-create" role="button" class="btn btn-primary btn-spinner btn-sm pull-right m-b-0">
					<i class="fa fa-plus"></i>&nbsp; Crear Relevamiento
				</a>
			</div>
			<!-- TITLE -->
			<div class="card-body">
				<!-- SEARCH -->
				<div class="container">
					<div class="row">
						<div class="col-6">
							<select class="form-control form-select">
								<option value='project_name'>Buscar por Nombre de Proyecto</option>
								<option value='project_date'>Buscar por Fecha de Relevamiento</option>
							</select>
						</div>
						<div class="col-6">
							<form action="{{ route('relevamientos.name-search') }}" method="POST" class="form-horizontal form-create">
								@csrf
								<!-- NOMBRE -->
								<div name-search="project_name" class="row justify-content-md-between">
									<div class="col form-group">
										<div class="input-group">
											<input class="form-control" name="search"> <span class="input-group-append">
												<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp; Search</button></span>
										</div>
									</div>
								</div>
							</form>


							<form action="{{ route('relevamientos.date-search') }}" method="POST" class="form-horizontal form-create">
								@csrf
								<!-- FECHA -->
								<div date-search="project_date" style="display: none; margin-left: 2%;" class="container">

									<div class="row">

										<div class="row">
											<input name="searchStart" data-provide="datepicker" class="form-control col" data-date-format="dd/mm/yyyy">
											<div class="form-control input-group-addon col-2">hasta</div>
											<input name="searchEnd" data-provide="datepicker" class="form-control col" data-date-format="dd/mm/yyyy">
										</div>
										<div class="col">
											<!-- <span class="input-group-append col">  -->
											<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp; Search</button>
											<!-- </span> -->
										</div>
									</div>
								</div>


							</form>
							<br>
						</div>
					</div>
				</div>

				<!-- SEARCH -->
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<th>Proyecto</th>
							<th>Herramienta</th>
							<th>Fecha</th>
							<th>Responsable</th>
							<th>Latitud;Longitud</th>
							<th>Operaciones</th>
						</thead>
						@if (count($relevamientos) > 0)
						@foreach ($relevamientos as $u)
						<tbody>
							<td>{{$u->project_name }}</td>
							<td>{{$u->tool_name }}</td>
							<td>{{\Carbon\Carbon::parse($u->created_at)->format('d-m-Y')}}</td>
							<td>{{$u->relevamiento_creator}}</td>
							<td>{{$u->name}}</td>
							<!-- <td>{{$u->relevamiento_latitud." ; ".$u->relevamiento_longitud }}</td> -->
							<td>
								<div class="row no-gutters">
									<div class="col-auto">
										<a href="{{ route('relevamientos.show',$u->id) }}" title="Detalles" role="button" class="btn btn-sm btn-primary">
											<i class="fa fa-eye"></i>
										</a>
									</div>
									<div class="col-auto" style="margin: 0 2%">
										<a href="/relevamientos/{{$u->id}}/edit" title="Edit" role="button" class="btn btn-sm btn-warning">
											<i class="fa fa-edit"></i>
										</a>
									</div>
									<form class="col" action="{{ route('relevamientos.destroy',$u->id) }}" method="POST">
										@csrf
										@method('DELETE')
										<button type="submit" title="Borrar" class="btn btn-sm btn-danger">
											<i class="fa fa-trash-o"></i>
										</button>
									</form>
								</div>
							</td>
						</tbody>
						@endforeach
						@else
						<tbody>
							<tr>
								<td align="center" colspan="6">No se encontraron resultados </td>
							</tr>
						</tbody>
						@endif

					</table>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection

@section('footer')
<br>
<form action="{{ route('relevamientos.export') }}" method="POST" class="form-horizontal form-create">
	@csrf

	<button type="submit" class="btn btn-sm btn-dark btn-spinner">
		<i class="fa fa-upload" aria-hidden="true"></i> &nbsp; Exportar Datos
	</button>

	<a href="{{ route('relevamientos.import-picker') }}" title="Importar" role="button" class="btn btn-sm btn-dark">
		<i class="fa fa-download" aria-hidden="true"></i> &nbsp; Importar Datos
	</a>

</form>


@endsection


@section('footer-scripts')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.standalone.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>


<script type="text/javascript">
	$(document).ready(function() {



		$('.datepicker').datepicker();

		$('.input-daterange input').each(function() {
			$('.datepicker').datepicker({
				startDate: '-3d'
			});
			// $(this).datepicker('clearDates');
		});

		console.log("index projects");
		$("select").on("change", function() {
			if ($(this).val() == 'project_date') {
				$('div[name-search]').hide();
				$('div[date-search]').show();
			} else if ($(this).val() == 'project_name') {
				$('div[name-search]').show();
				$('div[date-search]').hide();
			}
		}).change()


	});
</script>

@endsection