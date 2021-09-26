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

<div class="row">
	<div class="col">
		<div class="card">
			<!-- TITLE -->
			<div class="card-header"><i class="fa fa-align-justify"></i> Relevamientos
				<a href="relevamientos/pre-create" role="button" class="btn btn-primary btn-spinner btn-sm pull-right m-b-0">
					<i class="fa fa-plus"></i>&nbsp; Crear Relevamiento
				</a>
			</div>
			<!-- TITLE -->
			<div class="card-body">
				<!-- SEARCH -->
				<form>
					<div class="row justify-content-md-between">
						<div class="col col-lg-7 col-xl-5 form-group">
							<div class="input-group"><input placeholder="Search" class="form-control"> <span class="input-group-append"><button type="button" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp; Search</button></span></div>
						</div>
					</div>
				</form>
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
						@foreach ($relevamientos as $u)
						<tbody>
							<td>{{$u->project_name }}</td>
							<td>{{$u->tool_name }}</td>
							<td>{{$u->created_at}}</td>
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
										<a href="relevamientos/{{$u->id}}/edit" title="Edit" role="button" class="btn btn-sm btn-warning">
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

					</table>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection