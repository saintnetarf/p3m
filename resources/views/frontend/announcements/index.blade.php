@extends('layouts.frontend')

@section('title', 'Pengumuman')

@section('content')

<!-- Page Header -->
<div class="bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-5 fw-bold mb-3">Pengumuman</h1>
                <p class="lead">Informasi penting dan pengumuman terbaru</p>

                <!-- Search Form -->
                <div class="mt-4">
                    <form action="{{ route('announcements.index') }}" method="GET" class="d-flex justify-content-center">
                        <div class="input-group" style="max-width: 500px;">
                            <input type="text" class="form-control form-control-lg" name="search"
                                   placeholder="Cari pengumuman..." value="{{ request('search') }}">
                            <button class="btn btn-light" type="submit">
                                <i class="bi bi-search"></i> Cari
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <!-- Important Announcements -->
    @if($importantAnnouncements->count() > 0)
    <div class="mb-5">
        <h4 class="mb-4">
            <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>
            Pengumuman Penting
        </h4>
        <div class="row g-3">
            @foreach($importantAnnouncements as $announcement)
            <div class="col-md-4">
                <div class="card border-warning border-2 h-100 shadow-sm hover-lift">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <span class="badge bg-warning text-dark">
                                <i class="bi bi-star-fill"></i> Penting
                            </span>
                            <small class="text-muted ms-auto">
                                {{ $announcement->start_date->format('d M Y') }}
                            </small>
                        </div>
                        <h5 class="card-title">
                            <a href="{{ route('announcements.show', $announcement->id) }}" class="text-decoration-none text-dark">
                                {{ $announcement->title }}
                            </a>
                        </h5>
                        <p class="card-text">{{ Str::limit(strip_tags($announcement->content), 100) }}</p>
                        <a href="{{ route('announcements.show', $announcement->id) }}" class="btn btn-outline-warning btn-sm">
                            Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- All Announcements -->
    <div class="row">
        <div class="col-12">
            <h4 class="mb-4">Semua Pengumuman</h4>

            @forelse($announcements as $announcement)
            <div class="card mb-3 border-0 shadow-sm hover-lift">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="d-flex align-items-center mb-2">
                                @if($announcement->is_important)
                                    <span class="badge bg-warning text-dark me-2">
                                        <i class="bi bi-star-fill"></i> Penting
                                    </span>
                                @endif
                                <small class="text-muted">
                                    <i class="bi bi-calendar me-1"></i>
                                    {{ $announcement->start_date->format('d M Y')  }}
                                    {{-- {{ $announcement->start_date->format('d M Y') }} - {{ $announcement->end_date->format('d M Y') }} --}}
                                </small>
                                <small class="text-muted ms-3">
                                    <i class="bi bi-person me-1"></i>
                                    {{ $announcement->author ? $announcement->author->name : 'Admin' }}
                                </small>
                            </div>
                            <h5 class="card-title mb-2">
                                <a href="{{ route('announcements.show', $announcement->id) }}" class="text-decoration-none text-dark">
                                    {{ $announcement->title }}
                                </a>
                            </h5>
                            <p class="card-text text-muted mb-3">
                                {{ Str::limit(strip_tags($announcement->content), 200) }}
                            </p>
                            <a href="{{ route('announcements.show', $announcement->id) }}" class="btn btn-outline-primary btn-sm">
                                Selengkapnya <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                        <div class="col-md-3 d-flex align-items-center justify-content-center">
                            <div class="text-center">
                                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center"
                                     style="width: 80px; height: 80px;">
                                    <i class="bi bi-megaphone text-primary" style="font-size: 2rem;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="alert alert-info text-center py-5">
                <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                <p class="mt-3 mb-0">Tidak ada pengumuman aktif saat ini</p>
            </div>
            @endforelse

            @if($announcements->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $announcements->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<style>
.hover-lift {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-3px);
    box-shadow: 0 0.5rem 1.5rem rgba(0,0,0,0.15) !important;
}
</style>

@endsection
