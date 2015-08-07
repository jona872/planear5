@extends('planear')

@section('content')

  	<div class="container" >
		{!!Form::open(['route'=>'event.store','method'=>'POST'])!!}
		{{-- {!!Form::open()!!} --}}
			@include('event.form.event')
		{!!Form::submit('Registrar',['class'=>'btn btn-primary']) !!}

		<input type="button" value="Cancelar" class="btn btn-danger" onclick= "self.location.href = '../event' "/>

		{!!Form::close()!!}
	</div>

@endsection