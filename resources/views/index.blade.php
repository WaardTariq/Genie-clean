@extends('layouts.master')
@section('content')

<main class="page-content">
    <div class="">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="   pe-3" style="font-size: 20px;">Hi, John Welcome Back!</div>
            <div class="ms-auto">
                <div class="btn-group">
                    <!-- <a href="CreateJob.php" type="button" class="btn btn-primary"></a> -->
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <hr>

        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-4 BG_SET mb-4">
            <div class="col h-100">
                <div class="card headerCard overflow-hidden radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                            <div class="w-100 d-flex">
                                <p>Total Clients</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                            <div class="w-60">
                                <h4 class="">14,210</h4>
                                <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                                    <p class="mb-0 me-2 text-success"><i class="bi bi-arrow-up"></i> + 10% </p>
                                    <p class="m-0"> +$142</p>
                                </div>
                            </div>
                            <div class="w-40 d-flex justify-content-end">
                                <img src="{{ asset('assets\images\icons\CardIcon11.png') }}" style="width: 58px;" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col h-100">
                <div class="card headerCard overflow-hidden radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                            <div class="w-100 d-flex">
                                <p>Active Client</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                            <div class="w-60">
                                <h4 class="">300</h4>
                                <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                                    <p class="mb-0 me-2 text-success"><i class="bi bi-arrow-up"></i> + 5% </p>
                                    <p class="m-0"> +$142</p>
                                </div>
                            </div>
                            <div class="w-40 d-flex justify-content-end">
                                <img src="{{ asset('assets\images\icons\CardIcon12.png') }}" style="width: 58px;" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col h-100">
                <div class="card headerCard overflow-hidden radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                            <div class="w-100 d-flex">
                                <p>Total Members</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                            <div class="w-60">
                                <h4 class="">20</h4>
                                <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                                    <p class="mb-0 me-2 text-success"><i class="bi bi-arrow-up"></i> + 5% </p>
                                    <p class="m-0"> +$142</p>
                                </div>
                            </div>
                            <div class="w-40 d-flex justify-content-end">
                                <img src="{{ asset('assets\images\icons\CardIcon11.png') }}" style="width: 58px;" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col h-100">
                <div class="card headerCard overflow-hidden radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                            <div class="w-100 d-flex">
                                <p>Active Members</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                            <div class="w-60">
                                <h4 class="">300</h4>
                                <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                                    <p class="mb-0 me-2 text-success"><i class="bi bi-arrow-up"></i> + 5% </p>
                                    <p class="m-0"> +$142</p>
                                </div>
                            </div>
                            <div class="w-40 d-flex justify-content-end">
                                <img src="{{ asset('assets\images\icons\CardIcon12.png') }}" style="width: 58px;" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-4 BG_SET mb-4">
            <div class="col h-100">
                <div class="card headerCard overflow-hidden radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                            <div class="w-100 d-flex">
                                <p>Ongoing Jobs</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                            <div class="w-60">
                                <h4 class="">300</h4>
                                <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                                    <p class="mb-0 me-2 text-success"><i class="bi bi-arrow-up"></i> + 5% </p>
                                    <p class="m-0"> +$142</p>
                                </div>
                            </div>
                            <div class="w-40 d-flex justify-content-end">
                                <img src="{{ asset('assets\images\icons\CardIcon6.png') }}" style="width: 58px;" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col h-100">
                <div class="card headerCard overflow-hidden radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                            <div class="w-100 d-flex">
                                <p>Scheduled Jobs</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                            <div class="w-60">
                                <h4 class="">20</h4>
                                <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                                    <p class="mb-0 me-2 text-success"><i class="bi bi-arrow-up"></i> + 5% </p>
                                    <p class="m-0"> +$142</p>
                                </div>
                            </div>
                            <div class="w-40 d-flex justify-content-end">
                                <img src="{{ asset('assets\images\icons\CardIcon4.png') }}" style="width: 58px;" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col h-100">
                <div class="card headerCard overflow-hidden radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                            <div class="w-100 d-flex">
                                <p>Completed Jobs</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                            <div class="w-60">
                                <h4 class="">300</h4>
                                <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                                    <p class="mb-0 me-2 text-success"><i class="bi bi-arrow-up"></i> + 5% </p>
                                    <p class="m-0"> +$142</p>
                                </div>
                            </div>
                            <div class="w-40 d-flex justify-content-end">
                                <img src="{{ asset('assets\images\icons\CardIcon5.png') }}" style="width: 58px;" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col h-100">
                <div class="card headerCard overflow-hidden radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                            <div class="w-100 d-flex">
                                <p>Total Payments</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                            <div class="w-60">
                                <h4 class="">$14,210</h4>
                                <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                                    <p class="mb-0 me-2 text-success"><i class="bi bi-arrow-up"></i> + 10% </p>
                                    <p class="m-0"> +$142</p>
                                </div>
                            </div>
                            <div class="w-40 d-flex justify-content-end">
                                <img src="{{ asset('assets\images\icons\CardIcon7.png') }}" style="width: 58px;" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>


    <div class="row">
        <div class="col-lg-8 col-xl-8 col-md-12 col-sm-12 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header">
                    <h6>Statistic</h6>
                    <p class="m-0">Income and Expenses</p>
                </div>
                <div class="card-body">
                    <!-- <h6 class="mb-0 text-uppercase">Todays Bookings</h6>
              <hr> -->
                    <div class="chart-container1">
                        <canvas id="chart1"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xl-4 col-md-12 col-sm-12 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header">
                    <h6>Progress</h6>
                    <p class="m-0">Task Progress</p>
                </div>
                <div class="card-body">
                    <div class="h-100 d-flex flex-column justify-content-center">
                        <div class="semi-circle-container">
                            <div class="semi-circle"></div>
                            <div class="semi-circle-fill"></div>
                            <div class="percentage">75.55%</div>
                        </div>
                        <div class="sub-stats">
                            10% ▲ +40 today
                        </div>
                        <div class="message">
                            Horay you succeed finished <b>40 task</b> today, its higher than yesterday, keep it up
                        </div>
                        <div class="stats">
                            <div>
                                <span class="up">1,402</span>
                                In Progress
                            </div>
                            <div>
                                <span class="down">872</span>
                                Finished
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->

    <div class="row">
        <div class="col-lg-8 col-xl-8 col-md-12 col-sm-12 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header">
                    <h6>Recent Jobs</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table customTable">
                        <table class="table table-responsive">
                            <thead>
                                <th>
                                    <div class="d-flex align-items-center position-relative">
                                        <input type="checkbox" class="me-2">
                                        Project Name
                                    </div>
                                </th>
                                <th>Due Date</th>
                                <th>Team Members</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center position-relative">
                                            <input type="checkbox" class="me-2">
                                            <div class="TableMainImage">
                                                <img src="{{ asset('assets\images\avatars\avatar-1.png') }}" alt="">
                                            </div>
                                            <div class="TableMainImageText ms-2">
                                                <p><B>Hospital Floor Cleaning</B></p>
                                                <p>Clara Wood</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>12 Apr 2025</td>
                                    <td>
                                        <div class="d-flex align-items-center position-relative">
                                            <div class="TableMultiImage">
                                                <img src="{{ asset('assets\images\avatars\avatar-1.png') }}" alt="">
                                            </div>
                                            <div class="TableMultiImage">
                                                <img src="{{ asset('assets\images\avatars\avatar-1.png') }}" alt="">
                                            </div>
                                            <div class="TableMultiImage">
                                                <img src="{{ asset('assets\images\avatars\avatar-1.png') }}" alt="">
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge_red">In Progress</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center position-relative">
                                            <input type="checkbox" class="me-2">
                                            <div class="TableMainImage">
                                                <img src="{{ asset('assets\images\avatars\avatar-1.png') }}" alt="">
                                            </div>
                                            <div class="TableMainImageText ms-2">
                                                <p><B>Hospital Floor Cleaning</B></p>
                                                <p>Clara Wood</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>12 Apr 2025</td>
                                    <td>
                                        <div class="d-flex align-items-center position-relative">
                                            <div class="TableMultiImage">
                                                <img src="{{ asset('assets\images\avatars\avatar-1.png') }}" alt="">
                                            </div>
                                            <div class="TableMultiImage">
                                                <img src="{{ asset('assets\images\avatars\avatar-1.png') }}" alt="">
                                            </div>
                                            <div class="TableMultiImage">
                                                <img src="{{ asset('assets\images\avatars\avatar-1.png') }}" alt="">
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge_red">In Progress</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center position-relative">
                                            <input type="checkbox" class="me-2">
                                            <div class="TableMainImage">
                                                <img src="{{ asset('assets\images\avatars\avatar-1.png') }}" alt="">
                                            </div>
                                            <div class="TableMainImageText ms-2">
                                                <p><B>Hospital Floor Cleaning</B></p>
                                                <p>Clara Wood</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>12 Apr 2025</td>
                                    <td>
                                        <div class="d-flex align-items-center position-relative">
                                            <div class="TableMultiImage">
                                                <img src="{{ asset('assets\images\avatars\avatar-1.png') }}" alt="">
                                            </div>
                                            <div class="TableMultiImage">
                                                <img src="{{ asset('assets\images\avatars\avatar-1.png') }}" alt="">
                                            </div>
                                            <div class="TableMultiImage">
                                                <img src="{{ asset('assets\images\avatars\avatar-1.png') }}" alt="">
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge_red">In Progress</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center position-relative">
                                            <input type="checkbox" class="me-2">
                                            <div class="TableMainImage">
                                                <img src="{{ asset('assets\images\avatars\avatar-1.png') }}" alt="">
                                            </div>
                                            <div class="TableMainImageText ms-2">
                                                <p><B>Hospital Floor Cleaning</B></p>
                                                <p>Clara Wood</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>12 Apr 2025</td>
                                    <td>
                                        <div class="d-flex align-items-center position-relative">
                                            <div class="TableMultiImage">
                                                <img src="{{ asset('assets\images\avatars\avatar-1.png') }}" alt="">
                                            </div>
                                            <div class="TableMultiImage">
                                                <img src="{{ asset('assets\images\avatars\avatar-1.png') }}" alt="">
                                            </div>
                                            <div class="TableMultiImage">
                                                <img src="{{ asset('assets\images\avatars\avatar-1.png') }}" alt="">
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge_red">In Progress</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center position-relative">
                                            <input type="checkbox" class="me-2">
                                            <div class="TableMainImage">
                                                <img src="{{ asset('assets\images\avatars\avatar-1.png') }}" alt="">
                                            </div>
                                            <div class="TableMainImageText ms-2">
                                                <p><B>Hospital Floor Cleaning</B></p>
                                                <p>Clara Wood</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>12 Apr 2025</td>
                                    <td>
                                        <div class="d-flex align-items-center position-relative">
                                            <div class="TableMultiImage">
                                                <img src="{{ asset('assets\images\avatars\avatar-1.png') }}" alt="">
                                            </div>
                                            <div class="TableMultiImage">
                                                <img src="{{ asset('assets\images\avatars\avatar-1.png') }}" alt="">
                                            </div>
                                            <div class="TableMultiImage">
                                                <img src="{{ asset('assets\images\avatars\avatar-1.png') }}" alt="">
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge_red">In Progress</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
