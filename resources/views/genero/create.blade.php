@extends('planear')

@section('content')
<div class="container">
	{!!Form::open()!!}
	<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token" >
		@include('genero.form.genero')
{!!link_to('#', $title='Registrar',$atributes = ['id' =>'registro','class' =>'btn btn-primary'], $secure = null)!!}

	{!!Form::close()!!}
</div>


<hr>

@endsection

@section('script')
    {!!Html::script('js/script.js')!!}
@endsection