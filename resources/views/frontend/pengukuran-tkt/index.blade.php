@extends('layouts.frontend')

@section('title', 'Pengukuran TKT')

@section('content')

<!-- Page Header -->
<div class="bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-5 fw-bold mb-3">Pengukuran TKT</h1>
                <p class="lead">Technology Readiness Level - Tingkat Kesiapan Teknologi</p>
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
                    <form action="{{ route('pengukuran-tkt.index') }}" method="GET">
                        <div class="mb-3">
                            <input type="text" name="search" class="form-control"
                                   placeholder="Cari TKT..." value="{{ request('search') }}">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm w-100">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </form>
                </div>
            </div>

            <!-- Level TKT Filter -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="bi bi-bar-chart-fill text-success me-2"></i>Level TKT
                    </h5>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('pengukuran-tkt.index') }}"
                           class="list-group-item list-group-item-action border-0 px-0 {{ !request('level') ? 'active' : '' }}">
                            Semua Level
                        </a>
                        @for($i = 1; $i <= 9; $i++)
                        <a href="{{ route('pengukuran-tkt.index', ['level' => $i]) }}"
                           class="list-group-item list-group-item-action border-0 px-0 {{ request('level') == $i ? 'active' : '' }}">
                            <span class="badge bg-success me-2">{{ $i }}</span> Level {{ $i }}
                        </a>
                        @endfor
                    </div>
                </div>
            </div>

            <!-- Kategori Filter -->
            @if($categories->count() > 0)
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="bi bi-folder-fill text-warning me-2"></i>Kategori
                    </h5>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('pengukuran-tkt.index') }}"
                           class="list-group-item list-group-item-action border-0 px-0 {{ !request('kategori') ? 'active' : '' }}">
                            Semua Kategori
                        </a>
                        @foreach($categories as $category)
                        <a href="{{ route('pengukuran-tkt.index', ['kategori' => $category]) }}"
                           class="list-group-item list-group-item-action border-0 px-0 {{ request('kategori') == $category ? 'active' : '' }}">
                            {{ $category }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Main Content -->
        <div class="col-lg-9">
            <!-- Active Filter Info -->
            @if(request('level') || request('kategori') || request('search'))
            <div class="alert alert-info d-flex justify-content-between align-items-center">
                <span>
                    @if(request('search'))
                        Hasil pencarian: <strong>{{ request('search') }}</strong>
                    @endif
                    @if(request('level'))
                        Level: <strong>TKT {{ request('level') }}</strong>
                    @endif
                    @if(request('kategori'))
                        Kategori: <strong>{{ request('kategori') }}</strong>
                    @endif
                </span>
                <a href="{{ route('pengukuran-tkt.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-x"></i> Reset Filter
                </a>
            </div>
            @endif

            <!-- TKT Info Banner -->
            <div class="alert alert-primary mb-4">
                <div class="d-flex align-items-center">
                    <i class="bi bi-info-circle-fill fs-3 me-3"></i>
                    <div>
                        <h6 class="alert-heading mb-1">Tentang TKT</h6>
                        <p class="mb-0 small">
                            Technology Readiness Level (TKT) adalah metode sistematis untuk menilai tingkat kematangan
                            suatu teknologi dari tahap riset dasar (Level 1) hingga implementasi penuh (Level 9).
                        </p>
                    </div>
                </div>
            </div>

            <!-- TKT List -->
            <div class="row g-3">
                @forelse($pengukuran_tkt as $tkt)
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100 hover-lift">
                        <div class="card-body">
                            <div class="d-flex align-items-start mb-3">
                                <!-- File Icon -->
                                <div class="me-3">
                                    @php
                                        $ext = strtolower($tkt->file_type ?? pathinfo($tkt->file_name, PATHINFO_EXTENSION));
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

                                <!-- Content -->
                                <div class="flex-grow-1">
                                    <div class="d-flex gap-2 mb-2">
                                        @if($tkt->level_tkt)
                                            <span class="badge bg-success">TKT {{ $tkt->level_tkt }}</span>
                                        @endif
                                        @if($tkt->kategori)
                                            <span class="badge bg-primary">{{ $tkt->kategori }}</span>
                                        @endif
                                    </div>
                                    <h5 class="card-title mb-2">
                                        <a href="{{ route('pengukuran-tkt.show', $tkt->slug) }}" class="text-decoration-none text-dark">
                                            {{ $tkt->title }}
                                        </a>
                                    </h5>
                                    @if($tkt->description)
                                    <p class="text-muted small mb-3">{{ Str::limit($tkt->description, 100) }}</p>
                                    @endif

                                    <!-- Meta Info -->
                                    <div class="d-flex flex-wrap gap-3 text-muted small mb-3">
                                        <span>
                                            <i class="bi bi-calendar me-1"></i>
                                            {{ $tkt->created_at->format('d M Y') }}
                                        </span>
                                        <span>
                                            <i class="bi bi-file-text me-1"></i>
                                            {{ number_format($tkt->file_size / 1024, 0) }} KB
                                        </span>
                                        <span>
                                            <i class="bi bi-download me-1"></i>
                                            {{ $tkt->download_count }}x
                                        </span>
                                    </div>

                                    <!-- Actions -->
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('pengukuran-tkt.show', $tkt->slug) }}"
                                           class="btn btn-sm btn-outline-primary flex-grow-1">
                                            <i class="bi bi-eye me-1"></i>Detail
                                        </a>
                                        <a href="{{ route('pengukuran-tkt.download', $tkt->slug) }}"
                                           class="btn btn-sm btn-primary">
                                            <i class="bi bi-download"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center py-5">
                            <i class="bi bi-folder-x text-muted" style="font-size: 4rem;"></i>
                            <h5 class="mt-3 text-muted">Belum Ada Data</h5>
                            <p class="text-muted">Tidak ada data pengukuran TKT yang tersedia saat ini.</p>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($pengukuran_tkt->hasPages())
            <div class="mt-4">
                {{ $pengukuran_tkt->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<!-- TKT Level Info Section -->
<div class="bg-light py-5">
    <div class="container">
        <h3 class="text-center mb-4">Tingkat Kesiapan Teknologi (TKT)</h3>
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <span class="badge bg-primary" style="font-size: 1.5rem;">Level 1-3</span>
                        </div>
                        <h5 class="text-center">Riset Dasar</h5>
                        <ul class="small">
                            <li>Prinsip dasar diamati</li>
                            <li>Konsep teknologi dirumuskan</li>
                            <li>Bukti konsep eksperimental</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <span class="badge bg-warning" style="font-size: 1.5rem;">Level 4-6</span>
                        </div>
                        <h5 class="text-center">Pengembangan Teknologi</h5>
                        <ul class="small">
                            <li>Validasi komponen di laboratorium</li>
                            <li>Validasi sistem di lingkungan terkait</li>
                            <li>Demonstrasi prototipe di lingkungan operasional</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <span class="badge bg-success" style="font-size: 1.5rem;">Level 7-9</span>
                        </div>
                        <h5 class="text-center">Implementasi</h5>
                        <ul class="small">
                            <li>Demonstrasi sistem dalam lingkungan operasional</li>
                            <li>Sistem teruji dan telah beroperasi</li>
                            <li>Sistem terbukti melalui operasi sukses</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
.hover-lift {
    transition: transform 0.2s;
}
.hover-lift:hover {
    transform: translateY(-5px);
}
</style>
@endpush
