@extends('planear')

@section('content')

{{-- //me llega profile --}}
<div class="container">
<H1><p align="center">Perfil de usuario</p></H1>

{!!Form::open()!!}
	@foreach($profile as $u)
	<div class="form-group" >
				{!!Form::label('us_name','Nombre: ')!!}<em>   {{Auth::user()->us_name }}</em>
{{-- 				{!!Form::label('email',Auth::user()->us_name)!!} --}}
	</div>
	<div class="form-group" >
				{!!Form::label('us_user','Nombre de Usuario: ')!!} <em>   {{Auth::user()->us_user }}</em>
{{-- 				{!!Form::label('email', Auth::user()->us_user)!!}
				{!!Form::text('email', 'example@gmail.com')!!} --}}
	</div>

	<div class="form-group" >
				{!!Form::label('us_mail','Mail: ')!!}
				<em>{{Auth::user()->us_mail }}</em>

	</div>
	<div class="form-group" >
				{!!Form::label('us_adre','Direccion: ')!!}<em>   {{Auth::user()->us_adre }}</em>
{{-- 				{!!Form::label('email', $u->us_user)!!}
				{!!Form::text('us_adre',Auth::user()->us_adre,['class'=>'form-control'])!!} --}}
	</div>
	<div class="form-group" >
				{!!Form::label('us_tele','Telefono: ')!!}<em>   {{Auth::user()->us_tele }}</em>
{{-- 				{!!Form::label('email', $u->us_user)!!}
				{!!Form::text('us_tele',Auth::user()->us_tele,['class'=>'form-control'])!!} --}}
	</div>
	<div class="form-group" >
				{!!Form::label('photolink','Fotolink: ')!!}<em>   {{Auth::user()->photolink }}</em>
{{-- 				{!!Form::label('email', $u->us_user)!!}
				{!!Form::text('photolink',Auth::user()->photolink,['class'=>'form-control'])!!} --}}

	</div>

	@endforeach

{!!link_to_route('profile.edit', $title = 'Editar', $parameters = Auth::user()->id , $attributes = ['class'=>'btn btn-primary'])!!}
</div>

{!!Html::linkRoute('profile.edit','Edit',array(Auth::user()->id))!!}

{!!Form::close()!!}
@endsection

