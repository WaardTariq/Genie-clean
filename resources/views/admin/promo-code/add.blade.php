@extends('layouts.master')
@section('content')


<main class="page-content">

    <div class="">
        <!--breadcrumb-->
        <div class="breadcrumbWhite page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="   pe-3">
                <h6>Create Coupens</h6>
                <div class="d-flex">
                    <p>Coupens Management</p>
                    <p class="ms-2">▶</p>
                    <p class="ms-2">Create Coupens</p>
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
                    <form action="{{ route('storePromoCode') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12 mt-3">
                                <label for="">Title : </label>
                                <input type="text" class="form-control" name="title" value="">
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 mt-3">
                                <label for="">Code : </label>
                                <input type="text" class="form-control" name="code" value="">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                <label for="">Type : </label>
                                <select class="form-control" name="discont_type" id="discountType">
                                    <option selected disabled>---Please Select---</option>
                                    <option value="fixed">Fixed</option>
                                    <option value="percentage">Percentage</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 mt-3">
                                <label for="">Discount Amount : </label>
                                <div class="input-group">
                                    <span class="input-group-text" id="discountSymbol">*</span>
                                    <input type="text" class="form-control" name="discount_value" id="discountValue">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 mt-3">
                                <label for="">Minimum Order Amount Value : </label>
                                <input type="text" class="form-control" name="min_order_amount">
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 mt-3">
                                <label for="">Start At : </label>
                                <input type="date" class="form-control" name="start_at" value="">
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 mt-3">
                                <label for="">Expire At : </label>
                                <input type="date" class="form-control" name="expire_at" value="">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                <div class="d-flex align-items-center">
                                    <label for="">Is Unlimited :</label>
                                    <label class="switch ms-2">
                                        <input type="checkbox" id="isUnlimited">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12 col-sm-12 mt-3 usage-fields">
                                <label for="">Usage Per Coupon :</label>
                                <input type="number" class="form-control" name="usage_limit" value="">
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 mt-3 usage-fields">
                                <label for="">Usage Per User</label>
                                <input type="number" class="form-control" name="per_user_limit" value="">
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


<script>
    $(document).ready(function() {
        $("#discountType").on("change", function() {
            let type = $(this).val();

            if (type === "fixed") {
                $("#discountSymbol").text("$");
            } else if (type === "percentage") {
                $("#discountSymbol").text("%");
            } else {
                $("#discountSymbol").text("💲");
            }
        });
    });

</script>

<script>
    $(document).ready(function() {
        $("#isUnlimited").on("change", function() {
            if ($(this).is(":checked")) {
                $(".usage-fields").hide(); // hide both fields
            } else {
                $(".usage-fields").show(); // show both fields
            }
        });
    });

</script>


@endsection
