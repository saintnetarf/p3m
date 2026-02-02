@extends('layouts.frontend')

@section('title', $product->title)

@section('content')

<!-- Product Header -->
<div class="bg-light py-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('research.index') }}">Produk Penelitian</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($product->title, 50) }}</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Product Detail -->
<div class="container my-5">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                @if($product->image)
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center p-3" style="min-height: 300px;">
                        <img src="{{ Storage::url($product->image) }}" class="img-fluid rounded" alt="{{ $product->title }}" style="max-height: 500px; width: 100%; object-fit: contain;">
                    </div>
                @endif
                <div class="card-body p-4">
                    <div class="mb-3">
                        @if($product->category == 'Penelitian')
                            <span class="badge bg-primary fs-6">{{ $product->category }}</span>
                        @elseif($product->category == 'Pengabdian Masyarakat')
                            <span class="badge bg-success fs-6">{{ $product->category }}</span>
                        @else
                            <span class="badge bg-info fs-6">{{ $product->category }}</span>
                        @endif
                        @if($product->is_featured)
                            <span class="badge bg-warning text-dark fs-6"><i class="bi bi-star-fill"></i> Unggulan</span>
                        @endif
                    </div>

                    <h5 class="mb-4">{{ $product->title }}</h5>

                    <div class="mb-4">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-person-circle fs-4 text-primary me-2"></i>
                                    <div>
                                        <small class="text-muted d-block">Peneliti</small>
                                        <strong>{{ $product->researcher }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-calendar-event fs-4 text-primary me-2"></i>
                                    <div>
                                        <small class="text-muted d-block">Tahun</small>
                                        <strong>{{ $product->year }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="mt-4">
                        <h4 class="mb-3">Deskripsi</h4>
                        <div class="text-justify" style="white-space: pre-line;">{{ $product->description }}</div>
                    </div>

                    @if($product->file)
                    <div class="mt-4">
                        <hr>
                        <div class="d-grid gap-2">
                            <a href="{{ Storage::url($product->file) }}" target="_blank" class="btn btn-primary btn-lg">
                                <i class="bi bi-download me-2"></i>Download Dokumen Lengkap
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Info Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Informasi</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3">
                            <small class="text-muted d-block">Dipublikasikan oleh</small>
                            <strong>{{ $product->author->name }}</strong>
                        </li>
                        <li class="mb-3">
                            <small class="text-muted d-block">Tanggal Publikasi</small>
                            <strong>{{ $product->created_at->format('d M Y') }}</strong>
                        </li>
                        @if($product->file)
                        <li class="mb-3">
                            <small class="text-muted d-block">Dokumen</small>
                            <i class="bi bi-file-earmark-pdf text-danger"></i>
                            <strong class="ms-1">Tersedia</strong>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>

            <!-- Share Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="bi bi-share me-2"></i>Bagikan</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="btn btn-outline-primary">
                            <i class="bi bi-facebook me-2"></i>Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($product->title) }}" target="_blank" class="btn btn-outline-info">
                            <i class="bi bi-twitter me-2"></i>Twitter
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($product->title . ' ' . url()->current()) }}" target="_blank" class="btn btn-outline-success">
                            <i class="bi bi-whatsapp me-2"></i>WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
