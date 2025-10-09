@extends('layouts.master')
@section('content')


<main class="page-content">

    <div class="">
        <!--breadcrumb-->
        <div class="breadcrumbWhite page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="   pe-3">
                <h6>Add Service</h6>
                <div class="d-flex">
                    <p>Services Management</p>
                    <p class="ms-2">▶</p>
                    <p class="ms-2">Add Service</p>
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
                    <form action="{{ route('serviceStore') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12 mt-3">
                                <label for="">Name : </label>
                                <input type="text" class="form-control" name="name" value="">
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 mt-3">
                                <label for="">Duration Unit :</label>
                                <select name="duration_unit" class="form-control" name="duration_unit">
                                    <option selected disabled>---Please Select---</option>
                                    <option value="hours">Hours</option>
                                    <option value="minutes">Minutes</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12 mt-3">
                                <label for="">Min Duration :</label>
                                <input type="number" class="form-control" name="max_duration" value="">
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12 mt-3">
                                <label for="">Min Duration :</label>
                                <input type="number" class="form-control" name="min_duration" value="">
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
                                <label>Category :</label>
                                <select name="category_id" class="single-select" id="">
                                    <option selected disabled>---Please Select---</option>
                                    @forelse ($categories as $category )
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                <label for="">Min Price</label>
                                <input type="number" class="form-control" name="min_price" value="">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                <label for="">Max Price</label>
                                <input type="number" class="form-control" name="max_price" value="">
                            </div>
                            <div class="row" id="included-wrapper">
                                <div class="col-lg-10 col-md-6 col-sm-12 mt-3">
                                    <label for="">What's Included?</label>
                                    <input type="text" class="form-control" name="included[]">
                                </div>
                                <div class="col-lg-2 col-md-6 col-sm-12 mt-3 d-flex align-items-end">
                                    <button type="button" class="btn btn-primary" id="add-included">+</button>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6 col-sm-12 mt-3">
                                <label for="">Description</label>
                                <textarea cols="5" rows="5" class="form-control" name="description"></textarea>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                <label for="">Image</label>
                                <input type="file" class="form-control" name="image">
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                <label for="">Multiple Images :</label>
                                <div class="input-images"></div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" style="margin-top: 25px;float: right;">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/image-uploader.min.js') }}"></script>

<script>
    $('.input-images').imageUploader({
        imagesInputName: 'multiple_image'
    });

</script>

<script>
    $(document).ready(function() {
        $('#add-included').on('click', function(e) {
            e.preventDefault();

            // Create a clone of the input field
            const newField = `
                <div class="col-lg-10 col-md-6 col-sm-12 mt-3 included-item">
                    <input type="text" class="form-control" name="included[]" placeholder="Enter item">
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 mt-3 d-flex align-items-end included-item">
                    <button type="button" class="btn btn-danger remove-included">-</button>
                </div>
            `;

            $('#included-wrapper').append(newField);
        });

        // Remove cloned input
        $(document).on('click', '.remove-included', function() {
            $(this).closest('.included-item').prev('.included-item').remove();
            $(this).closest('.included-item').remove();
        });
    });

</script>


@endsection
