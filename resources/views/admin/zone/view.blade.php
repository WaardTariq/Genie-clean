@extends('layouts.master')
@section('content')

<style>
    .map-warper {
        height: 350px;
    }

</style>

<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Zone View</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">View Zones</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            {{-- <div class="btn-group">
                <a href="{{ route('zoneCreate') }}" type="button" class="btn btn-primary">Create</a>
        </div> --}}
    </div>
    </div>

    <h6 class="mb-0 text-uppercase">View Zones</h6>
    <hr />

    <div class="container-fluid page__container" style="margin-top: 50px;">
        <div class="card card-A">
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-md-5 d-flex justify-content-center m-auto">
                        <div class="zone-setup-instructions">
                            <h2>{{$zone->name}}</h2>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-7 zone-setup">
                        <div class="pl-xl-5 pl-xxl-0">
                            <div class="map-warper overflow-hidden rounded">
                                <div id="map-canvas" class="h-100 m-0 p-0"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function initMap() {
        const pointString = "{{ $zone->center }}";
        const coords = pointString.match(/POINT\((-?\d+\.\d+) (-?\d+\.\d+)\)/);
        const lng = parseFloat(coords[1]);
        const lat = parseFloat(coords[2]);

        let myLatlng = new google.maps.LatLng(lat, lng);
        let myOptions = {
            zoom: 4
            , center: myLatlng
            , mapTypeId: google.maps.MapTypeId.ROADMAP
            , zoomControl: true
            , mapTypeControl: false
            , streetViewControl: false
            , fullscreenControl: true
        };

        // Initialize the map using the correct ID
        map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);

        // Initialize the marker
        marker = new google.maps.Marker({
            position: myLatlng
            , map: map
            , title: "Selected Location"
            , draggable: false
        , });

        // If polygon already exists from backend data, draw it on the map
        const polygonCoordinates = {!!json_encode($area['coordinates'])!!};
        if (polygonCoordinates) {
            const polygonPath = polygonCoordinates.map(coord => ({
                lat: coord[1]
                , lng: coord[0]
            }));

            lastpolygon = new google.maps.Polygon({
                paths: polygonPath
                , strokeColor: "#FF0000"
                , strokeOpacity: 0.8
                , strokeWeight: 2
                , fillColor: "#004dff"
                , fillOpacity: 0.35
                , editable: false
                , map: map
            });

            map.fitBounds(getPolygonBounds(lastpolygon));
        }
    }

    // Load the map when the window loads
    window.onload = function() {
        initMap();
    };

    // Function to fit the map to the bounds of the polygon
    function getPolygonBounds(polygon) {
        const bounds = new google.maps.LatLngBounds();
        polygon.getPath().forEach(function(element) {
            bounds.extend(element);
        });
        return bounds;
    }

</script>
@endsection
