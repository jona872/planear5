@extends('layouts.app')

@section('content')

<form action="{{ route('data.store') }}" method="POST">
    @csrf
    <input type="hidden" name="tool_id" class="form-control" value={{ $params['tool_id'] }}>

    <div class="row">

    @for ($i = 0; $i < $params['count']; $i++) 
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nombre del campo:</strong>
                <input type="text" name="data_question{{$i}}" class="form-control">
            </div>
        </div>
    @endfor


    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <a href="/tools" class="btn btn-danger">Cancelar </a>
        <button type="submit" class="btn btn-primary">Continuar</button>
    </div>

    </div>
</form>

@endsection

@section('footer-scripts')
@include('scripts.onlyNumber')
@endsection