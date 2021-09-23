@extends('layouts.app')

@section('content')


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-top">
            <h2>Detalle del Proyecto</h2>
        </div>

    </div>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nombre Proyecto:</strong>
            {{ $project->project_name }}
        </div>
    </div>


    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Ciudad:</strong>
            {{ $project->city_name }}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Creador:</strong>
            {{ $project->project_creator }}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>latitud:</strong>

            {{ $project->project_latitud }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>longitud:</strong>

            {{ $project->project_longitud }}
        </div>
    </div>


</div>

<a class="btn btn-danger" href="{{ route('projects.index') }}">
    <i class="fa fa-arrow-left"></i> Volver</a>

@endsection