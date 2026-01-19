@extends('layouts.frontend')

@section('title', $news->title)

@section('content')

<!-- Page Header -->
<div class="bg-light py-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('news.index') }}">Berita</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($news->title, 50) }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <article class="card border-0 shadow-sm mb-4">
                @if($news->image)
                    <img src="{{ Storage::url($news->image) }}" class="card-img-top" alt="{{ $news->title }}" style="max-height: 450px; object-fit: cover;">
                @endif
                <div class="card-body p-4">
                    <!-- Category Badge -->
                    <div class="mb-3">
                        <span class="badge bg-primary">{{ $news->category->name }}</span>
                    </div>

                    <!-- Title -->
                    <h1 class="h2 fw-bold mb-3">{{ $news->title }}</h1>

                    <!-- Meta Info -->
                    <div class="d-flex align-items-center text-muted mb-4 pb-3 border-bottom">
                        <div class="me-4">
                            <i class="bi bi-person-circle me-1"></i>
                            {{ $news->author ? $news->author->name : 'Admin' }}
                        </div>
                        <div class="me-4">
                            <i class="bi bi-calendar-event me-1"></i>
                            {{ $news->published_at ? $news->published_at->format('d F Y') : '-' }}
                        </div>
                        <div>
                            <i class="bi bi-clock me-1"></i>
                            {{ $news->published_at ? $news->published_at->format('H:i') : '-' }}
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="news-content">
                        {!! nl2br(e($news->content)) !!}
                    </div>

                    <!-- Share Buttons -->
                    <div class="mt-4 pt-4 border-top">
                        <h6 class="text-muted mb-3">Bagikan:</h6>
                        <div class="d-flex gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('news.show', $news->slug)) }}"
                               target="_blank" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-facebook"></i> Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('news.show', $news->slug)) }}&text={{ urlencode($news->title) }}"
                               target="_blank" class="btn btn-outline-info btn-sm">
                                <i class="bi bi-twitter"></i> Twitter
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($news->title . ' ' . route('news.show', $news->slug)) }}"
                               target="_blank" class="btn btn-outline-success btn-sm">
                                <i class="bi bi-whatsapp"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Related News -->
            @if($related_news->count() > 0)
            <div class="mt-5">
                <h4 class="mb-4">Berita Terkait</h4>
                <div class="row g-3">
                    @foreach($related_news as $related)
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 hover-lift">
                            @if($related->image)
                                <img src="{{ Storage::url($related->image) }}" class="card-img-top" alt="{{ $related->title }}" style="height: 150px; object-fit: cover;">
                            @else
                                <div class="bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center" style="height: 150px;">
                                    <i class="bi bi-newspaper text-secondary" style="font-size: 2rem;"></i>
                                </div>
                            @endif
                            <div class="card-body">
                                <h6 class="card-title">
                                    <a href="{{ route('news.show', $related->slug) }}" class="text-decoration-none text-dark">
                                        {{ Str::limit($related->title, 60) }}
                                    </a>
                                </h6>
                                <small class="text-muted">
                                    <i class="bi bi-calendar me-1"></i>
                                    {{ $related->published_at ? $related->published_at->format('d M Y') : '-' }}
                                </small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Latest News -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="bi bi-clock-fill text-primary me-2"></i>Berita Terbaru
                    </h5>
                    @php
                        $latestNews = \App\Models\News::with('category')
                            ->where('status', 'published')
                            ->where('id', '!=', $news->id)
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

            <!-- Back Button -->
            <div class="d-grid">
                <a href="{{ route('news.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar Berita
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.news-content {
    font-size: 1.05rem;
    line-height: 1.8;
    color: #333;
}

.news-content p {
    margin-bottom: 1rem;
}

.hover-lift {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1.5rem rgba(0,0,0,0.15) !important;
}
</style>

@endsection
