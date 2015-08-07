@extends ('planear')

@section('content') 
 <div class="container" >

		<!-- model es como open, pero ya me va a cargar los campos con los datos del modelo
		 $events->idUsuario  es con loq busca -->
		{!!Form::model($event,['route'=>['event.update', $event->id],'method'=>'PUT'] )!!}
			@include('event.form.event')
		<div class="row">
  			<div class="col-md-1">
		{!!Form::submit('Actualizar',['class'=>'btn btn-primary']) !!}
		{!!Form::close()!!}
			</div>
			<div class="col-md-1">
		{!!Form::open(['route'=>['event.destroy', $event->id],'method'=>'DELETE'] )!!}
		{!!Form::submit('Eliminar',['class'=>'btn btn-danger']) !!}
		{!!Form::close()!!}
	</div>
<input type="button" value="Cancelar" class="btn btn-warning" onclick= "self.location.href = '../../event' "/>

		</div>
</div>
@stop