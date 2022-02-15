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
		<form action="{{ route('relevamientos.store') }}" method="POST" class="form-horizontal form-create">
			@csrf
			@method('POST')
			<input name="id" type="hidden" value="{{ $relevamientos[0]->id }}">

			<div class="card-header"><i class="fa fa-plus"></i> Editar Relevamiento </div>
			<div class="card-body">
			<!-- PROYECTO -->
				<div class="form-group row align-items-center">
					<label for="" class="col-form-label text-md-right col-md-3"><strong>Proyecto: </strong></label>
					<div class="col-md-9 col-xl-7">
						<select name="city_id" class="form-control form-select">
							@if($cities ?? '' )
							<option value="">{{ $relevamientos[0]->city_name }}</option>
							@foreach($cities ?? '' as $city)
							<option value="{{ $city->id }}">{{ $city->city_name }}</option>
							@endforeach
							@endif
						</select>
					</div>
				</div>
				<!-- HERRAMIENTA -->
				<div class="form-group row align-items-center">
					<label for="" class="col-form-label text-md-right col-md-3"><strong>Herramienta: </strong></label>
					<div class="col-md-9 col-xl-7">
						<select name="city_id" class="form-control form-select">
							@if($cities ?? '' )
							<option value="">{{ $relevamientos[0]->city_name }}</option>
							@foreach($cities ?? '' as $city)
							<option value="{{ $city->id }}">{{ $city->city_name }}</option>
							@endforeach
							@endif
						</select>
					</div>
				</div>

			</div>

			<div class="card-footer text-center">
				<a class="btn btn-danger" href="{{ route('relevamientos.index') }}">
					<i class="fa fa-ban"></i> Cancelar</a>
				<button type="submit" class="btn btn-primary">
					<i class="fa fa-download"></i> Continuar

				</button>
			</div>
		</form>
	</div>
</div>

@endsection