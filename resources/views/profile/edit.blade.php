@extends ('planear')

@section('content') 
<div class="container" >

		<!-- model es como open, pero ya me va a cargar los campos con los datos del modelo
		 $profiles->idUsuario  es con loq busca -->
	{!!Form::model($profile,['route'=>['profile.update', Auth::user()->id],'method'=>'PUT'] )!!}

	<div class="form-group" >
				{!!Form::label('us_name','Nombre: ')!!}
				{!!Form::text('us_name', Auth::user()->us_name,['class'=>'form-control'])!!}
	</div>
	<div class="form-group" >
				{!!Form::label('us_user','Nombre de Usuario: ')!!}
				{!!Form::text('us_user', Auth::user()->us_user,['class'=>'form-control'])!!}
	</div>
	<div class="form-group" >
				{!!Form::label('us_mail','Mail: ')!!}
				{!!Form::text('us_mail',Auth::user()->us_mail,['class'=>'form-control'])!!}
	</div>
	<div class="form-group" >
				{!!Form::label('us_adre','Direccion: ')!!}
				{!!Form::text('us_adre',Auth::user()->us_adre,['class'=>'form-control'])!!}
	</div>
	<div class="form-group" >
				{!!Form::label('us_tele','Telefono: ')!!}
				{!!Form::text('us_tele',Auth::user()->us_tele,['class'=>'form-control'])!!}
	</div>
	<div class="form-group" >
				{!!Form::label('photolink','Fotolink: ')!!}
				{!!Form::text('photolink',Auth::user()->photolink,['class'=>'form-control'])!!}
	</div>
	<div class="form-group">
	    {!! Form::label('Product Image') !!}
	    {!! Form::file('image', null) !!}
	</div>

		<div class="row">
			<div class="col-md-2">
			{!!Form::submit('Actualizar',['class'=>'btn btn-primary']) !!}
			{!!Form::close()!!}
		</div>
		<div class="col-md-2">
			{!!Form::open(['route'=>['profile.destroy', Auth::user()->id],'method'=>'DELETE'] )!!}
			{!!Form::submit('Eliminar',['class'=>'btn btn-danger']) !!}
			{!!Form::close()!!}
		</div>


		<input type="button" value="Cancelar" class="btn btn-warning" onclick= "self.location.href = '../../profile' "/>

		</div>
</div>
@stop