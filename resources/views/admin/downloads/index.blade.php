@extends('layouts.admin')

@section('title', 'File Download')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">File Download</h1>
        <a href="{{ route('admin.downloads.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Tambah File
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
                            <th style="width: 25%;">Judul File</th>
                            <th style="width: 15%;">Kategori</th>
                            <th style="width: 20%;">Nama File</th>
                            <th style="width: 10%;" class="text-center">Ukuran</th>
                            <th style="width: 12%;">Penulis</th>
                            <th style="width: 8%;" class="text-center">Download</th>
                            <th style="width: 5%;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($downloads as $download)
                            <tr>
                                <td>{{ $loop->iteration + ($downloads->currentPage() - 1) * $downloads->perPage() }}</td>
                                <td><strong>{{ $download->title }}</strong></td>
                                <td>
                                    <span class="badge bg-primary">{{ $download->category->name }}</span>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        <i class="bi bi-file-earmark"></i> {{ Str::limit($download->file_name, 30) }}
                                    </small>
                                </td>
                                <td class="text-center">
                                    <small>{{ number_format($download->file_size / 1024, 2) }} KB</small>
                                </td>
                                <td>{{ $download->author ? $download->author->name : '-' }}</td>
                                <td class="text-center">
                                    <span class="badge bg-info">{{ $download->download_count ?? 0 }}x</span>
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="{{ Storage::url($download->file_path) }}" target="_blank">
                                                    <i class="bi bi-download me-2"></i>Download
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.downloads.edit', $download) }}">
                                                    <i class="bi bi-pencil me-2"></i>Edit
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('admin.downloads.destroy', $download) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus file ini?');">
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
                                <td colspan="8" class="text-center py-4">
                                    <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                                    <p class="text-muted mt-2">Belum ada file download</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($downloads->hasPages())
                <div class="d-flex justify-content-center mt-3">
                    {{ $downloads->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
