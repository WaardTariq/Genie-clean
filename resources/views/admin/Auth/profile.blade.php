@extends('layouts.master')
@section('content')


<main class="page-content">

    <div class="">
        <!--breadcrumb-->
        <div class="breadcrumbWhite page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="   pe-3">
                <h6>Update Profile</h6>
                <div class="d-flex">
                    <p>Update Profile</p>
                    <p class="ms-2">▶</p>
                    <p class="ms-2">Update Service</p>
                </div>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                </div>
            </div>
        </div>
        <hr>
    </div>

    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <form action="{{ route('updateProfile') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <img src="{{ $profile->image }}" class="img-thumbnail" alt="" style="display: block; margin: 0 auto;width:150px">

                            <hr style="margin-top: 10px;">

                            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                <label for="">Name : </label>
                                <input type="text" class="form-control" name="name" value="{{ $profile->name ?? 'Not Found' }}">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                <label for="">Address</label>
                                <input type="text" class="form-control" name="address" value="{{ $profile->address ?? 'Not Found' }}">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                <label for="">Phone :</label>
                                <input type="number" class="form-control" name="phone" value="{{ $profile->phone ?? 'Not Found' }}">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                <label for="">Image</label>
                                <input type="file" class="form-control" name="image">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" style="margin-top: 25px;float: right;">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
