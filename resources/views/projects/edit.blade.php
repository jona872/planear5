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
	<div class="card">
		<form action="{{ route('projects.update',$projects[0]->id) }}" method="POST" class="form-horizontal form-create">
			@csrf
			@method('PUT')
			<input name="id" type="hidden" value="{{ $projects[0]->id }}">

			<div class="card-header"><i class="fa fa-plus"></i> Editar Proyecto </div>

			<div class="card-body">

				<div class="form-group row align-items-center has-success">
					<label for="project_name" class="col-form-label text-md-right col-md-3">
						<strong> Nombre Proyecto </strong>
					</label>
					<div class="col-md-9 col-xl-7">
						<input type="text" id="project_name" name="project_name" value="{{ $projects[0]->project_name }}" class="form-control form-control-success" aria-required="true" aria-invalid="false">
					</div>
				</div>

				<div class="form-group row align-items-center">
					<label for="" class="col-form-label text-md-right col-md-3"><strong>Ciudad</strong></label>
					<div class="col-md-9 col-xl-7">
						<select name="city_id" class="form-control form-select">
							@foreach($cities ?? '' as $city)
							<option value="{{ $city->id }}">{{ $city->city_name }}</option>
							@endforeach
						</select>
					</div>
				</div>



				<div class="form-group row align-items-center has-success">
					<label for="project_creator" class="col-form-label text-md-right col-md-3">
						<strong> Creador </strong>
					</label>
					<div class="col-md-9 col-xl-7">
						<input type="text" id="project_creator" name="project_creator" value="{{ $projects[0]->project_creator  }}" readonly class="form-control form-control-success" aria-required="false" aria-invalid="false">
					</div>
				</div>

				<div class="form-group row align-items-center has-success">
					<label for="project_latitud" class="col-form-label text-md-right col-md-3"><strong>Latitud</strong></label>
					<div class="col-md-9 col-xl-7">
						<input type="text" id="project_latitud" name="project_latitud" value="{{ $projects[0]->project_latitud }}" class="form-control form-control-success" aria-required="false" aria-invalid="false">
					</div>
				</div>

				<div class="form-group row align-items-center has-success">
					<label for="project_longitud" class="col-form-label text-md-right col-md-3"><strong>Longitud</strong></label>
					<div class="col-md-9 col-xl-7">
						<input type="text" id="project_longitud" name="project_longitud" value="{{ $projects[0]->project_longitud }}" class="form-control form-control-success" aria-required="false" aria-invalid="false">
					</div>
				</div>

				<!-- <div id="map" style="height: 20vw;"> </div>	 -->
			</div>
			<div id="map" style="height: 20vw;"> </div>

			<div class="card-footer text-center">
				<a class="btn btn-danger" href="{{ route('projects.index') }}">
					<i class="fa fa-ban"></i> Cancelar</a>
				<button type="submit" class="btn btn-primary">
					<i class="fa fa-download"></i> Guardar

				</button>
			</div>

		</form>
	</div>
</div>

@endsection


@section('footer-scripts')


<!-- Import Mapbox GL JS  -->
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.2/mapbox-gl-geocoder.min.js"></script>
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.2/mapbox-gl-geocoder.css" type="text/css">

<script src='https://api.mapbox.com/mapbox-gl-js/v2.6.0/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.6.0/mapbox-gl.css' rel='stylesheet' />


<script type="text/javascript">
	$(document).ready(function() {

		var project = <?php echo json_encode($projects[0]); ?>;
		mapboxgl.accessToken = 'pk.eyJ1Ijoiam9uYXRhbmtpbiIsImEiOiJja3VkNGc5ZXcxNm5yMnFxNnl4aW1vbnFvIn0.xG6ZHnZc21DSsy5MEHZmFQ';
		const map = new mapboxgl.Map({
			container: 'map', // container ID
			style: 'mapbox://styles/mapbox/streets-v11', // style URL
			center: [project['project_longitud'], project['project_latitud']], // starting position [lng, lat]
			zoom: 13 // starting zoom	
		});

		const marker = new mapboxgl.Marker({
				draggable: true
			})
			.setLngLat([project['project_longitud'], project['project_latitud']])
			.addTo(map);

		function onDragEnd() {
			const lngLat = marker.getLngLat();
			document.getElementById("project_latitud").value = JSON.stringify(lngLat.lat);
			document.getElementById('project_longitud').value = JSON.stringify(lngLat.lng);
		}
		marker.on('dragend', onDragEnd);

		map.on('click', (e) => {
			marker.setLngLat([e.lngLat.lng, e.lngLat.lat]).addTo(map);
			document.getElementById("project_latitud").value = JSON.stringify(e.lngLat.lat);
			document.getElementById('project_longitud').value = JSON.stringify(e.lngLat.lng);
		});

		const geocoder = new MapboxGeocoder({
			accessToken: mapboxgl.accessToken,
			marker: false,
			mapboxgl: mapboxgl
		});
		map.addControl(geocoder);
	});
</script>

@endsection