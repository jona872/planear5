@extends ('planear')

@section('content') 

<div class="container">
<!-- puedo poner esto y incluuir el template, pero se puede editar, si no enuentro como 
abrirlo sin edicion lo cargo a pata a los campos
{!!Form::model($event,['route'=>['event.show', $event->id],'method'=>'PUT'] )!!}
-->

<div class="form-group" >
	{!!Form::label('event_name','Name: ')!!}
	<div><em>{{$event->event_name}}</em></div>
</div>
<div class="form-group" >
	{!!Form::label('event_desc','Description: ')!!}	
	<div><em>{{$event->event_desc}}</em></div>
</div>
<div class="form-group" >
	{!!Form::label('event_date','event_date: ')!!}	
	<div><em>{{$event->event_date}}</em></div>
</div>
<div class="form-group" >
	{!!Form::label('event_type','type: ')!!}	
	<div><em>{{$event->event_type}}</em></div>
</div>
<div class="form-group" >
	{!!Form::label('event_loca','event_loca: ')!!}	
	<div><em>{{$event->event_loca}}</em></div>
</div>
<div class="form-group" >
	{!!Form::label('event_priv','event_priv: ')!!}
	<div><em>{{$event->event_priv}}</em></div>
</div>

</div>

@stop