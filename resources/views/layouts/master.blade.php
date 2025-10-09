<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/images/LogoIcon.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="{{ asset('assets/plugins/highcharts/css/dark-unica.css') }}" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../../../cdn.jsdelivr.net/npm/bootstrap-icons%401.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../../cdn.jsdelivr.net/npm/bootstrap-icons%401.5.0/font/bootstrap-icons.css">

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    <!-- loader-->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />

    {{-- Image Uploader --}}
    <link type="text/css" rel="stylesheet" href="{{ asset('assets\css\image-uploader.min.css') }}">

    <!--Theme Styles-->
    <link href="{{ asset('assets/css/dark-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/light-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/semi-dark.css"') }}" rel=" stylesheet" />
    <link href="{{ asset('assets/css/header-colors.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/yearpicker/css/yearpicker.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>{{ env('APP_NAME') }}</title>
</head>
<body>

    <div class="wrapper">
        @include('layouts.partials.header')

        @include('layouts.partials.sidebar')

        @yield('content')

        @include('layouts.partials.footer')

        <div class="overlay nav-toggle-icon"></div>

        @yield('modal')
        <div id="newMessageModal"></div>

        @include('alertMessages.alert-message')
    </div>



    <!-- Bootstrap bundle JS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('assets/plugins/chartjs/js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/chartjs/js/Chart.extension.js') }}"></script>
    <script src="{{ asset('assets/plugins/chartjs/js/chartjs-custom.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/table-datatable.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/form-select2.js') }}"></script>
    <script src="{{ asset('assets/plugins/easyPieChart/jquery.easypiechart.js') }}"></script>
    <script src="{{ asset('assets/js/data-widgets.js') }}"></script>
    <!-- highcharts js -->
    <script src="{{ asset('assets/plugins/highcharts/js/highcharts.js') }}"></script>
    <script src="{{ asset('assets/plugins/highcharts/js/highcharts-more.js') }}"></script>
    <script src="{{ asset('assets/plugins/highcharts/js/variable-pie.js') }}"></script>
    <script src="{{ asset('assets/plugins/highcharts/js/solid-gauge.js') }}"></script>
    <script src="{{ asset('assets/plugins/highcharts/js/highcharts-3d.js') }}"></script>
    <script src="{{ asset('assets/plugins/highcharts/js/cylinder.js') }}"></script>
    <script src="{{ asset('assets/plugins/highcharts/js/funnel3d.js') }}"></script>
    <script src="{{ asset('assets/plugins/highcharts/js/exporting.js') }}"></script>
    <script src="{{ asset('assets/plugins/highcharts/js/export-data.js') }}"></script>
    <script src="{{ asset('assets/plugins/highcharts/js/accessibility.js') }}"></script>
    <script src="{{ asset('assets/plugins/highcharts/js/highcharts-custom.script.js') }}"></script>

    <!-- google maps api -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOhg9paY7RBsRXeWBUJHukoJsDMNjBo9E&libraries=places,drawing&callback=initMap" async defer>
    </script>

    <!--app-->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>
    <script src="{{ asset('assets/js/index.js') }}"></script>
    {{-- <script>
        new PerfectScrollbar(".best-product")

    </script> --}}

    <script src="{{ asset('assets/plugins/yearpicker/js/yearpicker.js') }}" s></script>


    <script>
        $(document).ready(function() {
            $('.yearpicker').yearpicker({
                autoHide: true
                , year: 2025
                , startYear: 2000
                , endYear: 2030
                , onChange: function(value) {
                    console.log('Selected year:', value);
                }
            });
        });

    </script>

    <script>
        $(document).ready(function() {
            $(".menuBtn").click(function(e) {
                e.stopPropagation();

                let dropdownMenu = $(this).siblings(".dropdown-menu");
                $(".dropdown-menu").not(dropdownMenu).hide();
                dropdownMenu.toggle();
            });
            $(document).click(function(e) {
                if (!$(e.target).closest(".menuBtn, .dropdown-menu").length) {
                    $(".dropdown-menu").hide();
                }
            });
            $(".dropdown-menu .dropdown-item").click(function() {
                $(this).closest(".dropdown-menu").hide();
            });
        });

    </script>



    {{-- Toaster Script --}}
    <script>
        $(document).ready(function() {
            let messageToast = `<div class="position-fixed bottom-0 right-0 p-3" style="z-index: 5; right: 0; top: 56px;">
                                        <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
                                            <div class="toast-header">
                                            <strong class="mr-auto">Notification</strong>
                                            <small>${time}</small>
                                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <a href="${modalMessage.route}" class="text-white">
                                                <div class="toast-body" style="background-color:#1969dd;">
                                                    ${modalMessage.message}
                                                </div>
                                            </a>
                                        </div>
                                    </div>`;

            $('#newMessageModal').html(messageToast);
            $(document).find('#liveToast').toast({
                autohide: false
            });

            $(document).find('#liveToast').toast('show');

        });

    </script>
    {{-- ENd --}}

</body>
</html>
