<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Beranda') - {{ $header->institution_name ?? 'PPM' }}</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    @stack('styles')

    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
        }

        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .footer {
            background: #343a40;
            color: white;
            padding: 3rem 0 1rem;
        }

        .footer a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
        }

        .footer a:hover {
            color: white;
        }

        .card {
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .btn-primary {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        .page-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #0a58ca 100%);
            color: white;
            padding: 3rem 0;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                @if(isset($header) && $header->logo)
                    <img src="{{ Storage::url($header->logo) }}" alt="Logo" height="40">
                @else
                    <i class="bi bi-mortarboard-fill text-primary"></i>
                @endif
                <span class="ms-2">P3M Politeknik Negeri Banjarmasin</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="bi bi-house-fill me-1"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                            <i class="bi bi-building me-1"></i> Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('news.*') ? 'active' : '' }}" href="{{ route('news.index') }}">
                            <i class="bi bi-newspaper me-1"></i> Berita
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('research.*') ? 'active' : '' }}" href="{{ route('research.index') }}">
                            <i class="bi bi-book me-1"></i> Produk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('announcements.*') ? 'active' : '' }}" href="{{ route('announcements.index') }}">
                            <i class="bi bi-megaphone me-1"></i> Pengumuman
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('downloads.*') ? 'active' : '' }}" href="{{ route('downloads.index') }}">
                            <i class="bi bi-download me-1"></i> Download
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('charts.*') ? 'active' : '' }}" href="{{ route('charts.index') }}">
                            <i class="bi bi-bar-chart me-1"></i> Grafik
                        </a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-speedometer2 me-1"></i> Admin
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')

    <!-- Quick Links Section -->
    <section class="bg-light py-5 mt-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 text-center mb-4 mb-lg-0">
                    @if(isset($header) && $header->logo)
                        <img src="{{ Storage::url($header->logo) }}" alt="Logo Poliban" class="img-fluid" style="max-height: 120px;">
                    @else
                        <i class="bi bi-mortarboard-fill text-primary" style="font-size: 5rem;"></i>
                    @endif
                    <h5 class="mt-3 fw-bold text-primary">Politeknik Negeri Banjarmasin</h5>
                </div>
                <div class="col-lg-9">
                    <h4 class="mb-4 text-center text-lg-start"><i class="bi bi-link-45deg me-2"></i>Link Cepat</h4>
                    <div class="row g-3">
                        <div class="col-6 col-md-3">
                            <a href="https://ejurnal.poliban.ac.id" target="_blank" class="btn btn-outline-primary w-100 d-flex flex-column align-items-center py-3">
                                <i class="bi bi-journal-text fs-2 mb-2"></i>
                                <span class="fw-semibold">E-Jurnal</span>
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="https://eltikom.poliban.ac.id" target="_blank" class="btn btn-outline-success w-100 d-flex flex-column align-items-center py-3">
                                <i class="bi bi-newspaper fs-2 mb-2"></i>
                                <span class="fw-semibold">Eltikom</span>
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="https://sipma.poliban.ac.id" target="_blank" class="btn btn-outline-warning w-100 d-flex flex-column align-items-center py-3">
                                <i class="bi bi-globe fs-2 mb-2"></i>
                                <span class="fw-semibold">SIPMA</span>
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="https://press.poliban.ac.id" target="_blank" class="btn btn-outline-danger w-100 d-flex flex-column align-items-center py-3">
                                <i class="bi bi-book fs-2 mb-2"></i>
                                <span class="fw-semibold">Press</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h3 class="mb-2"><i class="bi bi-geo-alt-fill text-danger me-2"></i>Lokasi Kami</h3>
                    <p class="text-muted">Politeknik Negeri Banjarmasin</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="ratio ratio-16x9 shadow-sm rounded overflow-hidden">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4455.189788534254!2d114.57935537547168!3d-3.295688541125092!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de423a80d47ba6b%3A0x8f5abfaddfe5a2d7!2sPoliteknik%20Negeri%20Banjarmasin!5e1!3m2!1sid!2sid!4v1767755033740!5m2!1sid!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="mt-3 text-center">
                        <a href="https://maps.app.goo.gl/wBmcBdU1c3b3vj2e8" target="_blank" class="btn btn-outline-primary">
                            <i class="bi bi-map me-2"></i>Buka di Google Maps
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer mt-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5 class="mb-3">{{ $header->institution_name ?? 'Pusat Penelitian dan Pengabdian kepada Masyarakat Politeknik Negeri Banjarmasin' }}</h5>
                    <p class="text-muted">Mendorong inovasi dan pengabdian untuk kemajuan masyarakat melalui penelitian berkualitas.</p>
                </div>

                <div class="col-lg-4 mb-4">
                    <h5 class="mb-3">Navigasi</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('news.index') }}">Berita</a></li>
                        <li><a href="{{ route('research.index') }}">Produk Penelitian</a></li>
                        <li><a href="{{ route('announcements.index') }}">Pengumuman</a></li>
                        <li><a href="{{ route('downloads.index') }}">Download</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 mb-4">
                    <h5 class="mb-3">Kontak</h5>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-envelope me-2"></i> p3m@poliban.ac.id</li>
                        <li><i class="bi bi-telephone me-2"></i> +62 812-3353-2625</li>
                        <li><i class="bi bi-geo-alt me-2"></i> Banjarmasin, Indonesia</li>
                    </ul>

                    <div class="mt-3">
                        <a href="#" class="text-white me-3"><i class="bi bi-facebook fs-5"></i></a>
                        <a href="#" class="text-white me-3"><i class="bi bi-twitter fs-5"></i></a>
                        <a href="#" class="text-white me-3"><i class="bi bi-instagram fs-5"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-youtube fs-5"></i></a>
                    </div>
                </div>
            </div>

            <hr class="border-secondary">

            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-0 text-muted">&copy; {{ date('Y') }} {{ $header->institution_name ?? 'PPM' }}. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
