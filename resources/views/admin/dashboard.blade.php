@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="mb-0">Dashboard</h2>
        <p class="text-muted">Selamat datang, {{ auth()->user()->name }}</p>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Total Berita</h6>
                        <h3 class="mb-0">{{ $statistics['total_news'] }}</h3>
                        <small class="text-success">{{ $statistics['published_news'] }} Published</small>
                    </div>
                    <div class="bg-primary text-white rounded p-3">
                        <i class="bi bi-newspaper fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-success">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Produk Penelitian</h6>
                        <h3 class="mb-0">{{ $statistics['total_research'] }}</h3>
                        <small class="text-muted">Total produk</small>
                    </div>
                    <div class="bg-success text-white rounded p-3">
                        <i class="bi bi-book fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-warning">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Pengumuman</h6>
                        <h3 class="mb-0">{{ $statistics['total_announcements'] }}</h3>
                        <small class="text-warning">{{ $statistics['active_announcements'] }} Aktif</small>
                    </div>
                    <div class="bg-warning text-white rounded p-3">
                        <i class="bi bi-megaphone fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-info">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">File Download</h6>
                        <h3 class="mb-0">{{ $statistics['total_downloads'] }}</h3>
                        <small class="text-muted">Total file</small>
                    </div>
                    <div class="bg-info text-white rounded p-3">
                        <i class="bi bi-download fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <div class="card-header bg-white">
                <h5 class="mb-0">Berita Terbaru</h5>
            </div>
            <div class="card-body">
                @forelse($recent_news as $news)
                <div class="d-flex mb-3 pb-3 border-bottom">
                    @if($news->image)
                    <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}" class="rounded me-3" style="width: 80px; height: 80px; object-fit: cover;">
                    @else
                    <div class="bg-secondary rounded me-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="bi bi-image text-white fs-3"></i>
                    </div>
                    @endif
                    <div class="flex-grow-1">
                        <h6 class="mb-1">{{ Str::limit($news->title, 50) }}</h6>
                        <small class="text-muted">
                            <i class="bi bi-person me-1"></i>{{ $news->author->name }}
                            <i class="bi bi-calendar ms-2 me-1"></i>{{ $news->created_at->format('d M Y') }}
                        </small>
                        <div class="mt-1">
                            <span class="badge bg-{{ $news->status === 'published' ? 'success' : 'warning' }}">
                                {{ $news->status }}
                            </span>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-muted text-center">Belum ada berita</p>
                @endforelse

                <a href="{{ route('admin.news.index') }}" class="btn btn-sm btn-outline-primary w-100 mt-2">
                    Lihat Semua Berita <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <div class="card-header bg-white">
                <h5 class="mb-0">Produk Penelitian Terbaru</h5>
            </div>
            <div class="card-body">
                @forelse($recent_research as $research)
                <div class="mb-3 pb-3 border-bottom">
                    <h6 class="mb-1">{{ Str::limit($research->title, 50) }}</h6>
                    <small class="text-muted">
                        <i class="bi bi-person me-1"></i>{{ $research->researcher }}
                        <i class="bi bi-calendar ms-2 me-1"></i>{{ $research->year }}
                    </small>
                    <div class="mt-1">
                        <span class="badge bg-{{ $research->type === 'penelitian' ? 'primary' : 'success' }}">
                            {{ ucfirst($research->type) }}
                        </span>
                    </div>
                </div>
                @empty
                <p class="text-muted text-center">Belum ada produk penelitian</p>
                @endforelse

                <a href="{{ route('admin.research-products.index') }}" class="btn btn-sm btn-outline-success w-100 mt-2">
                    Lihat Semua Produk <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

@if(auth()->user()->isAdmin())
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">User Management</h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Total Users</h6>
                        <h3 class="mb-0">{{ $statistics['total_users'] }}</h3>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary">
                        Kelola Users <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
