@extends('layouts.frontend')

@section('title', $pengukuranTkt->title)

@section('content')

<!-- Page Header -->
<div class="bg-primary text-white py-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pengukuran-tkt.index') }}" class="text-white">Pengukuran TKT</a></li>
                <li class="breadcrumb-item active text-white-50" aria-current="page">Detail</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- TKT Detail Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <!-- Badges -->
                    <div class="d-flex gap-2 mb-3">
                        @if($pengukuranTkt->level_tkt)
                            <span class="badge bg-success" style="font-size: 1rem;">TKT Level {{ $pengukuranTkt->level_tkt }}</span>
                        @endif
                        @if($pengukuranTkt->kategori)
                            <span class="badge bg-primary" style="font-size: 1rem;">{{ $pengukuranTkt->kategori }}</span>
                        @endif
                    </div>

                    <!-- Title -->
                    <h1 class="h2 mb-4">{{ $pengukuranTkt->title }}</h1>

                    <!-- Meta Info -->
                    <div class="d-flex flex-wrap gap-4 text-muted mb-4 pb-4 border-bottom">
                        <div>
                            <i class="bi bi-calendar-event me-2"></i>
                            <strong>Tanggal:</strong> {{ $pengukuranTkt->created_at->format('d F Y') }}
                        </div>
                        @if($pengukuranTkt->author)
                        <div>
                            <i class="bi bi-person me-2"></i>
                            <strong>Penulis:</strong> {{ $pengukuranTkt->author->name }}
                        </div>
                        @endif
                        <div>
                            <i class="bi bi-download me-2"></i>
                            <strong>Download:</strong> {{ $pengukuranTkt->download_count }}x
                        </div>
                    </div>

                    <!-- Description -->
                    @if($pengukuranTkt->description)
                    <div class="mb-4">
                        <h5 class="mb-3">Deskripsi</h5>
                        <p class="text-muted" style="text-align: justify;">{{ $pengukuranTkt->description }}</p>
                    </div>
                    @endif

                    <!-- File Info -->
                    <div class="bg-light rounded p-4 mb-4">
                        <div class="d-flex align-items-center">
                            @php
                                $ext = strtolower($pengukuranTkt->file_type ?? pathinfo($pengukuranTkt->file_name, PATHINFO_EXTENSION));
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
                                $fileType = match($ext) {
                                    'pdf' => 'PDF',
                                    'doc', 'docx' => 'Word Document',
                                    'xls', 'xlsx' => 'Excel Spreadsheet',
                                    'ppt', 'pptx' => 'PowerPoint Presentation',
                                    'zip', 'rar' => 'Compressed File',
                                    default => 'Document'
                                };
                            @endphp
                            <div class="bg-{{ $iconColor }} bg-opacity-10 rounded p-3 me-3">
                                <i class="bi bi-{{ $icon }}-fill text-{{ $iconColor }}" style="font-size: 3rem;"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">{{ $fileType }}</h6>
                                <p class="text-muted mb-1">{{ $pengukuranTkt->file_name }}</p>
                                <small class="text-muted">
                                    Ukuran: {{ number_format($pengukuranTkt->file_size / 1024, 2) }} KB
                                </small>
                            </div>
                            <div>
                                <a href="{{ route('pengukuran-tkt.download', $pengukuranTkt->slug) }}"
                                   class="btn btn-{{ $iconColor }}">
                                    <i class="bi bi-download me-2"></i>Download
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- TKT Level Explanation -->
                    @if($pengukuranTkt->level_tkt)
                    <div class="alert alert-success">
                        <h6 class="alert-heading mb-2">
                            <i class="bi bi-info-circle me-2"></i>Tentang TKT Level {{ $pengukuranTkt->level_tkt }}
                        </h6>
                        <p class="mb-0 small">
                            @php
                                $levelInfo = [
                                    1 => 'Prinsip dasar teknologi telah diamati dan dilaporkan',
                                    2 => 'Konsep teknologi dan/atau aplikasi telah dirumuskan',
                                    3 => 'Bukti konsep secara eksperimental atau analitik telah dilakukan',
                                    4 => 'Validasi komponen/subsistem di lingkungan laboratorium',
                                    5 => 'Validasi komponen/subsistem dalam lingkungan yang relevan',
                                    6 => 'Demonstrasi model/prototipe sistem dalam lingkungan yang relevan',
                                    7 => 'Demonstrasi prototipe sistem dalam lingkungan operasional',
                                    8 => 'Sistem telah lengkap dan memenuhi syarat melalui pengujian dan demonstrasi',
                                    9 => 'Sistem terbukti melalui operasi yang sukses dalam lingkungan operasional'
                                ];
                            @endphp
                            {{ $levelInfo[$pengukuranTkt->level_tkt] ?? 'Deskripsi level tidak tersedia' }}
                        </p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">Aksi Cepat</h5>
                    <div class="d-grid gap-2">
                        @php
                            $ext = strtolower($pengukuranTkt->file_type ?? pathinfo($pengukuranTkt->file_name, PATHINFO_EXTENSION));
                            $buttonColor = match($ext) {
                                'pdf' => 'danger',
                                'doc', 'docx' => 'primary',
                                'xls', 'xlsx' => 'success',
                                'ppt', 'pptx' => 'warning',
                                'zip', 'rar' => 'secondary',
                                default => 'info'
                            };
                        @endphp
                        <a href="{{ route('pengukuran-tkt.download', $pengukuranTkt->slug) }}"
                           class="btn btn-{{ $buttonColor }}">
                            <i class="bi bi-download me-2"></i>Download File
                        </a>
                        <a href="{{ Storage::url($pengukuranTkt->file) }}"
                           target="_blank" class="btn btn-outline-primary">
                            <i class="bi bi-eye me-2"></i>Lihat File
                        </a>
                        <a href="{{ route('pengukuran-tkt.index') }}"
                           class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Share -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">Bagikan</h5>
                    <div class="d-flex gap-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                           target="_blank" class="btn btn-outline-primary flex-fill">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($pengukuranTkt->title) }}"
                           target="_blank" class="btn btn-outline-info flex-fill">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($pengukuranTkt->title . ' ' . request()->url()) }}"
                           target="_blank" class="btn btn-outline-success flex-fill">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Related TKT -->
            @if($related->count() > 0)
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">TKT Terkait</h5>
                    @foreach($related as $item)
                    <div class="mb-3 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                        <div class="d-flex gap-2 mb-2">
                            @if($item->level_tkt)
                                <span class="badge bg-success badge-sm">TKT {{ $item->level_tkt }}</span>
                            @endif
                        </div>
                        <h6 class="mb-1">
                            <a href="{{ route('pengukuran-tkt.show', $item->slug) }}"
                               class="text-decoration-none text-dark">
                                {{ Str::limit($item->title, 50) }}
                            </a>
                        </h6>
                        <small class="text-muted">
                            <i class="bi bi-calendar me-1"></i>{{ $item->created_at->format('d M Y') }}
                        </small>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection
