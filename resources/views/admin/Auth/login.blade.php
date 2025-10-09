<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/images/LogoIcon.png') }}" type="image/png" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../../../cdn.jsdelivr.net/npm/bootstrap-icons%401.5.0/font/bootstrap-icons.css">

    <!-- loader-->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />

    <title>{{ env('APP_NAME') }}</title>
</head>

<style>
    .bg-login {
        background: #fff !important;
    }

</style>

<body>
    <div class="wrapper">
        <main class="authentication-content" style="height: 100vh;">
            <div class="row g-0" style="height: 100%; overflow: hidden;">
                <div class="col-lg-8 bg-login d-flex align-items-center justify-content-center">
                    <img src="{{ asset('assets/images/error/LoginBG.jpg') }}" class="img-fluid w-100 h-100" alt="">
                </div>
                <div class="col-lg-4">
                    <div class="card-body p-4 p-sm-5 d-flex flex-column justify-content-center align-items-center " style="height: 100%;background: linear-gradient(332.9deg, #00A6EC 16.93%, #0000BA 77.18%);">
                        <div class="LoginImg mb-5" style="width: 230px;">
                            <img src="{{ asset('assets\images\CompleteLogo.png') }}" alt="logo" class="w-100">
                        </div>
                        <h2 class="card-title" style="color: #fff;">Login</h2>
                        <form class="form-body" action="{{ route('login') }}" method="post">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            @csrf
                            <div class="login-separater text-center mb-4">
                                <hr>
                            </div>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="inputEmailAddress" class="form-label " style="color: #fff;">Email Address</label>
                                    <div class="ms-auto position-relative">
                                        <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="fa-solid fa-envelope" style="color: #2c54a3;"></i></div>
                                        <input type="email" class="form-control radius-30 ps-3" id="inputEmailAddress" placeholder="Email Address" name="email">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="inputChoosePassword" class="form-label " style="color: #fff;">Password</label>
                                    <div class="ms-auto position-relative">
                                        <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="fa-solid fa-lock" style="color: #2c54a3;"></i></div>
                                        <input type="password" class="form-control radius-30 ps-3" id="inputChoosePassword" placeholder="Enter Password" name="password">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                        <label class="form-check-label " style="color: #fff;" for="flexSwitchCheckChecked">I Agree to the Trems & Conditions</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary radius-30 ">Sign in</button>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <p class="mb-0">Already have an account? <a href="authentication-signin.html " style="color: #fff;">Sign up here</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>


    <!--plugins-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>


</body>
</html>
