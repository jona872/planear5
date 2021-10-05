@extends('layouts.app')
<style>
    #map {
        position: relative;
        width: 100%;
        margin: 0 auto;
    }
</style>

@section('content')

<div class="container-xl">
    <div class="card">
        <div class="card-header"><i class="fa fa-plus"></i> Detalle del Proyecto </div>

        <div class="card-body">
    
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
        </div>
    </div>
</div>
<div class="card" id="map"></div>
</div>


@section('footer')

<a class="btn btn-danger" href="{{ route('projects.index') }}">
    <i class="fa fa-arrow-left"></i> Volver</a>

@endsection




@endsection

@section('footer-scripts')


<!-- Import Mapbox GL JS  -->
<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v2.5.0/mapbox-gl.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v2.5.0/mapbox-gl.css' rel='stylesheet' />

<script type="text/javascript">
    console.log("Show proyect");
    var project = <?php echo json_encode($project); ?>;
    console.log(project);

    mapboxgl.accessToken = 'pk.eyJ1Ijoiam9uYXRhbmtpbiIsImEiOiJja3VkNGc5ZXcxNm5yMnFxNnl4aW1vbnFvIn0.xG6ZHnZc21DSsy5MEHZmFQ';

    const map = new mapboxgl.Map({
        container: 'map', // HTML container ID
        style: 'mapbox://styles/mapbox/streets-v11', // style URL
        center: [project['project_longitud'], project['project_latitud']], // starting position [lng, lat]
        zoom: 13 // starting zoom
    });
    const popup = new mapboxgl.Popup().setHTML(
        // "<h3>Proyecto</h3> <p>"+project['project_longitud']+"; "+project['project_longitud']+"</p>"
        "<h3>"+project['city_name']+"</h3> <p>"+project['project_longitud']+"; "+project['project_longitud']+"</p>"
    );

    map.on('load', () => {

        const marker = new mapboxgl.Marker()
            .setLngLat([project['project_longitud'], project['project_latitud']])
            .setPopup(popup)
            .addTo(map);

        map.addSource('single-point', {
            type: 'geojson',
            data: {
                type: 'FeatureCollection',
                features: []
            }
        });
        map.addLayer({
            id: 'point',
            source: 'single-point',
            type: 'circle',
            paint: {
                'circle-radius': 10,
                'circle-color': '#448ee4'
            }
        });

    });
</script>

@endsection