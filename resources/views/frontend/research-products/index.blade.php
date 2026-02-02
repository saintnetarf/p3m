@extends('layouts.frontend')

@section('title', 'Produk Penelitian & Pengabdian')

@section('content')

<!-- Page Header -->
<div class="bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-5 fw-bold mb-3">Produk Penelitian & Pengabdian</h1>
                <p class="lead">Hasil penelitian, pengabdian masyarakat, dan publikasi ilmiah</p>

                <!-- Search Form -->
                <div class="mt-4">
                    <form action="{{ route('research.index') }}" method="GET" class="d-flex justify-content-center">
                        <div class="input-group" style="max-width: 500px;">
                            <input type="text" class="form-control form-control-lg" name="search"
                                   placeholder="Cari produk penelitian..." value="{{ request('search') }}">
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

<!-- Products Grid -->
<div class="container my-5">
    <div class="row g-4">
        @forelse($products as $product)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm hover-lift">
                @if($product->image)
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 220px; overflow: hidden;">
                        <img src="{{ Storage::url($product->image) }}" class="img-fluid" alt="{{ $product->title }}" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                    </div>
                @else
                    <div class="bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center" style="height: 220px;">
                        <i class="bi bi-book text-secondary" style="font-size: 3.5rem;"></i>
                    </div>
                @endif
                <div class="card-body d-flex flex-column">
                    <div class="mb-2">
                        @if($product->category == 'Penelitian')
                            <span class="badge bg-primary">{{ $product->category }}</span>
                        @elseif($product->category == 'Pengabdian Masyarakat')
                            <span class="badge bg-success">{{ $product->category }}</span>
                        @else
                            <span class="badge bg-info">{{ $product->category }}</span>
                        @endif
                        @if($product->is_featured)
                            <span class="badge bg-warning text-dark"><i class="bi bi-star-fill"></i> Unggulan</span>
                        @endif
                    </div>
                    <h5 class="card-title">{{ $product->title }}</h5>
                    <p class="card-text text-muted mb-2">
                        <i class="bi bi-person me-1"></i>{{ $product->researcher }}
                    </p>
                    <p class="card-text text-muted mb-3">
                        <i class="bi bi-calendar me-1"></i>{{ $product->year }}
                    </p>
                    <p class="card-text flex-grow-1">{{ Str::limit($product->description, 100) }}</p>
                    <div class="mt-auto">
                        <a href="{{ route('research.show', $product->slug) }}" class="btn btn-outline-primary btn-sm">
                            Lihat Detail <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center py-5">
                <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                <p class="mt-3 mb-0">Belum ada produk penelitian tersedia</p>
            </div>
        </div>
        @endforelse
    </div>

    @if($products->hasPages())
    <div class="d-flex justify-content-center mt-5">
        {{ $products->links() }}
    </div>
    @endif
</div>

<style>
.hover-lift {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}
</style>

@endsection
