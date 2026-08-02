<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'penerima' }} | Aplikasi Permintaan & Perbaikan Barang</title>
    <link rel="icon" href="{{ asset('gambar/rsmz.png') }}" type="image/png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: #f4f6f9;
        }
        .navbar {
            box-shadow: 0 2px 8px rgba(0,0,0,.08);
        }
        .app-title {
            font-size: 1rem;
            font-weight: 600;
            line-height: 1.2;
        }
        .app-subtitle {
            font-size: .75rem;
            opacity: .8;
        }
        .content-card {
            background: #fff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 8px 20px rgba(0,0,0,.05);
        }
        footer {
            background: #fff;
            border-top: 1px solid #e5e7eb;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">

        <!-- BRAND + LOGO -->
        <a class="navbar-brand d-flex align-items-center gap-3" href="{{ route('penerima.dashboard') }}">
            <img src="{{ asset('gambar/rsmz.png') }}"
                 alt="Logo RSMZ"
                 class="bg-white rounded-circle p-1 animate__animated animate__fadeInDown"
                 style="height:42px;">

            <div>
                <div class="app-title d-flex align-items-center gap-1">
                    Aplikasi Permintaan
                    <i class="bi bi-box-seam"></i>
                </div>
                <div class="app-subtitle d-flex align-items-center gap-1">
                    dan Perbaikan Barang
                    <i class="bi bi-tools text-warning"></i>
                </div>
            </div>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarPemohon">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarPemohon">

            <ul class="navbar-nav ms-4 me-auto">

                <!-- Permintaan Barang -->
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-1 {{ request()->is('penerima/permintaann*') ? 'active fw-semibold' : '' }}"
                       href="{{ route('penerima.permintaan') }}">
                        <i class="bi bi-box"></i>
                        Permintaan Barang
                    </a>
                </li>

                <!-- Laporan -->
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-1 {{ request()->is('penerima/laporann*') ? 'active fw-semibold' : '' }}"
                       href="{{ route('penerima.laporan') }}">
                        <i class="bi bi-clipboard-data"></i>
                        Laporan
                    </a>
                </li>

            </ul>

            <!-- USER -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                       href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle fs-5"></i>
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item text-danger d-flex align-items-center gap-2">
                                    <i class="bi bi-box-arrow-right"></i>
                                    Logout
                                </button>
                            </form>
                        </li>
                         @if(Auth::user()->role == 'atasan' && Auth::user()->role2 == 'penerima')
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a href="{{ route('multirole.dashboard') }}" 
                                    class="dropdown-item d-flex align-items-center gap-2">
                                        <i class="bi bi-speedometer2"></i>
                                        Dashboard Awal
                                    </a>
                                </li>
                            @endif
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</nav>

<!-- Content -->
<div class="container my-4">
    <div class="content-card">
        @yield('content')
    </div>
</div>

<!-- Footer -->
<footer class="text-center text-muted py-3">
    © 2026 RSMZ
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
