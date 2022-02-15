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
		<form action="{{ route('relevamientos.poscreate') }}" method="POST" class="form-horizontal form-create">
			@csrf
			<input type="hidden" id="relevamiento_latitud" name="relevamiento_latitud" value="">
			<input type="hidden" id="relevamiento_longitud" name="relevamiento_longitud" value="">
			
			<div class="card-header"><i class="fa fa-plus"></i> Agregar Relevamiento </div>

			<div class="card-body">

				<div class="form-group row align-items-center">
					<label for="" class="col-form-label text-md-right col-md-3"><strong>Proyecto</strong></label>
					<div class="col-md-9 col-xl-7">
						<select name="project_id" class="form-control form-select">
							<option value=""> Seleccione Proyecto </option>
							@foreach($projects ?? '' as $project)
							<option value="{{ $project->id }}">{{ $project->project_name }}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="form-group row align-items-center">
					<label for="" class="col-form-label text-md-right col-md-3"><strong>Herramienta</strong></label>
					<div class="col-md-9 col-xl-7">
						<select name="tool_id" class="form-control form-select">
							<option value=""> Seleccione Herramienta </option>
							@foreach($tools ?? '' as $tool)
							<option value="{{ $tool->id }}">{{ $tool->tool_name }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div id="map" style="height: 25vw;"> </div>
			</div>

			<div class="card-footer">
				<a class="btn btn-danger" href="{{ route('relevamientos.index') }}">
					<i class="fa fa-ban"></i> Cancelar</a>
				<button type="submit" class="btn btn-primary">
					<i class="fa fa-arrow-right"></i> Continuar
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
		mapboxgl.accessToken = 'pk.eyJ1Ijoiam9uYXRhbmtpbiIsImEiOiJja3VkNGc5ZXcxNm5yMnFxNnl4aW1vbnFvIn0.xG6ZHnZc21DSsy5MEHZmFQ';
		const map = new mapboxgl.Map({
			container: 'map', // container ID
			style: 'mapbox://styles/mapbox/streets-v11', // style URL
			center: [-66.63303284626454, -38.48190604350612], // starting position
			zoom: 4 // starting zoom
		});

		const marker = new mapboxgl.Marker({
				draggable: true
			})
			.setLngLat([0, 0])
			.addTo(map);

		function onDragEnd() {
			const lngLat = marker.getLngLat();			
			document.getElementById("relevamiento_latitud").value = JSON.stringify(lngLat.lat);
			document.getElementById('relevamiento_longitud').value = JSON.stringify(lngLat.lng);
		}
		marker.on('dragend', onDragEnd);

		map.on('click', (e) => {
			marker.setLngLat([e.lngLat.lng, e.lngLat.lat]).addTo(map);			
			document.getElementById("relevamiento_latitud").value = JSON.stringify(e.lngLat.lat);
			document.getElementById('relevamiento_longitud').value = JSON.stringify(e.lngLat.lng);
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