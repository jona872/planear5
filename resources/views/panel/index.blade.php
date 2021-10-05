@extends('layouts.app')

@section('content')
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

            <!-- TITLE -->
            <div class="card-body">
                <!-- SEARCH -->
                <form action="{{ route('projects.search') }}" method="POST" class="form-horizontal form-create">
                    @csrf
                    <div class="row justify-content-md-between">
                        <div class="col col-lg-7 col-xl-5 form-group">
                            <div class="input-group"><input name="search" placeholder="Search" class="form-control">
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp; Search</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- SEARCH -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <th>Nombre</th>
                            <th>Legajo</th>
                            <th>Admin</th>
                            <th>Email</th>
                            <th>Operaciones</th>
                        </thead>

                        @if (count($users) > 0)
                        @foreach ($users as $u)
                        <tbody>
                            <td>{{$u->name }}</td>
                            <td>{{$u->legajo}}</td>
                            <td><label class="switch switch-3d switch-success">
                                    <input type="checkbox" class="switch-input" disabled  @if ($u->admin) checked @endif >
                                    <span class="switch-slider"></span>
                                </label>
                            </td>
                            <td>{{$u->email}}</td>
                            <td>
                                <div class="row no-gutters">
                                    <div class="col-auto" style="margin: 0 2%">
                                        <a href="projects/{{$u->id}}/edit" title="Edit" role="button" class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>
                                    <form class="col" action="{{ route('projects.destroy',$u->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Borrar" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tbody>
                        @endforeach
                        @else
                        <tbody>
                            <tr>
                                <td align="center" colspan="5">No se encontraron resultados </td>
                            </tr>
                        </tbody>
                        @endif


                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection