@extends('layouts.master')
@section('content')



<!--start content-->
<main class="page-content">

    <div class="">
        <div class="breadcrumbWhite page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="   pe-3">
                <h6>Coupens Management</h6>
                <p>Here are all Coupens</p>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('createPromoCode') }}" type="button" class="btn btn-primary">Create Coupen</a>
                </div>
            </div>
        </div>
        <hr>
    </div>


    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>All Coupens</h6>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table customTable">
                        <table class="table table-responsive">
                            <thead>
                                <th>S.No</th>
                                <th>Title</th>
                                <th>Code</th>
                                <th>Discount Value</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @forelse ($promos as $promo )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $promo->title ?? 'Not Found' }}</td>
                                    <td>{{ $promo->code ?? 'Not Found' }}</td>
                                    <td>{{ $promo->discount_value ?? 'Not Found' }}</td>
                                    <td>
                                        @if($promo->status == 1)
                                        <span class="badge_green">Active</span>
                                        @else
                                        <span class="badge_green">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button data-bs-toggle="modal" data-bs-target="#AppointJob" type="button" class="btn btn-outline-info"><i class="fa-solid fa-calendar-check"></i></button>
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
@endsection
