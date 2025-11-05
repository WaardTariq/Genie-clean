@extends('layouts.master')
@section('content')



<!--start content-->
<main class="page-content">

    <div class="">
        <div class="breadcrumbWhite page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="   pe-3">
                <h6>Booking View</h6>
            </div>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Booking Details Of #262179</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="descriptionContent">
                        <p>Service Title:</p>
                        <p>{{ $booking->service->name ?? 'Not Found' }}</p>
                    </div>
                    <div class="descriptionContent">
                        <p>Total Amount:</p>
                        <p>{{ $booking->cleaner->price ?? 'Not Found' }}</p>
                    </div>
                    <div class="descriptionContent">
                        <p>Payment Method:</p>
                        <p>Stripe</p>
                    </div>
                    <div class="descriptionContent">
                        <p>Payment Status:</p>
                        @if($booking->payment_status == 'unpaid')
                        <span class="badge_red">Unpaid</span>
                        @else
                        <span class="badge_green">Paid</span>
                        @endif
                    </div>
                    <div class="descriptionContent">
                        <p>Date : </p>
                        <p>{{ $booking->date ?? 'Not Found' }}</p>
                    </div>
                    <div class="descriptionContent">
                        <p>Time :</p>
                        <p>{{ $booking->time ?? 'Not Found' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-xl-3 col-md-3 col-sm-12 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>User Details :</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="imgDivContainer text-center p-3">
                        <img src="{{ $booking->user->image }}" alt="user avatar" class="img-fluid">
                        <h5 class="mt-3 mb-0">{{ $booking->user->name ?? 'Not Found' }}</h5>
                        <p class="mb-0">user@example.com</p>
                    </div>
                    <hr>
                    <div class="descriptionContent">
                        <p>Phone:</p>
                        <p>{{ $booking->user->phone ?? 'Not Found' }}</p>
                    </div>
                    <div class="descriptionContent">
                        <p>Country:</p>
                        <p>United Arab Emirates</p>
                    </div>
                    <div class="descriptionContent">
                        <p>State:</p>
                        <p>Dubai</p>
                    </div>
                    <div class="descriptionContent">
                        <p>City:</p>
                        <p>Los Angeles</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-xl-3 col-md-3 col-sm-12 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Cleaner Details :</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="imgDivContainer text-center p-3">
                        <img src="{{ $booking->cleaner->image ?? 'Not Found' }}" alt="user avatar" class="img-fluid">
                        <h5 class="mt-3 mb-0">{{ $booking->cleaner->name ?? 'Not Found' }}</h5>
                        <p class="mb-0">{{ $booking->cleaner->email ?? 'Not Found' }}</p>
                    </div>
                    <hr>
                    <div class="descriptionContent">
                        <p>Phone:</p>
                        <p>+{{ $booking->cleaner->phone ?? 'Not Found' }}</p>
                    </div>
                    <div class="descriptionContent">
                        <p>Country:</p>
                        <p>United Arab Emirates</p>
                    </div>
                    <div class="descriptionContent">
                        <p>State:</p>
                        <p>Dubai</p>
                    </div>
                    <div class="descriptionContent">
                        <p>City:</p>
                        <p>Los Angeles</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-xl-4 col-md-4 col-sm-12 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Assign Booking :</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if($booking->cleaner)
                        <form action="{{ route('unassignCleaner',$booking->id) }}" method="POST" class="text-center mb-3">
                            @csrf
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Unassign Cleaner</button>
                            </div>
                            @else
                            <div class="col-12" style="margin-top: 20px;">
                                <label for="">Available Cleaners</label>
                                <select name="" class="form-select" id=""></select>
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-xl-3 col-md-3 col-sm-12 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Booking Address :</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="descriptionContent">
                        <p>City:</p>
                        <p>Los Angeles</p>
                    </div>
                    <div class="descriptionContent">
                        <p>State:</p>
                        <p>Dubai</p>
                    </div>
                    <div class="descriptionContent">
                        <p>Country:</p>
                        <p>United Arab Emirates</p>
                    </div>
                    <div class="descriptionContent">
                        <p>Address:</p>
                        <p>1234 Elm Street, Apartment 56</p>
                    </div>
                    <div class="descriptionContent">
                        <p>Pin Code:</p>
                        <p>90001</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5 col-xl-5 col-md-5 col-sm-12 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Coupon Applied :</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="descriptionContent">
                        <p>Name:</p>
                        <p>{{ $booking->promoCode->title ?? 'Not Found' }}</p>
                    </div>
                    <div class="descriptionContent">
                        <p>Code:</p>
                        <p>{{ $booking->promoCode->code ?? 'Not Found' }}</p>
                    </div>
                    <div class="descriptionContent">
                        <p>Validity:</p>
                        <p>{{ $booking->promoCode->expires_at ?? 'Not Found' }}</p>
                    </div>
                    <div class="descriptionContent">
                        <p>Status:</p>
                        @if($booking->promoCode && $booking->promoCode->status == 1)
                        <span class="badge_green">Active</span>
                        @else
                        <span class="badge_red">Inactive</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7 col-xl-7 col-md-7 col-sm-12 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Summary :</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="descriptionContent">
                        <p>Payment Method:</p>
                        <p>Stripe</p>
                    </div>
                    <div class="descriptionContent">
                        <p>Payment Status:</p>
                        @if($booking->payment_status == 'unpaid')
                        <span class="badge_red">Unpaid</span>
                        @else
                        <span class="badge_green">Paid</span>
                        @endif
                    </div>
                    <div class="descriptionContent">
                        <p>Coupon Discount:</p>
                        <p>$ {{ $booking->promoCode->discount_value ?? 'Not Found' }}</p>
                    </div>
                    <div class="descriptionContent">
                        <p>Service Amount After Discount : </p>
                        <p>$ {{ $booking->total_amount ?? 'Not Found' }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection
