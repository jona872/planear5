@extends('planear')

@section('content')


Esto es el profile de 1 usuario logeado
<div class="container">
<p>{{ Auth::user()->us_name }} </p>
</div>
<div class="container">
	
	<table class="table">
		<thead>
			<th width="100px">id</th>
			<th width="100px">Name</th>
			<th width="100px">User Name</th>
			<th width="100px">Email</th>
			<th width="100px">Direccion</th>
			<th width="100px">Telefono</th>
			<th width="100px">Pic</th>
			<th width="100px">Operaciones</th>
		</thead>
		@foreach ($profile as $u)
		<tbody>
			<td>{{$u->id}}</td>
			<td>{{$u->us_name}}</td>
			<td>{{$u->us_user}}</td>
			<td>{{$u->us_mail}}</td>
			<td>{{$u->us_adre}}</td>
			<td>{{$u->us_tele}}</td>
			<td>{{$u->photolink}}</td>
			<td>
			{!!link_to_route('profile.index', $title = 'Editar', $parameters = $u->id, $attributes = ['class'=>'btn btn-primary'])!!}
			
			<!-- ya me hace de una la indexacion del us con su id corresp, y eso se lo paso a usuario.editar -->
		</td>
		</tbody>
		@endforeach

	</table>
</div>

{{-- 
<div class="container" >
	<p>{{ Auth::user()->id }} </p>
	<p>{{ Auth::user()->name }} </p>
	<p>{{ Auth::user()->username }} </p>
</div>
 --}}


<hr>
</br>

@endsection
