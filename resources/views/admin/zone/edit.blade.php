@extends('layouts.master')
@section('content')

<style>
    .map-warper {
        height: 350px;
    }

    .zone-setup-item {
        display: flex;
        gap: 15PX;
    }

</style>

<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Zone Management</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Update Zones</li>
                </ol>
            </nav>
        </div>
    </div>

    <h6 class="mb-0 text-uppercase" style="margin-top: 50px;">Update Zones</h6>
    <hr />

    <div class="container-fluid page__container">

        <div class="card card-A">
            <div class="card-body">
                <form action="javascript:" method="post" id="zone_form" class="shadow--card">
                    @csrf
                    <div class="row justify-content-between">
                        <div class="col-md-5">
                            <div class="zone-setup-instructions">
                                <div class="zone-setup-top">
                                    <h6 class="subtitle">Instructions</h6>
                                    <p>
                                        Create & connect dots in a specific area on the map to add a new business zone.
                                    </p>
                                </div>
                                <div class="zone-setup-item">
                                    <div class="zone-setup-icon">
                                        <i class="fa-solid fa-pencil"></i>
                                    </div>
                                    <div class="info">
                                        Use this ‘Hand Tool’ to find your target zone.
                                    </div>
                                </div>
                                <div class="zone-setup-item">
                                    <div class="zone-setup-icon">
                                        <i class="fa-solid fa-border-none"></i>
                                    </div>
                                    <div class="info">

                                        Use this ‘Shape Tool’ to point out the areas and connect the dots. A minimum of
                                        3 points/dots is required.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-7 zone-setup">
                            <div class="pl-xl-5 pl-xxl-0">
                                <div class="tab-content">
                                    <div class="form-group mb-3 lang_form" id="default-form">
                                        <label class="input-label" for="exampleFormControlInput1">Business Zone
                                            name</label>
                                        <input type="text" name="name" class="form-control" value="{{$zone->name}}" placeholder="Type new zone name here" maxlength="191" id="default-form-input" required>

                                        <input type="hidden" name="zoneId" id="zoneId" value="{{$zone->id}}">
                                    </div>
                                </div>


                                <div class="form-group mb-3 d-none">
                                    <label class="input-label" for="coordinates">Coordinates<span class="form-label-secondary" data-toggle="tooltip" data-placement="right" data-original-title="draw your zone on the map">draw your zone on the
                                    </label>
                                    <textarea type="text" name="coordinates" id="coordinates" class="form-control">
                                        @php
                                            $formattedCoords = [];
                                        @endphp
                                        @foreach($area['coordinates'] as $coords)
                                         @php
                                        $formattedCoords[] = ['lat' => $coords[1], 'lng' => $coords[0]];
                                        @endphp
                                        @endforeach
                                        {{ json_encode($formattedCoords) }}
                                    </textarea>
                                </div>

                                <div class="map-warper overflow-hidden rounded">
                                    <input id="pac-input" class="controls rounded initial-8" title="search your location here" type="text" placeholder="search here" />
                                    <div id="map-canvas" class="h-100 m-0 p-0"></div>
                                </div>
                                <div class="d-flex mt-3 justify-content-end">
                                    <button id="reset_btn" type="button" class="btn btn-warning mr-2">reset</button>
                                    <button type="submit" class="btn btn-success ms-3">submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>

<script>
    let map, drawingManager, lastpolygon = null;
    let marker;

    function initMap() {
        const pointString = "{{ $zone->center }}"; // Get the center point from the server
        const coords = pointString.match(/POINT\((-?\d+\.\d+) (-?\d+\.\d+)\)/);
        const lng = parseFloat(coords[1]); // Longitude
        const lat = parseFloat(coords[2]); // Latitude

        let myLatlng = new google.maps.LatLng(lat, lng);
        let myOptions = {
            zoom: 4
            , center: myLatlng
            , mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        // Initialize the map using the correct ID
        map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);

        // Initialize the marker
        marker = new google.maps.Marker({
            position: myLatlng
            , map: map
            , title: "Selected Location"
            , draggable: true
        , });

        // Initialize Autocomplete
        const searchBox = document.getElementById("pac-input");
        const autocomplete = new google.maps.places.Autocomplete(searchBox);
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(searchBox);

        autocomplete.addListener("place_changed", () => {
            const place = autocomplete.getPlace();
            if (place.geometry) {
                const lat = place.geometry.location.lat();
                const lng = place.geometry.location.lng();

                marker.setPosition({
                    lat
                    , lng
                });
                map.setCenter({
                    lat
                    , lng
                });
                map.setZoom(15);
            }
        });

        // Setup the drawing manager for drawing new polygons
        drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: google.maps.drawing.OverlayType.POLYGON
            , drawingControl: true
            , drawingControlOptions: {
                position: google.maps.ControlPosition.TOP_CENTER
                , drawingModes: [google.maps.drawing.OverlayType.POLYGON]
            }
            , polygonOptions: {
                editable: true
            }
        });
        drawingManager.setMap(map);

        // If polygon already exists from backend data, draw it on the map
        const polygonCoordinates = {!!json_encode($area['coordinates'])!!};

        if (polygonCoordinates) {
            const polygonPath = polygonCoordinates.map(coord => ({
                lat: coord[1]
                , lng: coord[0] // Convert to Google Maps format
            }));

            lastpolygon = new google.maps.Polygon({
                paths: polygonPath
                , editable: true
                , map: map
            });

            map.fitBounds(getPolygonBounds(lastpolygon));
        }

        google.maps.event.addListener(drawingManager, "overlaycomplete", function(event) {
            if (lastpolygon) {
                lastpolygon.setMap(null); // Remove the previous polygon
            }

            let coordinates = event.overlay.getPath().getArray().map(latlng => ({
                lat: latlng.lat()
                , lng: latlng.lng()
            }));

            $('#coordinates').val(JSON.stringify(coordinates));
            lastpolygon = event.overlay;
        });

        // Reset Map Button
        $('#reset_btn').on('click', function() {
            if (lastpolygon) {
                lastpolygon.setMap(null); // Remove existing polygon
            }

            if (polygonCoordinates) {
                const polygonPath = polygonCoordinates.map(coord => ({
                    lat: coord[1]
                    , lng: coord[0]
                }));

                lastpolygon = new google.maps.Polygon({
                    paths: polygonPath
                    , editable: true
                    , map: map
                });

                map.fitBounds(getPolygonBounds(lastpolygon));

                $('#coordinates').val(JSON.stringify(polygonPath));
                console.log(JSON.stringify(polygonPath));
            }

            marker.setPosition(myLatlng);
            map.setCenter(myLatlng);
            map.setZoom(15);
            searchBox.value = '';
        });
    }

    // Load the map when the window loads
    window.onload = function() {
        initMap();
    };

    $('#zone_form').on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.post({
            url: '{{route("zoneUpdate")}}'
            , data: formData
            , contentType: false
            , processData: false
            , success: function(response) {
                location.reload();
            }
            , error: function(xhr) {
                console.error('An error occurred:', xhr.responseText);
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    var errors = xhr.responseJSON.errors;

                    $('.alert-danger').html('');
                    var ul = $('<ul></ul>');

                    $.each(errors, function(field, messages) {
                        messages.forEach(function(message) {
                            ul.append('<li>' + message + '</li>');
                        });
                    });

                    $('.alert-danger').append(ul);
                    $('.alert-danger').show();
                }
            }
        });
    });



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

