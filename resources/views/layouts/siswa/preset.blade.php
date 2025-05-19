<!DOCTYPE html>
<html data-theme="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="{{ csrf_token() }}" name="csrf-token">
    <title>SMASKARTIKATAMA | @yield('judul')</title>
    <!-- remix icon font css  -->
    <link href="{{ asset('assets/css/remixicon.css') }}" rel="stylesheet">
    <!-- BootStrap css -->
    <link href="{{ asset('assets/css/lib/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Date picker css -->
    <link href="{{ asset('assets/css/lib/flatpickr.min.css') }}" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link href="{{ asset('assets/css/lib/sweetalert2.min.css') }}" rel="stylesheet">
    <!-- main css -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    @stack('style')
</head>

<body>
    <aside class="sidebar">
        <button class="sidebar-close-btn" type="button">
            <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
        </button>
        <div>
            <a class="sidebar-logo" href="{{ route('home') }}">
                <img alt="site logo" class="light-logo" src="{{ asset('assets/images/logo-smas-kartikatama-metro.svg') }}">
                <img alt="site logo" class="dark-logo" src="assets/images/logo-smas-kartikatama-metro.svg">
                <img alt="site logo" class="logo-icon" src="assets/images/logo-smas-kartikatama-metro.svg">
            </a>
        </div>
        <div class="sidebar-menu-area">
            <ul class="sidebar-menu" id="sidebar-menu">
                <li @class(['active-page' => Route::is('siswa.dashboard')])>
                    <a @class(['active-page' => Route::is('siswa.dashboard')]) href="{{ route('siswa.dashboard') }}">
                        <iconify-icon class="menu-icon" icon="solar:home-smile-angle-outline"></iconify-icon>
                        <span>Dashboard</span>
                    </a>
                </li>
                @if ($ProSis->step_1 != 1 && $ProSis?->step_2 != 1)
                    <li @class(['active-page' => Route::is('siswa.edit')])>
                        <a @class(['active-page' => Route::is('siswa.edit')]) href="{{ route('siswa.edit', auth()->user()->id) }}">
                            <iconify-icon icon="lucide:edit"></iconify-icon>
                            <span>Ubah Data Diri</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </aside>
    <main class="dashboard-main">
        <div class="navbar-header">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto">
                    <div class="d-flex align-items-center flex-wrap gap-4">
                        <button class="sidebar-toggle" type="button">
                            <iconify-icon class="icon non-active text-2xl" icon="heroicons:bars-3-solid"></iconify-icon>
                            <iconify-icon class="icon active text-2xl" icon="iconoir:arrow-right"></iconify-icon>
                        </button>
                        <button class="sidebar-mobile-toggle" type="button">
                            <iconify-icon class="icon" icon="heroicons:bars-3-solid"></iconify-icon>
                        </button>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="d-flex align-items-center flex-wrap gap-3">
                        <!-- Profile dropdown end -->
                        <div class="dropdown">
                            <button class="d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="dropdown" type="button">
                                <img alt="image" class="w-40-px h-40-px object-fit-cover rounded-circle" src="{{ asset('assets/images/logosmaskartikatamametro.png') }}">
                            </button>
                            <div class="dropdown-menu to-top dropdown-menu-sm">
                                <div class="radius-8 bg-primary-50 d-flex align-items-center justify-content-between mb-16 gap-2 px-16 py-12">
                                    <div>
                                        <h6 class="text-primary-light fw-semibold mb-2 text-lg">{{ auth()->user()->nama }}</h6>
                                    </div>
                                    <button class="hover-text-danger" type="button">
                                        <iconify-icon class="icon text-xl" icon="radix-icons:cross-1"></iconify-icon>
                                    </button>
                                </div>
                                <ul class="to-top-list">
                                    <li>
                                        <a class="dropdown-item hover-bg-transparent hover-text-danger d-flex align-items-center gap-3 px-0 py-8 text-black" href="{{ route('logout') }}" id="logout">
                                            <iconify-icon class="icon text-xl" icon="lucide:power"></iconify-icon> Log Out
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-main-body">
            @yield('konten')
        </div>
        <footer class="d-footer">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto">
                    <p class="mb-0">© 2024 HakimDev. All Rights Reserved.</p>
                </div>
                <div class="col-auto">
                    <p class="mb-0">Made by <span class="text-primary-600">🩷</span></p>
                </div>
            </div>
        </footer>
    </main>
    <!-- jQuery library js -->
    <script src="{{ asset('assets/js/lib/jquery-3.7.1.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('assets/js/lib/bootstrap.bundle.min.js') }}"></script>
    <!-- Iconify Font js -->
    <script src="{{ asset('assets/js/lib/iconify-icon.min.js') }}"></script>
    <!-- jQuery UI js -->
    <script src="{{ asset('assets/js/lib/jquery-ui.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('assets/js/lib/sweetalert2.all.min.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <!-- alert -->
    <script>
        const Swal2 = Swal.mixin({
            customClass: {
                title: 'text-lg',
                htmlContainer: 'text-md'
            },
        })
    </script>
    <!-- logout action -->
    <script>
        $(document).ready(function() {
            $('#logout').on('click', function() {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('logout') }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.status === "redirect") {
                            window.location.href = data.url;
                        }
                    }
                });
            });
        });
    </script>
    @stack('script')
</body>
