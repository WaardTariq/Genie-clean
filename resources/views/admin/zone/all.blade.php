@extends('layouts.master')
@section('content')

<main class="page-content">

    <div class="">
        <!--breadcrumb-->
        <div class="breadcrumbWhite page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="   pe-3">
                <h6>Zones</h6>
                <p>Here are all Zones</p>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('zoneCreate') }}" type="button" class="btn btn-primary">Create Zone</a>
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
                        <h6>Zones</h6>
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
                                <th>ID</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @forelse ($zones as $zone )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $zone->name ?? 'Not Found' }}</td>
                                    <th>
                                        <input type="checkbox" name="status" class="zone-status-toggle" data-id="{{ $zone->id }}" {{ $zone->status == 1 ? 'checked' : '' }} data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger">
                                    </th>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('zoneEdit',$zone->id) }}" type="button" class="btn btn-outline-info"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a href="{{ route('zoneShow',$zone->id) }}" type="button" class="btn btn-outline-info"><i class="fa-regular fa-eye"></i></a>
                                            <a href="{{ route('zoneDelete',$zone->id) }}" type="button" class="btn btn-outline-info"><i class="fa fa-trash" aria-hidden="true"></i></a>
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

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('.zone-status-toggle').change(function() {
            const zoneId = $(this).data('id');
            const status = $(this).prop('checked') ? 1 : 0;

            const url = `{{ route('zoneUpdateStatus', ':id') }}`.replace(':id', zoneId);

            $.ajax({
                url: url
                , method: 'POST'
                , data: {
                    _token: '{{ csrf_token() }}'
                    , status: status
                }
                , success: function(response) {
                    console.log(response.message);

                    location.reload();
                }
                , error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        });
    });

</script>
@endsection
