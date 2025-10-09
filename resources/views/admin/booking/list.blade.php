@extends('layouts.master')
@section('content')



<!--start content-->
<main class="page-content">

    <div class="">
        <div class="breadcrumbWhite page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="   pe-3">
                <h6>Bookings Management</h6>
                <p>Here are all bookings</p>
            </div>
        </div>
        <hr>
    </div>


    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Recent Jobs</h6>
                        <div class="d-flex">
                            <input type="date" class="form-control me-2">
                            <button class="FilterBtn">Filters</button>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table customTable">
                        <table class="table table-responsive">
                            <thead>
                                <th>Service Name</th>
                                <th>Cleaner Name</th>
                                <th>User Name</th>
                                <th>Payment Status</th>
                                <th>Created At</th>
                                <th>Status</th>
                                <th>Assign Cleaner</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @forelse ($bookings as $booking )
                                <tr>
                                    <td><a href="#">{{ $booking->service->name ?? 'Not Found' }}</a></td>
                                    <td>{{ $booking->cleaner->name ?? 'Not Found' }}</td>
                                    <td>{{ $booking->user->name ?? 'Not Found' }}</td>
                                    <td>
                                        @if($booking->payment_status == 'unpaid')
                                        <span class="badge_red">Unpaid</span>
                                        @else
                                        <span class="badge_green">Paid</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($booking->status == 'pending')
                                        <span class="badge_yellow">Pending</span>
                                        @elseif($booking->status == 'confimed')
                                        <span class="badge_green">Confirmed</span>
                                        @elseif($booking->status == 'completed')
                                        <span class="badge_green">Completed</span>
                                        @elseif($booking->status == 'cancelled')
                                        <span class="badge_red">Cancelled</span>
                                        @endif
                                    </td>
                                    <td>{{ $booking->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <button data-bs-toggle="modal" data-bs-target="#AppointJob" type="button" class="btn btn-outline-info"><i class="fa-solid fa-users"></i></button>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="jobsViewPage.php" type="button" class="btn btn-outline-info"><i class="fa-regular fa-eye"></i></a>
                                            <button type="button" class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                                        </div>
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
    </div>
</main>


<!-- Modal -->
<div class="modal fade" id="AppointJob" tabindex="-1" aria-labelledby="AppointJobLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AppointJobLabel">Assign Job</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label for="">Assign to (Team)</label>
                        <select name="" class="form-select" id="">
                            <option value=""></option>
                            <option value=""></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection
