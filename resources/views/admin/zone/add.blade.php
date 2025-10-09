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
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Create Zones</li>
                </ol>
            </nav>
        </div>
    </div>

    <h6 class="mb-0 text-uppercase" style="margin-top: 50px;">Zones</h6>
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
                                        <strong>Create & connect dots</strong> in a specific area on the map to add a new business zone.
                                    </p>
                                </div>
                                <div class="zone-setup-item">
                                    <div class="zone-setup-icon">
                                        <i class="fa-solid fa-pencil"></i>
                                    </div>
                                    <div class="info">
                                        Use this <strong>‘Hand Tool’</strong> to find your target zone.
                                    </div>
                                </div>
                                <div class="zone-setup-item">
                                    <div class="zone-setup-icon">
                                        <i class="fa-solid fa-border-none"></i>
                                    </div>
                                    <div class="info">
                                        Use this <strong>‘Shape Tool’</strong> to point out the areas and connect the dots.
                                        A minimum of <strong>3 points/dots</strong> is required.
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
                                        <input type="text" name="name" class="form-control" placeholder="Type new zone name here" maxlength="191" id="default-form-input" required>
                                    </div>
                                </div>


                                <div class="form-group mb-3 d-none">
                                    <label class="input-label" for="exampleFormControlInput1">Coordinates<span class="form-label-secondary" data-toggle="tooltip" data-placement="right" data-original-title="draw your zone on the map">draw your zone on the
                                            map</span></label>
                                    <textarea type="text" rows="8" name="coordinates" id="coordinates" class="form-control" readonly></textarea>
                                </div>

                                <div class="map-warper overflow-hidden rounded">
                                    <input id="pac-input" class="controls rounded initial-8" title="search your location here" type="text" placeholder="search here" />
                                    <div id="map-canvas" class="h-100 m-0 p-0"></div>
                                </div>
                                <div class="d-flex mt-3 justify-content-end">
                                    <button id="reset_btn" type="button" class="btn btn-danger mr-2">reset</button>
                                    <button type="submit" class="btn btn-primary ms-3">submit</button>
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
        let myLatlng = new google.maps.LatLng(39.8283, -98.5795);
        let myOptions = {
            zoom: 4
            , center: myLatlng
            , mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        // Initialize the map using the correct ID
        map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);

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

        // Setup the drawing manager for drawing new polygons if needed
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

        google.maps.event.addListener(drawingManager, "overlaycomplete", function(event) {
            if (lastpolygon) {
                lastpolygon.setMap(null);
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
                lastpolygon.setMap(null);
                $('#coordinates').val('');
                lastpolygon = null;
            }
            marker.setPosition(myLatlng);
            map.setCenter(myLatlng);
            map.setZoom(4);
            searchBox.value = '';
        });
    }

    // Load the map when the window loads
    window.onload = function() {
        initMap();
    };

    $('#zone_form').on('submit', function() {
        let formData = new FormData(this);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post({
            url: "{{ route('zoneStore') }}"
            , data: formData
            , cache: false
            , contentType: false
            , processData: false
            , success: function(response) {

                location.reload();

            }
            , error: function(xhr) {
                console.error('An error occurred:', xhr.responseText);
            }
        });
    });

</script>



@endsection