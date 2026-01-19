@extends('layouts.frontend')

@section('title', $announcement->title)

@section('content')

<!-- Page Header -->
<div class="bg-light py-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('announcements.index') }}">Pengumuman</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($announcement->title, 50) }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <article class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <!-- Important Badge -->
                    @if($announcement->is_important)
                    <div class="mb-3">
                        <span class="badge bg-warning text-dark">
                            <i class="bi bi-star-fill"></i> Pengumuman Penting
                        </span>
                    </div>
                    @endif

                    <!-- Title -->
                    <h1 class="h2 fw-bold mb-3">{{ $announcement->title }}</h1>

                    <!-- Meta Info -->
                    <div class="d-flex align-items-center text-muted mb-4 pb-3 border-bottom">
                        <div class="me-4">
                            <i class="bi bi-person-circle me-1"></i>
                            {{ $announcement->author ? $announcement->author->name : 'Admin' }}
                        </div>
                        <div class="me-4">
                            <i class="bi bi-calendar-event me-1"></i>
                            {{ $announcement->start_date->format('d M Y') }}
                        </div>
                        <div>
                            <i class="bi bi-calendar-check me-1"></i>
                            Berlaku s/d {{ $announcement->end_date->format('d M Y') }}
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="announcement-content">
                        {!! nl2br(e($announcement->content)) !!}
                    </div>

                    <!-- PDF Download -->
                    @if($announcement->file_pdf)
                    <div class="mt-4 pt-4 border-top">
                        <div class="alert alert-info d-flex align-items-center" role="alert">
                            <i class="bi bi-file-pdf-fill fs-1 me-3 text-danger"></i>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Dokumen Terlampir</h6>
                                <p class="mb-2 small">File PDF tersedia untuk diunduh</p>
                                <a href="{{ asset('storage/' . $announcement->file_pdf) }}"
                                   target="_blank"
                                   class="btn btn-danger btn-sm">
                                    <i class="bi bi-download me-1"></i> Download PDF
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Status Badge -->
                    <div class="mt-4 pt-4 border-top">
                        @php
                            $now = now();
                            if ($now->lt($announcement->start_date)) {
                                $status = 'Terjadwal';
                                $statusClass = 'info';
                            } elseif ($now->between($announcement->start_date, $announcement->end_date)) {
                                $status = 'Aktif';
                                $statusClass = 'success';
                            } else {
                                $status = 'Berakhir';
                                $statusClass = 'secondary';
                            }
                        @endphp
                        <span class="badge bg-{{ $statusClass }}">Status: {{ $status }}</span>
                    </div>

                    <!-- Share Buttons -->
                    <div class="mt-4 pt-4 border-top">
                        <h6 class="text-muted mb-3">Bagikan:</h6>
                        <div class="d-flex gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('announcements.show', $announcement->id)) }}"
                               target="_blank" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-facebook"></i> Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('announcements.show', $announcement->id)) }}&text={{ urlencode($announcement->title) }}"
                               target="_blank" class="btn btn-outline-info btn-sm">
                                <i class="bi bi-twitter"></i> Twitter
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($announcement->title . ' ' . route('announcements.show', $announcement->id)) }}"
                               target="_blank" class="btn btn-outline-success btn-sm">
                                <i class="bi bi-whatsapp"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </article>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Related Announcements -->
            @if($relatedAnnouncements->count() > 0)
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="bi bi-megaphone-fill text-primary me-2"></i>Pengumuman Lainnya
                    </h5>
                    @foreach($relatedAnnouncements as $related)
                    <div class="mb-3 pb-3 border-bottom">
                        <h6 class="mb-1">
                            <a href="{{ route('announcements.show', $related->id) }}" class="text-decoration-none text-dark">
                                {{ Str::limit($related->title, 60) }}
                            </a>
                        </h6>
                        <small class="text-muted">
                            <i class="bi bi-calendar me-1"></i>
                            {{ $related->start_date->format('d M Y') }}
                        </small>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Back Button -->
            <div class="d-grid">
                <a href="{{ route('announcements.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar Pengumuman
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.announcement-content {
    font-size: 1.05rem;
    line-height: 1.8;
    color: #333;
}
</style>

@endsection
