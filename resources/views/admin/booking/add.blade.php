@extends('layouts.master')
@section('content')


<!--start content-->
<main class="page-content">

    <div class="">
        <!--breadcrumb-->
        <div class="breadcrumbWhite page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="   pe-3">
                <h6>Add Job</h6>
                <div class="d-flex">
                    <p>All Jobs</p>
                    <p class="ms-2">▶</p>
                    <p class="ms-2">Add Job</p>
                </div>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <!-- <a href="" type="button" class="btn btn-primary">Print Invoice</a> -->
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <hr>


    </div>


    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="">Client:</label>
                            <select name="" class="single-select" id="">
                                <option value=""></option>
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="">Job Type:</label>
                            <select name="" class="single-select" id="">
                                <option value=""></option>
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="">Location:</label>
                            <input type="text" class="form-control" name="">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="">Assign to (Team):</label>
                            <select name="" class="single-select" id="">
                                <option value=""></option>
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="">Date:</label>
                            <input type="date" class="form-control" name="">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="">Time:</label>
                            <input type="time" class="form-control" name="">
                        </div>
                        <div class="col-12">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
