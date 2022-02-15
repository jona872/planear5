@extends('layouts.app')

@section('content')
<div class="container-xl">
	<div class="card">

		<form action="{{ route('data.store') }}" method="POST" class="form-horizontal form-create">
			@csrf
			<input type="hidden" name="tool_id" class="form-control" value={{ $params['tool_id'] }}>

			<div class="card-header"><i class="fa fa-plus"></i> Agregando preguntas a:  {{$params['tool_name']}} </div>

			<div class="card-body">

				@for ($i = 0; $i < $params['count']; $i++) <div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
						<strong>Nombre del campo:</strong>
						<input type="text" name="data_question{{$i}}" class="form-control">
					</div>
			</div>
			@endfor


			<div class="col-xs-12 col-sm-12 col-md-12 text-center">
				<a href="/tools" class="btn btn-danger">Cancelar </a>
				<button type="submit" class="btn btn-primary">Continuar</button>
			</div>


		</form>
	</div>
</div>


@endsection

@section('footer-scripts')
@include('scripts.onlyNumber')
@endsection