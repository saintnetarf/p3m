@extends('layouts.frontend')

@section('title', 'Berita')

@section('content')

<!-- Page Header -->
<div class="bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-5 fw-bold mb-3">Berita & Informasi</h1>
                <p class="lead">Berita terkini seputar kegiatan penelitian dan pengabdian kepada masyarakat</p>
                
                <!-- Search Form -->
                <div class="mt-4">
                    <form action="{{ route('news.index') }}" method="GET" class="d-flex justify-content-center">
                        <div class="input-group" style="max-width: 500px;">
                            <input type="text" class="form-control form-control-lg" name="search" 
                                   placeholder="Cari berita..." value="{{ request('search') }}">
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
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <div class="row g-4">
                @forelse($news as $item)
                <div class="col-md-6">
                    <article class="card h-100 border-0 shadow-sm hover-lift">
                        @if($item->image)
                            <img src="{{ Storage::url($item->image) }}" class="card-img-top" alt="{{ $item->title }}" style="height: 200px; object-fit: cover;">
                        @else
                            <div class="bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center" style="height: 200px;">
                                <i class="bi bi-newspaper text-secondary" style="font-size: 3rem;"></i>
                            </div>
                        @endif
                        <div class="card-body d-flex flex-column">
                            <div class="mb-2">
                                <span class="badge bg-primary">{{ $item->category->name }}</span>
                            </div>
                            <h5 class="card-title">
                                <a href="{{ route('news.show', $item->slug) }}" class="text-decoration-none text-dark">
                                    {{ $item->title }}
                                </a>
                            </h5>
                            <p class="card-text text-muted small mb-2">
                                <i class="bi bi-calendar me-1"></i>
                                {{ $item->published_at ? $item->published_at->format('d M Y') : '-' }}
                                <span class="mx-1">•</span>
                                <i class="bi bi-person me-1"></i>
                                {{ $item->author ? $item->author->name : 'Admin' }}
                            </p>
                            <p class="card-text flex-grow-1">{{ Str::limit(strip_tags($item->content), 120) }}</p>
                            <div class="mt-auto">
                                <a href="{{ route('news.show', $item->slug) }}" class="btn btn-outline-primary btn-sm">
                                    Selengkapnya <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info text-center py-5">
                        <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                        <p class="mt-3 mb-0">Belum ada berita tersedia</p>
                    </div>
                </div>
                @endforelse
            </div>

            @if($news->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $news->links() }}
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Categories -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="bi bi-bookmark-fill text-primary me-2"></i>Kategori Berita
                    </h5>
                    <div class="list-group list-group-flush">
                        @foreach($categories as $cat)
                        <a href="{{ route('news.category', $cat->slug) }}"
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-0 px-0">
                            {{ $cat->name }}
                            <span class="badge bg-primary rounded-pill">{{ $cat->news_count }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Latest News -->
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="bi bi-clock-fill text-primary me-2"></i>Berita Terbaru
                    </h5>
                    @php
                        $latestNews = \App\Models\News::with('category')
                            ->where('status', 'published')
                            ->orderBy('published_at', 'desc')
                            ->limit(5)
                            ->get();
                    @endphp
                    @foreach($latestNews as $latest)
                    <div class="mb-3 pb-3 border-bottom">
                        <h6 class="mb-1">
                            <a href="{{ route('news.show', $latest->slug) }}" class="text-decoration-none text-dark">
                                {{ Str::limit($latest->title, 60) }}
                            </a>
                        </h6>
                        <small class="text-muted">
                            <i class="bi bi-calendar me-1"></i>
                            {{ $latest->published_at ? $latest->published_at->format('d M Y') : '-' }}
                        </small>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.hover-lift {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1.5rem rgba(0,0,0,0.15) !important;
}
</style>

@endsection
