@extends('layouts.frontend')

@section('title', 'Download')

@section('content')

<!-- Page Header -->
<div class="bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-5 fw-bold mb-3">Download</h1>
                <p class="lead">Dokumen, formulir, dan file yang dapat diunduh</p>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3">
            <!-- Search -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="bi bi-search text-primary me-2"></i>Pencarian
                    </h5>
                    <form action="{{ route('downloads.index') }}" method="GET">
                        <div class="mb-3">
                            <input type="text" name="search" class="form-control"
                                   placeholder="Cari file..." value="{{ request('search') }}">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm w-100">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </form>
                </div>
            </div>

            <!-- Categories -->
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="bi bi-folder-fill text-primary me-2"></i>Kategori
                    </h5>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('downloads.index') }}"
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-0 px-0 {{ !request('category') ? 'active' : '' }}">
                            Semua Kategori
                            <span class="badge {{ !request('category') ? 'bg-light text-dark' : 'bg-primary' }} rounded-pill">
                                {{ $categories->sum('downloads_count') }}
                            </span>
                        </a>
                        @foreach($categories as $category)
                        <a href="{{ route('downloads.index', ['category' => $category->id]) }}"
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-0 px-0 {{ request('category') == $category->id ? 'active' : '' }}">
                            {{ $category->name }}
                            <span class="badge {{ request('category') == $category->id ? 'bg-light text-dark' : 'bg-primary' }} rounded-pill">
                                {{ $category->downloads_count }}
                            </span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9">
            <!-- Active Filter Info -->
            @if(request('category') || request('search'))
            <div class="alert alert-info d-flex justify-content-between align-items-center">
                <span>
                    @if(request('search'))
                        Hasil pencarian: <strong>{{ request('search') }}</strong>
                    @endif
                    @if(request('category'))
                        @php
                            $activeCategory = $categories->firstWhere('id', request('category'));
                        @endphp
                        Kategori: <strong>{{ $activeCategory ? $activeCategory->name : '' }}</strong>
                    @endif
                </span>
                <a href="{{ route('downloads.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-x"></i> Reset Filter
                </a>
            </div>
            @endif

            <!-- Downloads List -->
            <div class="row g-3">
                @forelse($downloads as $download)
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100 hover-lift">
                        <div class="card-body">
                            <div class="d-flex align-items-start mb-3">
                                <!-- File Icon -->
                                <div class="me-3">
                                    @php
                                        $ext = strtolower(pathinfo($download->file_name, PATHINFO_EXTENSION));
                                        $iconColor = match($ext) {
                                            'pdf' => 'danger',
                                            'doc', 'docx' => 'primary',
                                            'xls', 'xlsx' => 'success',
                                            'ppt', 'pptx' => 'warning',
                                            'zip', 'rar' => 'secondary',
                                            default => 'info'
                                        };
                                        $icon = match($ext) {
                                            'pdf' => 'file-earmark-pdf',
                                            'doc', 'docx' => 'file-earmark-word',
                                            'xls', 'xlsx' => 'file-earmark-excel',
                                            'ppt', 'pptx' => 'file-earmark-ppt',
                                            'zip', 'rar' => 'file-earmark-zip',
                                            default => 'file-earmark'
                                        };
                                    @endphp
                                    <div class="bg-{{ $iconColor }} bg-opacity-10 rounded p-3">
                                        <i class="bi bi-{{ $icon }}-fill text-{{ $iconColor }}" style="font-size: 2rem;"></i>
                                    </div>
                                </div>

                                <!-- File Info -->
                                <div class="flex-grow-1">
                                    <span class="badge bg-{{ $iconColor }} mb-2">{{ $download->category->name }}</span>
                                    <h5 class="card-title mb-2">{{ $download->title }}</h5>
                                    <p class="card-text text-muted small mb-2">
                                        {{ Str::limit($download->description, 100) }}
                                    </p>
                                </div>
                            </div>

                            <!-- File Details -->
                            <div class="border-top pt-3">
                                <div class="row text-muted small mb-3">
                                    <div class="col-6">
                                        <i class="bi bi-file-earmark me-1"></i>
                                        {{ strtoupper($ext) }} • {{ number_format($download->file_size / 1024, 2) }} KB
                                    </div>
                                    <div class="col-6 text-end">
                                        <i class="bi bi-download me-1"></i>
                                        {{ $download->download_count }} download
                                    </div>
                                </div>
                                <div class="text-muted small mb-3">
                                    <i class="bi bi-person me-1"></i>
                                    {{ $download->author ? $download->author->name : 'Admin' }}
                                    <span class="mx-1">•</span>
                                    <i class="bi bi-calendar me-1"></i>
                                    {{ $download->created_at->format('d M Y') }}
                                </div>

                                <!-- Download Button -->
                                <a href="{{ route('downloads.download', $download->id) }}"
                                   class="btn btn-primary btn-sm w-100">
                                    <i class="bi bi-download me-2"></i>Download File
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info text-center py-5">
                        <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                        <p class="mt-3 mb-0">
                            @if(request('search') || request('category'))
                                Tidak ada file ditemukan dengan filter yang dipilih
                            @else
                                Belum ada file tersedia
                            @endif
                        </p>
                    </div>
                </div>
                @endforelse
            </div>

            @if($downloads->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $downloads->appends(request()->query())->links() }}
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
