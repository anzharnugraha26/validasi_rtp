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

    @yield('style')

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/images/favicon.png">
    <!-- Title -->
    <title>VALIDASI RTP - @yield('pages_name')</title>
</head>

<body class="boxed-size" data-theme="light" sidebar-dark-light-data-theme="sidebar-dark"
    header-dark-light-data-theme="light" footer-dark-light-data-theme="light" card-radius-square-data-theme="light"
    card-bg-data-theme="light">

    <div class="sidebar-area" id="sidebar-area">
        <div class="logo position-relative">
            <a href="index.html" class="d-block text-decoration-none position-relative" style="text-decoration: none">
                <span class="logo-text fw-bold text-dark" style="font-size: 20px">VALIDASI DATA</span>
            </a>
            <button
                class="sidebar-burger-menu bg-transparent p-0 border-0 opacity-0 z-n1 position-absolute top-50 end-0 translate-middle-y"
                id="sidebar-burger-menu">
                <i data-feather="x"></i>
            </button>
        </div>

        <aside id="layout-menu" class="layout-menu menu-vertical menu active mt-5" data-simplebar>
            <ul class="menu-inner">
                {{-- <li class="menu-title small text-uppercase">
                    <span class="menu-title-text">MAIN</span>
                </li> --}}

                <li class="menu-item {{ request()->is('/') ? 'open' : '' }}">
                    <a href="{{ url('/') }}" class="menu-link {{ request()->is('/') ? 'active' : '' }}">
                        <span class="material-symbols-outlined menu-icon">fact_check</span>
                        <span class="title">Validasi Data</span>
                    </a>
                </li>
                @if (Auth::user()->role == 1)
                    <li class="menu-item {{ request()->is('history') ? 'open' : '' }}">
                        <a href="{{ url('history') }}" class="menu-link {{ request()->is('history') ? 'active' : '' }}">
                            <span class="material-symbols-outlined menu-icon">event_repeat</span>
                            <span class="title">Histori</span>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('user_account*') ? 'open' : '' }}">
                        <a href="{{ url('user_account') }}"
                            class="menu-link {{ request()->is('user_account*') ? 'active' : '' }}">
                            <span class="material-symbols-outlined menu-icon">person</span>
                            <span class="title">User Account</span>
                        </a>
                    </li>
                @endif


            </ul>
        </aside>
    </div>
    <!-- End Sidebar Area -->

    <!-- Start Main Content Area -->
    <div class="container-fluid">
        <div class="main-content d-flex flex-column">
            <!-- Start Header Area -->
            <header class="header-area bg-white mb-4 rounded-bottom-15" id="header-area">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-sm-6">
                        <div class="left-header-content">
                            <ul
                                class="d-flex align-items-center ps-0 mb-0 list-unstyled justify-content-center justify-content-sm-start">
                                <li>
                                    <button class="header-burger-menu bg-transparent p-0 border-0"
                                        id="header-burger-menu">
                                        <span class="material-symbols-outlined">menu</span>
                                    </button>
                                </li>

                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-8 col-sm-6">
                        <div class="right-header-content mt-2 mt-sm-0">
                            <ul
                                class="d-flex align-items-center justify-content-center justify-content-sm-end ps-0 mb-0 list-unstyled">
                                <li class="header-right-item">
                                    <div class="light-dark">
                                        <button class="switch-toggle settings-btn dark-btn p-0 bg-transparent border-0"
                                            id="switch-toggle">
                                            <span class="dark"><i
                                                    class="material-symbols-outlined">light_mode</i></span>
                                            <span class="light"><i
                                                    class="material-symbols-outlined">dark_mode</i></span>
                                        </button>
                                    </div>
                                </li>

                                <li class="header-right-item">
                                    <div class="dropdown admin-profile">
                                        <div class="d-xxl-flex align-items-center bg-transparent border-0 text-start p-0 cursor dropdown-toggle"
                                            data-bs-toggle="dropdown">
                                            <div class="flex-shrink-0">
                                                <i class="material-symbols-outlined">account_circle</i>
                                            </div>
                                            <div class="flex-grow-1 ms-2">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-none d-xxl-block">
                                                        <div class="d-flex align-content-center">
                                                            <h3>{{ Auth::user()->name }}</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="dropdown-menu border-0 bg-white dropdown-menu-end">
                                            <div class="d-flex align-items-center info">
                                                <div class="flex-shrink-0">
                                                    <i class="material-symbols-outlined">account_circle</i>
                                                </div>
                                                <div class="flex-grow-1 ms-2">
                                                    <h3 class="fw-medium">{{ Auth::user()->name }}</h3>

                                                </div>
                                            </div>

                                            <ul class="admin-link ps-0 mb-0 list-unstyled">

                                                <li>
                                                    <a class="dropdown-item admin-item-link d-flex align-items-center text-body"
                                                        href="{{ route('logout') }}"
                                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                        <i class="material-symbols-outlined">logout</i>
                                                        <span class="ms-2">Logout</span>
                                                    </a>
                                                    <form id="logout-form" action="{{ route('logout') }}"
                                                        method="POST" class="d-none">
                                                        @csrf
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </header>
            <!-- End Header Area -->

            @yield('content')

            <div class="flex-grow-1"></div>

            <!-- Start Footer Area -->
            <footer class="footer-area bg-white text-center rounded-top-7">
                <p class="fs-14">© SIMGROUP</a></p>
            </footer>
            <!-- End Footer Area -->
        </div>
    </div>
    <!-- Start Main Content Area -->

    <!-- Start Create From Area -->

    <!-- End Theme Setting Area -->

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
    <script src="{{ asset('assets/js/custom/custom.js') }}"></script>
    @yield('script')
</body>

</html>
