<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Admin PPM</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    @stack('styles')

    <style>
        :root {
            --sidebar-width: 250px;
        }

        body {
            min-height: 100vh;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: #343a40;
            color: white;
            overflow-y: auto;
            transition: all 0.3s;
            z-index: 1000;
        }

        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 0.75rem 1rem;
            border-radius: 0.25rem;
            margin: 0.25rem 0.5rem;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: white;
            background: rgba(255,255,255,0.1);
        }

        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        .navbar {
            background: white !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        @media (max-width: 768px) {
            .sidebar {
                margin-left: calc(-1 * var(--sidebar-width));
            }

            .sidebar.show {
                margin-left: 0;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="p-3">
            <h4 class="mb-0">P3M Admin</h4>
            <small class="text-warning">Sistem Manajemen</small>
        </div>

        <nav class="nav flex-column">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>

            <div class="px-3 mt-3 mb-2">
                <small class="text-success text-uppercase">Konten</small>
            </div>

            <a class="nav-link {{ request()->routeIs('admin.headers.*') ? 'active' : '' }}" href="{{ route('admin.headers.index') }}">
                <i class="bi bi-layout-text-window me-2"></i> Header
            </a>

            <a class="nav-link {{ request()->routeIs('admin.news-categories.*') ? 'active' : '' }}" href="{{ route('admin.news-categories.index') }}">
                <i class="bi bi-tags me-2"></i> Kategori Berita
            </a>

            <a class="nav-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }}" href="{{ route('admin.news.index') }}">
                <i class="bi bi-newspaper me-2"></i> Berita
            </a>

            <a class="nav-link {{ request()->routeIs('admin.research-products.*') ? 'active' : '' }}" href="{{ route('admin.research-products.index') }}">
                <i class="bi bi-book me-2"></i> Produk Penelitian
            </a>

            <a class="nav-link {{ request()->routeIs('admin.announcements.*') ? 'active' : '' }}" href="{{ route('admin.announcements.index') }}">
                <i class="bi bi-megaphone me-2"></i> Pengumuman
            </a>

            <div class="px-3 mt-3 mb-2">
                <small class="text-success text-uppercase">Download</small>
            </div>

            <a class="nav-link {{ request()->routeIs('admin.download-categories.*') ? 'active' : '' }}" href="{{ route('admin.download-categories.index') }}">
                <i class="bi bi-folder me-2"></i> Kategori Download
            </a>

            <a class="nav-link {{ request()->routeIs('admin.downloads.*') ? 'active' : '' }}" href="{{ route('admin.downloads.index') }}">
                <i class="bi bi-download me-2"></i> File Download
            </a>

            <a class="nav-link {{ request()->routeIs('admin.pengukuran-tkt.*') ? 'active' : '' }}" href="{{ route('admin.pengukuran-tkt.index') }}">
                <i class="bi bi-graph-up me-2"></i> Pengukuran TKT
            </a>

            <div class="px-3 mt-3 mb-2">
                <small class="text-success text-uppercase">Statistik</small>
            </div>

            <a class="nav-link {{ request()->routeIs('admin.research-statistics.*') ? 'active' : '' }}" href="{{ route('admin.research-statistics.index') }}">
                <i class="bi bi-bar-chart me-2"></i> Data Penelitian
            </a>

            <a class="nav-link {{ request()->routeIs('admin.service-statistics.*') ? 'active' : '' }}" href="{{ route('admin.service-statistics.index') }}">
                <i class="bi bi-pie-chart me-2"></i> Data Pengabdian
            </a>

            <a class="nav-link {{ request()->routeIs('admin.publication-statistics.*') ? 'active' : '' }}" href="{{ route('admin.publication-statistics.index') }}">
                <i class="bi bi-file-text me-2"></i> Data Publikasi
            </a>

            <a class="nav-link {{ request()->routeIs('admin.proseding-statistics.*') ? 'active' : '' }}" href="{{ route('admin.proseding-statistics.index') }}">
                <i class="bi bi-journal-text me-2"></i> Data Proseding
            </a>

            <a class="nav-link {{ request()->routeIs('admin.book-statistics.*') ? 'active' : '' }}" href="{{ route('admin.book-statistics.index') }}">
                <i class="bi bi-book me-2"></i> Data Buku
            </a>

            <a class="nav-link {{ request()->routeIs('admin.hak-cipta-statistics.*') ? 'active' : '' }}" href="{{ route('admin.hak-cipta-statistics.index') }}">
                <i class="bi bi-shield-check me-2"></i> Data Hak Cipta
            </a>

            @if(auth()->user()->isAdmin())
            <div class="px-3 mt-3 mb-2">
                <small class="text-success text-uppercase">Sistem</small>
            </div>

            <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                <i class="bi bi-people me-2"></i> Manajemen User
            </a>
            @endif
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light sticky-top">
            <div class="container-fluid">
                <button class="btn btn-link d-md-none" id="sidebarToggle">
                    <i class="bi bi-list fs-4"></i>
                </button>

                <a class="navbar-brand" href="{{ route('home') }}" target="_blank">
                    <i class="bi bi-box-arrow-up-right"></i> Lihat Website
                </a>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="bi bi-person me-2"></i> Profile
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="container-fluid p-4">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Toggle sidebar on mobile
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });
    </script>

    @stack('scripts')
</body>
</html>
