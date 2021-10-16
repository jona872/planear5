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
		<form action="{{ route('admin-panel.update',$user->id) }}" method="POST" class="form-horizontal form-create">
			@csrf
			@method('PUT')
			<div class="card-header"><i class="fa fa-plus"></i> Editar Usuario </div>

			<div class="card-body">

				<div class="form-group row align-items-center has-success">
					<label for="name" class="col-form-label text-md-right col-md-3">
						<strong> Nombre </strong>
					</label>
					<div class="col-md-9 col-xl-7">
						<input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control form-control-success" aria-required="true" aria-invalid="false">
					</div>
				</div>
                <div class="form-group row align-items-center has-success">
					<label for="email" class="col-form-label text-md-right col-md-3">
						<strong> Email </strong>
					</label>
					<div class="col-md-9 col-xl-7">
						<input type="text" id="email" name="email" value="{{ $user->email }}" class="form-control form-control-success" aria-required="true" aria-invalid="false">
					</div>
				</div>
                <div class="form-group row align-items-center has-success">
					<label for="legajo" class="col-form-label text-md-right col-md-3">
						<strong> Legajo </strong>
					</label>
					<div class="col-md-9 col-xl-7">
						<input type="text" id="legajo" name="legajo" value="{{ $user->legajo }}" class="form-control form-control-success" aria-required="true" aria-invalid="false">
					</div>
				</div>
                

			</div>

			<div class="card-footer text-center">
				<a class="btn btn-danger" href="{{ route('admin-panel.index') }}">
					<i class="fa fa-ban"></i> Cancelar</a>
				<button type="submit" class="btn btn-primary">
					<i class="fa fa-download"></i> Guardar

				</button>
			</div>
		</form>
	</div>
</div>

@endsection