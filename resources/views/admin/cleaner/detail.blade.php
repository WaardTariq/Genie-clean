@extends('layouts.master')
@section('content')



<!--start content-->
<main class="page-content">

    <div class="">
        <div class="breadcrumbWhite page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="   pe-3">
                <h6>Cleaner View</h6>
            </div>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-lg-4 col-xl-4 col-md-4 col-sm-12 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="imgDivContainer text-center p-3">
                        <div class="imgDivBG"></div>
                        <img src="{{asset('assets/images/avatars/avatar-1.png')}}" alt="user avatar" class="img-fluid">
                        <h5 class="mt-3 mb-0">{{ $cleaner->name ?? 'Not Found' }}</h5>
                        <p class="mb-0">{{ $cleaner->email ?? 'Not Found' }}</p>
                    </div>
                    <hr>
                    <div class="descriptionContent">
                        <p>Email :</p>
                        <p>{{ $cleaner->email ?? 'Not Found' }}</p>
                    </div>
                    <div class="descriptionContent">
                        <p>Phone :</p>
                        <p>+{{ $cleaner->phone ?? 'Not Found' }}</p>
                    </div>
                    <div class="descriptionContent">
                        <p>Country :</p>
                        <p>Australia</p>
                    </div>
                    <div class="descriptionContent">
                        <p>State:</p>
                        <p>New South Wales</p>
                    </div>
                    <div class="descriptionContent">
                        <p>City :</p>
                        <p>Sydney</p>
                    </div>
                    <div class="descriptionContent">
                        <p>Address :</p>
                        <p>321 Crown St, Unit 5, Sydney, NSW 2010</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-xl-8 col-md-8 col-sm-12 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Bookings</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table customTable">
                        <table class="table table-responsive">
                            <thead>
                                <th>Booking Number</th>
                                <th>Service Name</th>
                                <th>User Name</th>
                                <th>Created</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                @forelse ($cleaner->jobs as $job )
                                <tr>
                                    <td>#{{ $loop->iteration }}</td>
                                    <td>{{ $job->service->name ?? 'Not Found' }}</td>
                                    <td>{{ $job->user->name ?? 'Not Found' }}</td>
                                    <td>{{ $job->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        @if($job->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                        @elseif($job->status == 'confirmed')
                                        <span class="badge bg-success">Confirmed</span>
                                        @elseif($job->status == 'completed')
                                        <span class="badge bg-success">Confirmed</span>
                                        @else
                                        <span class="badge bg-danger">Cancelled</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                        <div class="pagination-container">
                            <div class="pagination-text">Showing 1–10 from 25</div>
                            <div class="pagination-buttons">
                                <button class="page-btn">&#8249;</button>
                                <button class="page-btn active">1</button>
                                <button class="page-btn">2</button>
                                <button class="page-btn">3</button>
                                <button class="page-btn">&#8250;</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Reviews :</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table customTable">
                        <table class="table table-responsive">
                            <thead>
                                <th>Customer Name</th>
                                <th>Service Name</th>
                                <th>Ratings</th>
                                <th>Description</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Jane Smith</td>
                                    <td>Home Cleaning</td>
                                    <td>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                    </td>
                                    <td>Excellent service! My house has never been cleaner.</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="pagination-container">
                            <div class="pagination-text">Showing 1–10 from 25</div>
                            <div class="pagination-buttons">
                                <button class="page-btn">&#8249;</button>
                                <button class="page-btn active">1</button>
                                <button class="page-btn">2</button>
                                <button class="page-btn">3</button>
                                <button class="page-btn">&#8250;</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection
