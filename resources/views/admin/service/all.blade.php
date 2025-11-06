@extends('layouts.master')
@section('content')


<!--start content-->
<main class="page-content">

    <div class="">
        <!--breadcrumb-->
        <div class="breadcrumbWhite page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="   pe-3">
                <h6>Services Management</h6>
                <p>Here are all Services</p>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('serviceCreate') }}" type="button" class="btn btn-primary">Add Service</a>
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
                        <h6>Total Services</h6>
                        <div class="d-flex">
                            <input type="search" class="form-control me-2">
                            <button class="FilterBtn">Filters</button>
                        </div>
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
                                <th>Category</th>
                                <th>Duration Range</th>
                                <th>Price Range</th>
                                <th>Whats Included</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($services as $service )
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center position-relative">
                                            <input type="checkbox" class="me-2">
                                            <div class="TableMainImage">
                                                <img src="{{ $service->image }}" alt="">
                                            </div>
                                            <div class="TableMainImageText ms-2">
                                                <p>{{ $service->name ?? 'Not Found' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $service->category->name ?? 'Not Found' }}</td>
                                    <td>{{ $service->min_duration ?? 'Not Found' }} - {{ $service->max_duration }} Hours</td>
                                    <td>${{ $service->min_price ?? 'Not Found' }} - {{ $service->max_price }}</td>
                                    <td>
                                        @forelse ($service->whats_included as $item )
                                        <li>{{ $item }}</li>
                                        @empty
                                        @endforelse
                                    </td>
                                    <td>
                                        @if($service->status == 1)
                                        <span class="badge_green">Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('serviceEdit',$service->id) }}" type="button" class="btn btn-outline-info"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a href="{{ route('serviceDelete',$service->id) }}" type="button" class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
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
