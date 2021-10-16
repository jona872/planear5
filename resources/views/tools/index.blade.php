@extends('layouts.app')

@section('content')


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

<div class="container">
	<div class="row">

		@foreach ($tools as $u)
		<div class="col">
			<div class="card" style="width: 18rem;">
				<div class="card-body">

					<h5 class="card-header text-center">{{ $u->tool_name}}</h5>

					<div class="card-body text-center">

						<i class="text-center bi-tools" role="img" aria-label="tools" style="font-size: 9rem;"></i>

						<form action="{{ route('tools.destroy',$u->id) }}" method="POST" class="row justify-content-between">
							<a style="margin-bottom: 5px;" class="btn btn-primary btn-sm col-md-5" href="tools/{{$u->id}}/edit" method="post">Editar</a>
							@csrf
							@method('DELETE')
							<button style="margin-bottom: 5px;" type="submit" class="btn btn-danger btn-sm col-md-5">Borrar</button>
						</form>
					</div>


					<footer class="blockquote-footer">Creador: <cite title="Source Title"> {{$u->name}} </cite></footer>

				</div> <!--  body -->
			</div> <!--  card -->
		</div> <!--  col -->
		@endforeach

	</div>
</div>

@section('footer')
<a href="tools/create" class="btn btn-sm btn-dark"><i class="bi bi-plus-lg"> </i> Agregar Herramienta </a>
<a href="data" class="btn btn-sm btn-dark"><i class="bi bi-plus-lg"> </i> Agregar Campos </a>
@endsection

@endsection