@extends('layouts.admin')

@section('title', 'Pengukuran TKT')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pengukuran TKT</h1>
        <a href="{{ route('admin.pengukuran-tkt.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Tambah Data
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="width: 25%;">Judul</th>
                            <th style="width: 15%;">Kategori</th>
                            <th style="width: 8%;" class="text-center">Level TKT</th>
                            <th style="width: 15%;">Nama File</th>
                            <th style="width: 10%;" class="text-center">Ukuran</th>
                            <th style="width: 12%;">Penulis</th>
                            <th style="width: 5%;" class="text-center">Download</th>
                            <th style="width: 5%;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengukuran_tkt as $tkt)
                            <tr>
                                <td>{{ $loop->iteration + ($pengukuran_tkt->currentPage() - 1) * $pengukuran_tkt->perPage() }}</td>
                                <td><strong>{{ $tkt->title }}</strong></td>
                                <td>
                                    @if($tkt->kategori)
                                        <span class="badge bg-primary">{{ $tkt->kategori }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($tkt->level_tkt)
                                        <span class="badge bg-success">TKT {{ $tkt->level_tkt }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <small class="text-muted">
                                        @php
                                            $ext = strtolower($tkt->file_type ?? pathinfo($tkt->file_name, PATHINFO_EXTENSION));
                                            $iconClass = match($ext) {
                                                'pdf' => 'bi-file-pdf',
                                                'doc', 'docx' => 'bi-file-word',
                                                'xls', 'xlsx' => 'bi-file-excel',
                                                'ppt', 'pptx' => 'bi-file-ppt',
                                                'zip', 'rar' => 'bi-file-zip',
                                                default => 'bi-file-earmark'
                                            };
                                        @endphp
                                        <i class="bi {{ $iconClass }}"></i> {{ Str::limit($tkt->file_name, 25) }}
                                    </small>
                                </td>
                                <td class="text-center">
                                    <small>{{ number_format($tkt->file_size / 1024, 2) }} KB</small>
                                </td>
                                <td>{{ $tkt->author ? $tkt->author->name : '-' }}</td>
                                <td class="text-center">
                                    <span class="badge bg-info">{{ $tkt->download_count ?? 0 }}x</span>
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="{{ Storage::url($tkt->file) }}" target="_blank">
                                                    <i class="bi bi-download me-2"></i>Download
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.pengukuran-tkt.edit', $tkt) }}">
                                                    <i class="bi bi-pencil me-2"></i>Edit
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('admin.pengukuran-tkt.destroy', $tkt) }}" method="POST"
                                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="bi bi-trash me-2"></i>Hapus
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4 text-muted">
                                    <i class="bi bi-folder-x" style="font-size: 2rem;"></i>
                                    <p class="mb-0 mt-2">Belum ada data pengukuran TKT</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $pengukuran_tkt->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
