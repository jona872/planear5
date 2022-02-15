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

@php
//dd($relevamiento_latitud);
// dd(session()->get('relevamiento_longitud')); -->
@endphp

<div class="container-xl">
	<div class="card">
		<form action="{{ route('relevamientos.store') }}" method="POST" class="form-horizontal form-create">
			@csrf
			<input type="hidden" name="relevamiento_latitud" value="{{ session()->get('relevamiento_latitud') }}">
			<input type="hidden" name="relevamiento_longitud" value="{{ session()->get('relevamiento_longitud') }}">
			<div class="card-header"><i class="fa fa-plus"></i> Agregar Relevamiento </div>

			<div class="card-body">
				@for($i = 0; $i < count($toolData) ; $i++) <div class="form-group row align-items-center has-success">
					<label for="data_question" class="col-form-label text-md-right col-md-3">
						<strong> {{ $toolData[$i]->data_question }} </strong>
					</label>
					<div class="col-md-9 col-xl-7">
						<input type="hidden" name="data_id{{$i}}" class="form-control" value="{{ $toolData[$i]->id }}">
						<input type="text" name="answer_name{{$i}}" class="form-control">
					</div>
			</div>
			@endfor
	</div> <!-- CARD BODY -->

	<div class="card-footer">
		<a class="btn btn-danger" href="{{ route('relevamientos.index') }}">
			<i class="fa fa-ban"></i> Cancelar</a>
		<button type="submit" class="btn btn-primary" id="Enviar">
			<i class="fa fa-arrow-right"></i> Continuar
		</button>
	</div>
	</form>
</div>
</div>
@endsection
