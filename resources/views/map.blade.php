<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Locate the user</title>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.2/mapbox-gl-geocoder.min.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.2/mapbox-gl-geocoder.css" type="text/css">

    <script src='https://api.mapbox.com/mapbox-gl-js/v2.6.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.6.0/mapbox-gl.css' rel='stylesheet' />
    <style>
        #map {
            position: absolute;

        }
    </style>
</head>

<body>
    <div>
        <div id="map" style="width: 50%; height: 50%; margin-top: 8%;"></div>
        <div><label name="lat" id="lat">-</label> </div>
        <div><label name="lng" id="lng">-</label> </div>
    </div>
    <script>
        mapboxgl.accessToken = 'pk.eyJ1Ijoiam9uYXRhbmtpbiIsImEiOiJja3VkNGc5ZXcxNm5yMnFxNnl4aW1vbnFvIn0.xG6ZHnZc21DSsy5MEHZmFQ';
        const map = new mapboxgl.Map({
            container: 'map', // container ID
            style: 'mapbox://styles/mapbox/streets-v11', // style URL
            center: [-61.51051676003347, -30.727283408601465], // starting position
            zoom: 3 // starting zoom
        });

        const marker = new mapboxgl.Marker({
                draggable: true
            })
            .setLngLat([0, 0])
            .addTo(map);

        function onDragEnd() {
            const lngLat = marker.getLngLat();
            document.getElementById('lat').innerHTML = JSON.stringify(lngLat.lat);
            document.getElementById('lng').innerHTML = JSON.stringify(lngLat.lng);
        }
        marker.on('dragend', onDragEnd);

        map.on('click', (e) => {
            marker.setLngLat([e.lngLat.lng, e.lngLat.lat]).addTo(map);
            document.getElementById('lat').innerHTML = JSON.stringify(e.lngLat.lat);
            document.getElementById('lng').innerHTML = JSON.stringify(e.lngLat.lng);
        });

        const geocoder = new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            marker: false,
            mapboxgl: mapboxgl
        });
        map.addControl(geocoder);

    </script>

</body>

</html>