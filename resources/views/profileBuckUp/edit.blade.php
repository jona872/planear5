@extends('planear')

@section('content')


<p>Esto es el profile de 1 usuario logeado   profile.edit</p>

 <div class="container" >

		<!-- model es como open, pero ya me va a cargar los campos con los datos del modelo
		 $profiles->idUsuario  es con loq busca -->
		{!!Form::model($profile,['route'=>['profile.update', Auth::user()->id],'method'=>'PUT'] )!!}
		<div class="row">

<div class="container">

@foreach ($profile as $u)


@endforeach


</br>
  		<div class="col-md-2">
		{!!Form::submit('Actualizar',['class'=>'btn btn-primary']) !!}
		{!!Form::close()!!}
			</div>
			<div class="col-md-2">
		
		{!!Form::submit('Eliminar',['class'=>'btn btn-danger']) !!}
		{!!Form::close()!!}
	</div>
<input type="button" value="Cancelar" class="btn btn-warning" onclick= "self.location.href = '../../profile' "/>

		</div>
</div>
@endsection
