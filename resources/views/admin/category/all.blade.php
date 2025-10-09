@extends('layouts.master')
@section('content')



<!--start content-->
<main class="page-content">

    <div class="">
        <!--breadcrumb-->
        <div class="breadcrumbWhite page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="pe-3">
                <h6>Category Management</h6>
                <p>Here are all Categories</p>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddCategory">Add Category</button>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <hr>


    </div>


    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Total Categories</h6>
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
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category )
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center position-relative">
                                            <input type="checkbox" class="me-2">
                                            <div class="TableMainImage">
                                                <img src="{{ $category->image }}" alt="">
                                            </div>
                                            <div class="TableMainImageText ms-2">
                                                <p>{{ $category->name ?? 'Not Found' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($category->status == 1)
                                        <span class="badge_green">Active</span>
                                        @else
                                        <span class="badge_danger">InActive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button data-bs-toggle="modal" data-bs-target="#EditCategory" type="button" class="btn btn-outline-info EditCategory" data-id="{{ $category->id }}" data-name="{{ $category->name }}" data-description="{{ $category->description }}" data-image="{{ $category->image }}"><i class="fa-solid fa-pen-to-square"></i></button>
                                            <a href="{{ route('categoryDelete',$category->id) }}" type="button" class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i></a>
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
<div class="modal fade" id="AddCategory" tabindex="-1" aria-labelledby="AddCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddCategoryLabel">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('categoryStore') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>

                        <div class="col-12 mb-2">
                            <label for="">Image</label>
                            <input type="file" class="form-control" name="image">
                        </div>

                        <div class="col-12 mb-2">
                            <label for="">Description</label>
                            <textarea class="form-control" name="description" rows="5" cols="5"></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="EditCategory" tabindex="-1" aria-labelledby="EditCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditCategoryLabel">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="EditCategoryForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="id" id="CategoryId">

                        <div class="col-12 mb-2">
                            <label for="">Name</label>
                            <input type="text" id="CategoryName" class="form-control" name="name">
                        </div>

                        <div class="col-12 mb-2">
                            <label for="">Image</label>
                            <input type="file" id="CatgeoryImage" class="form-control" name="image">
                        </div>

                        <div class="col-12 mb-2">
                            <label for="">Description</label>
                            <textarea class="form-control" id="CategoryDescription" name="description" rows="5" cols="5"></textarea>
                        </div>

                        {{-- <div class="mb-2">
                            <label>Current Image</label><br>
                            <img id="PreviewImage" src="{{ asset('assets/images/placeholder.png') }}" alt="Category Image" class="img-thumbnail mb-2" style="max-width:120px;">
                    </div> --}}
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {

        // Populate modal with data
        $('.EditCategory').on('click', function() {
            $('#CategoryId').val($(this).data('id'));
            $('#CategoryName').val($(this).data('name'));
            $('#CategoryDescription').val($(this).data('description'));
        });

        // Submit form via AJAX
        $('#EditCategoryForm').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            $.ajax({
                url: "{{ route('categoryUpdate') }}"
                , method: "POST"
                , data: formData
                , processData: false
                , contentType: false
                , success: function(res) {
                    if (res.success) {
                        Swal.fire({
                            icon: 'success'
                            , title: 'Updated!'
                            , text: res.message || 'Category updated successfully'
                            , timer: 2000
                            , showConfirmButton: false
                        });
                        $('#EditCategory').modal('hide');

                        // Optionally reload table or update row dynamically
                        location.reload();
                    } else {
                        Swal.fire({
                            icon: 'error'
                            , title: 'Error!'
                            , text: res.message || 'Something went wrong'
                        , });
                    }
                }
                , error: function(xhr) {
                    Swal.fire({
                        icon: 'error'
                        , title: 'Failed!'
                        , text: xhr.responseJSON ? .message || 'Server error'
                    , });
                }
            });
        });
    });

</script>



@endsection
