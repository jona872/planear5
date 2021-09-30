@extends('layouts.app')

@section('content')
<?php
session()->forget('toolData');
session()->forget('tid');
session()->forget('pid');
?>

@if (session()->has('success'))
<div class="modals alert alert-success">
    @if(is_array(session('success')))
    <ul>
        @foreach (session('success') as $message)
        <li>{{ $message }}</li>
        @endforeach
    </ul>
    @else
    {{ session('success') }}
    @endif
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row">
    <div class="col">
        <div class="card">
            <!-- TITLE -->
            <div class="card-header"><i class="fa fa-align-justify"></i> Confirmar datos a exportar </div>
            <!-- TITLE -->
            <div class="card-body">
                <!-- SEARCH -->
                <!-- SEARCH -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <th>Proyecto</th>
                            <th>Herramienta</th>
                            <th>Fecha</th>
                            <th>Responsable</th>
                            <th>Latitud;Longitud</th>
                        </thead>
                        @if (isset($relevamientos))
                        @foreach ($relevamientos as $u)
                        <tbody>
                            <td>{{$u->project_name }}</td>
                            <td>{{$u->tool_name }}</td>
                            <td>{{\Carbon\Carbon::parse($u->created_at)->format('d-m-Y')}}</td>
                            <td>{{$u->relevamiento_creator}}</td>
                            <td>{{$u->name}}</td>
                        </tbody>
                        @endforeach
                        @endif



                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('footer')
<form action="{{ route('relevamientos.export-confirm',['relevamientos' => $relevamientos]) }}" method="POST" class="form-horizontal form-create">
    @csrf
    @method('POST')
    <a href="/relevamientos" title="Cancelar" role="button" class="btn btn-sm btn-danger">
        <i class="fa fa-ban"></i> &nbsp; Cancelar
    </a>
    <button type="submit" class="btn btn-primary btn-sm"> <i class="fa fa-share-square-o"></i> &nbsp; Confirmar </button>
</form>
@endsection