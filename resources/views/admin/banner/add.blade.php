@extends('layouts.master')
@section('content')


<main class="page-content">

    <div class="">
        <div class="breadcrumbWhite page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="   pe-3">
                <h6>Add Banner</h6>
                <div class="d-flex">
                    <p>Banner Management</p>
                    <p class="ms-2">▶</p>
                    <p class="ms-2">Add Banner</p>
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
                    <form action="{{ route('storeBanner') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12 mt-3">
                                <label for="">Title : </label>
                                <input type="text" class="form-control" name="title" value="">
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 mt-3">
                                <label for="">Discount Value :</label>
                                <input type="number" class="form-control" name="discount" value="">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                <label for="">Description :</label>
                                <textarea class="form-control" rows="5" cols="5" name="description"></textarea>
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
