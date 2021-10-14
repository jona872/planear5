@extends('layouts.app')

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="container-xl">
    <form action="{{ route('plots.multiplotProcess') }}" method="POST" class="form-horizontal form-create">
        @csrf
        @method('POST')
        <div class="card">
            <div class="card-header"><i class="fa fa-plus"></i> Grafico 1 </div>

            <div class="card-body">
                <div class="form-group row align-items-center">
                    <label for="" class="col-form-label text-md-right col-md-3"><strong>Proyecto</strong></label>
                    <div class="col-md-9 col-xl-7">
                        <select id="pList" name="pList" class="form-control form-select pList">
                            <option value=""> Seleccione Proyecto </option>
                            @foreach($projects ?? '' as $project)
                            <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                            <input hidden name="pName" value="{{ $project->project_name }}" />
                            @endforeach
                        </select>

                    </div>
                </div>

                <div class="form-group row align-items-center">
                    <label for="" class="col-form-label text-md-right col-md-3"><strong>Herramienta</strong></label>
                    <div class="col-md-9 col-xl-7">
                        <select id="tList" name="tList" class="form-control form-select">
                            <option value=""> Seleccione Herramienta </option>
                        </select>
                    </div>
                </div>

            </div>
        </div>

        <div class="card">
            <div class="card-header"><i class="fa fa-plus"></i> Grafico 2 </div>

            <div class="card-body">
                <div class="form-group row align-items-center">
                    <label for="" class="col-form-label text-md-right col-md-3"><strong>Proyecto</strong></label>
                    <div class="col-md-9 col-xl-7">
                        <select id="pList2" name="pList2" class="form-control form-select">
                            <option value=""> Seleccione Proyecto </option>
                            @foreach($projects ?? '' as $project)
                            <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                            <input hidden name="pName2" value="{{ $project->project_name }}" />
                            @endforeach
                        </select>

                    </div>
                </div>

                <div class="form-group row align-items-center">
                    <label for="" class="col-form-label text-md-right col-md-3"><strong>Herramienta</strong></label>
                    <div class="col-md-9 col-xl-7">
                        <select id="tList2" name="tList2" class="form-control form-select">
                            <option value=""> Seleccione Herramienta </option>
                        </select>

                    </div>
                </div>
            </div>



        </div>

        <div class="card">
            <div class="card-header"><i class="fa fa-plus"></i> Tipo de Grafico </div>

            <div class="card-body">

                <div class="form-group row align-items-center">
                    <label for="" class="col-form-label text-md-right col-md-3"><strong>Tipo de Grafico</strong></label>
                    <div class="col-md-6 col-xl-6">
                        <select name="plot_id" class="form-control form-select">
                            <option value="5"> Linea Comparativa </option>
                            <option value="6"> Barra Comparativa </option>
                        </select>
                    </div>
                </div>


                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"> <i class="fa fa-arrow-right "></i> Continuar </button>
                </div>

            </div>
        </div>




    </form>
</div>





@endsection

@push('react-js-include')
<!-- //react components -->

@section('footer-scripts')
@include('scripts.getProjectTools2')
@endsection