@extends('planear')

@section('content')


<p>Esto es el profile de 1 usuario logeado profile.index</p>

<div class="container">

@foreach ($profile as $u)
{{$u->id}}
$u->id
<div class="row">
  <div class="col-md-1">{!!Form::label('us_name','Name: ')!!}</div>
  <div class="col-md-1">{{$u->us_name}}</div>
 </div>
 <div class="row">
  <div class="col-md-1">{!!Form::label('us_user','UserName: ')!!}</div>
  <div class="col-md-1">{{$u->us_user}}</div>
 </div>
 <div class="row">
  <div class="col-md-1">{!!Form::label('us_mail','Mail: ')!!}</div>
  <div class="col-md-1">{{$u->us_mail}}</div>
 </div>
 <div class="row">
  <div class="col-md-1">{!!Form::label('us_adre','Direction: ')!!}</div>
  <div class="col-md-1">{{$u->us_adre}}</div>
 </div>
 <div class="row">
  <div class="col-md-1">{!!Form::label('us_tele','Phone: ')!!}</div>
  <div class="col-md-1">{{$u->us_tele}}</div>
 </div>
 <div class="row">
  <div class="col-md-1">{!!Form::label('photolink','Fotolink: ')!!}</div>
  <div class="col-md-1">{{$u->photolink}}</div>
 </div>

@endforeach

{!!link_to_route('profile.edit', $title = 'Editar', $parameters = Auth::user()->id, $attributes = ['class'=>'btn btn-primary'])!!}
{!!link_to_route('profile.edit', $title = 'Editar2', $parameters = $u->id, $attributes = ['class'=>'btn btn-primary'])!!}


<!--	
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
			
			ya me hace de una la indexacion del us con su id corresp, y eso se lo paso a usuario.editar 
		</td>
		</tbody>
		@endforeach

	</table> -->
</div>

</br>

@endsection
