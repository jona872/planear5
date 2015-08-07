@extends('planear')

@section('content')
{{-- @include('stock.modal') --}}

<div class="container">
	<table class="table">
		<thead>
			<th>Id</th>
			<th>Genero</th>
			<th>Operacion</th>
		</thead>
		<tbody id="datos">
		</tbody>
	</table>

</div>

@endsection


@section('script')
	{!!Html::script('js/script2.js')!!}
@endsection

{{-- 
@section('script')
    {!!Html::script('js/script2.js')!!}
@endsection --}}