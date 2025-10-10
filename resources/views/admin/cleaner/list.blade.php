@extends('layouts.master')
@section('content')



<!--start content-->
<main class="page-content">

    <div class="">
        <div class="breadcrumbWhite page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="   pe-3">
                <h6>Cleaners Management</h6>
                <p>Here are all cleaners</p>
            </div>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Cleaners</h6>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table customTable">
                        <table class="table table-responsive">
                            <thead>
                                <th>
                                    <div class="d-flex align-items-center position-relative">
                                        <input type="checkbox" class="me-2">
                                        Name
                                    </div>
                                </th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @forelse ($cleaners as $cleaner )
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center position-relative">
                                            <input type="checkbox" class="me-2">
                                            <div class="TableMainImage">
                                                <img src="{{ $cleaner->image }}" alt="">
                                            </div>
                                            <div class="TableMainImageText ms-2">
                                                <a href="{{ route('cleanerDetail',$cleaner->id) }}">
                                                    <p><B>{{ $cleaner->name ?? 'Not Found' }}</B></p>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $cleaner->email ?? 'Not Found' }}</td>
                                    <td>{{ $cleaner->phone ?? 'Not Found' }}</td>
                                    <td>
                                        @if($cleaner->status == 1)
                                        <span class="badge_green">Active</span>
                                        @else
                                        <span class="badge_red">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button data-bs-toggle="modal" data-bs-target="#AppointJob" type="button" class="btn btn-outline-info"><i class="fa-solid fa-calendar-check"></i></button>
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
