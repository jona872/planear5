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



<div class="container-xl">
	<div class="card">
		<form action="{{ route('tools.update',$tool->id) }}" method="POST" class="form-horizontal form-create">
			@csrf

			@method('PUT')
			<input name="id" type="hidden" value="{{ $tool->id }}">

			<div class="card-header"><i class="fa fa-plus"></i> Editar Herramienta </div>

			<div class="card-body">

				<div class="form-group row align-items-center has-success">
					<label for="tool_name" class="col-form-label text-md-right col-md-3">
						<strong> Nombre de la Herramienta </strong>
					</label>
					<div class="col-md-9 col-xl-7">
						<input type="text" id="tool_name" name="tool_name" value="{{ $tool->tool_name }}" class="form-control form-control-success" aria-required="true" aria-invalid="false">
					</div>
				</div>

				<div class="form-group row align-items-center has-success">
					<input name="user_id" type="hidden" value="{{ $tool->user_id }}">
					<label for="creator" class="col-form-label text-md-right col-md-3">
						<strong> Creador </strong>
					</label>
					<div class="col-md-9 col-xl-7">
						<input type="text" id="creator" name="creator" value="{{ $tool->creator }}" class="form-control form-control-success" 
							aria-required="true" aria-invalid="false" readonly>
					</div>
				</div>


				<div class="card-header"> Preguntas asociadas a la herramienta </div>
				<br>
				<div class="container">
					<div class="row">
						@for($i = 0; $i < count($toolData) ; $i++) <div class="col-md-6">
							<!-- izquierda -->
							<div class="row" style="padding: 1%;">
								<!-- ROW -->
								<div class="col-md-8">
									<input type="hidden" name="data_id{{$i}}" class="form-control" value="{{ $toolData[$i]->id }}">
									<input type="text" name="data_question{{$i}}" class="form-control" value="{{ $toolData[$i]->data_question }} ">
								</div>
								<div class="col-2">
									<a class="btn btn-danger" href="/data/destroy/{{$toolData[$i]->id}}" method="post">Eliminar</a>
								</div>
							</div> <!-- ROW -->
					</div>


					@endfor
				</div>
			</div>




			<div class="card-footer text-center">
				<a class="btn btn-danger" href="{{ route('tools.index') }}">
					<i class="fa fa-ban"></i> Cancelar</a>
				<button type="submit" class="btn btn-primary">
					<i class="fa fa-download"></i> Guardar

				</button>
			</div>
		</form>
	</div>
</div>

@endsection