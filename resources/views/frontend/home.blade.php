@extends('layouts.frontend')

@section('title', 'Beranda')

@section('content')

<!-- Hero Section -->
<div class="bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h1 class="display-4 fw-bold mb-3">Pusat Penelitian dan Pengabdian kepada Masyarakat Politeknik Negeri Banjarmasin</h1>
                <p class="lead">Mendorong inovasi dan pengabdian untuk kemajuan masyarakat melalui penelitian berkualitas dan pengabdian yang berdampak.</p>
                <div class="mt-4">
                    <a href="{{ route('research.index') }}" class="btn btn-light btn-lg me-2">
                        <i class="bi bi-book me-2"></i>Produk Penelitian
                    </a>
                    <a href="{{ route('news.index') }}" class="btn btn-outline-light btn-lg">
                        <i class="bi bi-newspaper me-2"></i>Berita Terbaru
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <!-- Bootstrap Carousel -->
                <div id="heroCarousel" class="carousel slide shadow rounded" data-bs-ride="carousel">
                    <!-- Indicators -->
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>

                    <!-- Carousel Items -->
                    <div class="carousel-inner rounded">
                        <div class="carousel-item active">
                            <img src="{{ asset('storage/banner/5.jpg') }}" class="d-block w-100" alt="Penelitian Inovatif" style="height: 400px; object-fit: cover;">
                            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-2">
                                <h5>Penelitian Inovatif</h5>
                                <p>Menghasilkan penelitian berkualitas untuk kemajuan bangsa</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('storage/banner/4.jpg') }}" class="d-block w-100" alt="Pengabdian Masyarakat" style="height: 400px; object-fit: cover;">
                            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-2">
                                <h5>Pengabdian Masyarakat</h5>
                                <p>Memberikan dampak nyata kepada masyarakat</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('storage/banner/6.jpg') }}" class="d-block w-100" alt="Kolaborasi & Inovasi" style="height: 400px; object-fit: cover;">
                            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-2">
                                <h5>Kolaborasi & Inovasi</h5>
                                <p>Membangun kemitraan untuk solusi berkelanjutan</p>
                            </div>
                        </div>
                    </div>

                    <!-- Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Area dengan 2 Kolom -->
<div class="container my-5">
    <div class="row g-4">
        <!-- Kolom Kiri: Pengumuman dan Berita -->
        <div class="col-lg-8">
            <!-- Pengumuman Penting -->
            @if($announcements->count() > 0)
            <div class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="mb-0"><i class="bi bi-megaphone-fill text-warning me-2"></i>Pengumuman</h3>
                    <a href="{{ route('announcements.index') }}" class="btn btn-sm btn-outline-warning">Lihat Semua</a>
                </div>
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        @foreach($announcements as $announcement)
                        <div class="border-bottom pb-3 mb-3">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-bell-fill text-warning fs-4 me-3 mt-1"></i>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $announcement->title }}</h6>
                                    <p class="text-muted small mb-2">{{ Str::limit(strip_tags($announcement->content), 100) }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="bi bi-calendar me-1"></i>{{ $announcement->start_date->format('d M Y') }}
                                        </small>
                                        <a href="{{ route('announcements.show', $announcement->slug) }}" class="btn btn-sm btn-outline-primary">
                                            Detail <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Berita Terbaru -->
            <div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="mb-0"><i class="bi bi-newspaper text-primary me-2"></i>Berita Terbaru</h3>
                    <a href="{{ route('news.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                </div>

                <div class="row g-3">
                    @forelse($latest_news->take(4) as $news)
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            @if($news->image)
                            <img src="{{ Storage::url($news->image) }}" class="card-img-top" alt="{{ $news->title }}" style="height: 180px; object-fit: cover;">
                            @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 180px;">
                                <i class="bi bi-image text-secondary" style="font-size: 2.5rem;"></i>
                            </div>
                            @endif
                            <div class="card-body">
                                <span class="badge bg-primary mb-2">{{ $news->category->name }}</span>
                                <h6 class="card-title">{{ Str::limit($news->title, 50) }}</h6>
                                <p class="card-text text-muted small">{{ Str::limit(strip_tags($news->content), 80) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="bi bi-calendar me-1"></i>{{ $news->published_at->format('d M Y') }}
                                    </small>
                                    <a href="{{ route('news.show', $news->slug) }}" class="btn btn-sm btn-outline-primary">
                                        Baca <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">Belum ada berita tersedia</div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Produk Penelitian -->
        <div class="col-lg-4">
            <div class="position-sticky" style="top: 20px;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="mb-0"><i class="bi bi-book text-success me-2"></i>Produk Penelitian</h3>
                </div>

                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body">
                        @forelse($latest_research->take(5) as $research)
                        <div class="border-bottom pb-3 mb-3">
                            <div class="d-flex align-items-start">
                                @if($research->image)
                                <img src="{{ Storage::url($research->image) }}" class="rounded me-3" alt="{{ $research->title }}" style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; min-width: 60px;">
                                    <i class="bi bi-book text-secondary"></i>
                                </div>
                                @endif
                                <div class="flex-grow-1">
                                    <span class="badge bg-{{ $research->type === 'penelitian' ? 'primary' : 'success' }} badge-sm mb-1">
                                        {{ ucfirst($research->type) }}
                                    </span>
                                    <h6 class="mb-1 small">{{ Str::limit($research->title, 40) }}</h6>
                                    <p class="text-muted small mb-1">
                                        <i class="bi bi-person me-1"></i>{{ Str::limit($research->researcher, 25) }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="bi bi-calendar me-1"></i>{{ $research->year }}
                                        </small>
                                        <a href="{{ route('research.show', $research->slug) }}" class="btn btn-sm btn-outline-success btn-sm py-0 px-2">
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="alert alert-info text-center mb-0">Belum ada produk penelitian tersedia</div>
                        @endforelse
                    </div>
                </div>

                @if($latest_research->count() > 0)
                <a href="{{ route('research.index') }}" class="btn btn-success w-100">
                    Lihat Semua Produk <i class="bi bi-arrow-right"></i>
                </a>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Quick Links -->
<div class="container my-5">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm text-center p-4">
                <div class="mb-3">
                    <i class="bi bi-download text-primary" style="font-size: 3rem;"></i>
                </div>
                <h4>Download</h4>
                <p class="text-muted">Template, panduan, dan dokumen penting</p>
                <a href="{{ route('downloads.index') }}" class="btn btn-outline-primary">
                    Lihat File <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm text-center p-4">
                <div class="mb-3">
                    <i class="bi bi-bar-chart text-success" style="font-size: 3rem;"></i>
                </div>
                <h4>Statistik</h4>
                <p class="text-muted">Data dan grafik penelitian & pengabdian</p>
                <a href="{{ route('charts.index') }}" class="btn btn-outline-success">
                    Lihat Grafik <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm text-center p-4">
                <div class="mb-3">
                    <i class="bi bi-megaphone text-warning" style="font-size: 3rem;"></i>
                </div>
                <h4>Pengumuman</h4>
                <p class="text-muted">Informasi penting dan terkini</p>
                <a href="{{ route('announcements.index') }}" class="btn btn-outline-warning">
                    Lihat Pengumuman <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
