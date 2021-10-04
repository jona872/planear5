@extends('layouts.app')

@section('content')
<div class="container-xl">
	<div class="card">
		<form action="{{ route('data.customize') }}" method="POST" class="form-horizontal form-create">
			@csrf

			<div class="card-header"><i class="fa fa-plus"></i> Agregando preguntas </div>

			<div class="card-body">

				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
						<strong>Seleccione a que herramienta se agregaran los campos:</strong>
						<select name="tool_id" class="form-control form-select">
							<option value=""> Seleccione Herramienta </option>
							@foreach($tools ?? '' as $tool)
							<option value="{{ $tool->id }}">{{ $tool->tool_name }}</option>
							@endforeach
						</select>
						
					</div>
				</div>


				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
						<strong>Cantidad de campos a agregar:</strong>
						<input type="number" name="count" class="form-control" placeholder="cantidad de campos a agregar" onkeypress="return isNumber(event)">
					</div>
				</div>



				<div class="col-xs-12 col-sm-12 col-md-12 text-center">
					<a href="/tools" class="btn btn-danger">Cancelar </a>
					<button type="submit" class="btn btn-primary">Continuar</button>
				</div>

			</div>
		</form>
	</div>
</div>

@endsection

@section('footer-scripts')
@include('scripts.onlyNumber')
@endsection