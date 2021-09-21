@extends('layouts.app')

@section('content')

<table class="table">
    <thead>
        <th>Nombre Proyecto</th>
        <th>Ciudad</th>
        <th>Responsable</th>
        <th>Lat&Long</th>
        <th>Operaciones</th>
    </thead>
    @foreach ($projects as $u)
    <tbody>
        <td>{{$u->project_name }}</td>
        <td>{{$u->city_name}}</td>
        <td>{{$u->project_creator}}</td>
        <td>{{$u->project_latitud." lat y long ".$u->project_longitud }}</td>
        <td>
            <form action="{{ route('projects.destroy',$u->id) }}" method="POST">
                <a class="btn btn-warning" href="{{ route('projects.show',$u->id) }}">Detalles</a>
                <a class="btn btn-info" href="projects/{{$u->id}}/edit"  method="post">Editar</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Borrar</button>
            </form>
        </td>
    </tbody>
    @endforeach

</table>

<a href="projects/create" class="btn btn-primary">Crear Proyecto <span class="glyphicon glyphicon-plus"></span></a>




@endsection