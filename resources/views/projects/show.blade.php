@extends('layouts.app')

@section('content')

<div class="container-xl">
    <div class="card">
        <div class="card-header"><i class="fa fa-plus"></i> Editar Herramienta </div>

        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-top">
                        <h2>Detalle del Proyecto</h2>
                    </div>

                </div>
            </div>



            <div class="form-group row align-items-center has-success">
                <label for="creator" class="col-form-label text-md-right col-md-3">
                    <strong> Nombre del Proyecto </strong>
                </label>
                <div class="col-md-9 col-xl-7">
                    <input type="text" value="{{ $project->project_name }}" class="form-control form-control-success" readonly>
                </div>
            </div>

            <div class="form-group row align-items-center has-success">
                <label for="creator" class="col-form-label text-md-right col-md-3">
                    <strong> Ciudad </strong>
                </label>
                <div class="col-md-9 col-xl-7">
                    <input type="text" value="{{ $project->city_name }}" class="form-control form-control-success" readonly>
                </div>
            </div>

            <div class="form-group row align-items-center has-success">
                <label for="creator" class="col-form-label text-md-right col-md-3">
                    <strong> Creador del proyecto </strong>
                </label>
                <div class="col-md-9 col-xl-7">
                    <input type="text" value="{{ $project->project_creator }}" class="form-control form-control-success" readonly>
                </div>
            </div>

            <div class="form-group row align-items-center has-success">
                <label for="creator" class="col-form-label text-md-right col-md-3">
                    <strong> Latitud </strong>
                </label>
                <div class="col-md-9 col-xl-7">
                    <input type="text" value="{{ $project->project_latitud }}" class="form-control form-control-success" readonly>
                </div>
            </div>

            <div class="form-group row align-items-center has-success">
                <label for="creator" class="col-form-label text-md-right col-md-3">
                    <strong> Longitud </strong>
                </label>
                <div class="col-md-9 col-xl-7">
                    <input type="text" value="{{ $project->project_longitud }}" class="form-control form-control-success" readonly>
                </div>
            </div>


            <a class="btn btn-danger" href="{{ route('projects.index') }}">
                <i class="fa fa-arrow-left"></i> Volver</a>
        </div>
    </div>
</div>
</div>
<div id="map" style="margin: 0 auto;"></div>




@endsection

@section('footer-scripts')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.standalone.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJObIfdbAFgUq0urtE1HdcTnHWIf8zULw&callback=initMap&v=weekly" async></script>


<script type="text/javascript">
    console.log("Show proyect");
    var project = <?php echo json_encode($project); ?>;
    console.log(project);
    function initMap() {
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 15,
            center: {
                lat: -31.7213372,
                lng: -60.498494
            },
        });
    }
</script>

@endsection