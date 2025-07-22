<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Links Of CSS File -->
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/simplebar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/apexcharts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/prism.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/rangeslider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/google-icon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fullcalendar.main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jsvectormap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/lightpick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/images/favicon.png">
    <!-- Title -->
    <title>VALIDASI RTP - Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body class="boxed-size bg-white">
    <!-- Start Preloader Area -->

    <!-- End Preloader Area -->

    <!-- Start Main Content Area -->
    <div class="container">
        <div class="main-content d-flex flex-column p-0">
            <div class="m-auto m-1230">
                <div class="row align-items-center">
                    <div class="col-lg-6 d-none d-lg-block">
                        <img src="assets/images/login.jpg" class="rounded-3" alt="login">
                    </div>
                    <div class="col-lg-6">
                        <div class="mw-480 ms-lg-auto">
                            <div class="d-inline-block mb-4">
                                {{-- <img src="assets/images/logo.svg" class="rounded-3 for-light-logo" alt="login">
                                    <img src="assets/images/white-logo.svg" class="rounded-3 for-dark-logo" alt="login"> --}}
                            </div>
                            <h3 class="fs-28 mb-2">Welcome back !</h3>
                            <p class="fw-medium fs-16 mb-4"> </p>
                            <div class="row justify-content-center">
                                <div class="col-lg-4 col-sm-4">
                                    {{-- <a href="https://www.google.com/" target="_blank" class="btn btn-outline-secondary bg-transparent w-100 py-2 hover-bg mb-4" style="border-color: #D6DAE1;">
                                            <img src="assets/images/google.svg" alt="google">
                                        </a> --}}
                                </div>
                                <div class="col-lg-4 col-sm-4">
                                    {{-- <a href="https://www.facebook.com/" target="_blank" class="btn btn-outline-secondary bg-transparent w-100 py-2 hover-bg mb-4" style="border-color: #D6DAE1;">
                                            <img src="assets/images/facebook2.svg" alt="facebook2">
                                        </a> --}}
                                </div>
                                <div class="col-lg-4 col-sm-4">
                                    {{-- <a href="https://www.apple.com/" target="_blank" class="btn btn-outline-secondary bg-transparent w-100 py-2 hover-bg mb-4" style="border-color: #D6DAE1;">
                                            <img src="assets/images/apple.svg" alt="apple">
                                        </a> --}}
                                </div>
                            </div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group mb-4">
                                    <label class="label text-secondary">Email/Username</label>
                                    <input type="text" class="form-control h-55" name="login"
                                        placeholder="Masukan Email Atau Username">
                                </div>
                                <div class="form-group mb-4">
                                    <label class="label text-secondary">Password</label>
                                    <div class="input-group mt-2">
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Masukan Password" id="password" required>
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <button class="btn btn-primary fw-medium py-2 px-3 w-100">
                                        <div class="d-flex align-items-center justify-content-center py-1">
                                            <i class="material-symbols-outlined text-white fs-20 me-2">login</i>
                                            <span>Login</span>
                                        </div>
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Link Of JS File -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('assets/js/dragdrop.js') }}"></script>
    <script src="{{ asset('assets/js/rangeslider.min.js') }}"></script>
    <script src="{{ asset('assets/js/quill.min.js') }}"></script>
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    <script src="{{ asset('assets/js/prism.js') }}"></script>
    <script src="{{ asset('assets/js/clipboard.min.js') }}"></script>
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/fullcalendar.main.js') }}"></script>
    <script src="{{ asset('assets/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/js/world-merc.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/lightpick.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/js/custom/echarts.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/custom/custom.js') }}"></script> --}}
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');

            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';

            // Ganti ikon
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>
