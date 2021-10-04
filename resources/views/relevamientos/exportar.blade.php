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
		@foreach ($grupos as $grupo)
		<form action="{{ route('relevamientos.export-confirm') }}" method="POST" class="form-horizontal form-create">
			{{ csrf_field() }}

			<input type="hidden" name="exportData" value="{{serialize($grupo)}}">

			<div class="card">
				<!-- TITLE -->
				<div class="card-header"><i class="fa fa-align-justify"></i> {{$grupo['project_name']}} -- {{$grupo['tool_name']}} </div>

				<div class="card-body">
					<div class="table-responsive ">
						<table class="table table-hover">
							<thead>
								@for ($i = 0; $i < $grupo['colCount']; $i++) <th name="este">{{ $grupo['preguntas'][$i] }}</th>
									@endfor
							</thead>
							@foreach ($grupo['respuestas'] as $r)
							<tbody>
								@for ($i = 0; $i < count($r); $i++) <td>{{ $r[$i] }}</td>
									@endfor
							</tbody>
							@endforeach
						</table>
					</div>

					<a href="/relevamientos" title="Cancelar" role="button" class="btn btn-sm btn-danger">
						<i class="fa fa-ban"></i> &nbsp; Cancelar
					</a>
					<button type="submit" class="btn btn-primary btn-sm"> <i class="fa fa-share-square-o"></i> &nbsp; Exportar </button>
		</form>
	</div>
</div>

@endforeach

</div>
</div>


@endsection