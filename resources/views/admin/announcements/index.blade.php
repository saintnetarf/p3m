@extends('layouts.admin')

@section('title', 'Pengumuman')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pengumuman</h1>
        <a href="{{ route('admin.announcements.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Tambah Pengumuman
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
                            <th style="width: 30%;">Judul</th>
                            <th style="width: 15%;">Tanggal Mulai</th>
                            <th style="width: 15%;">Tanggal Selesai</th>
                            <th style="width: 12%;">Penulis</th>
                            <th style="width: 10%;" class="text-center">Status</th>
                            <th style="width: 8%;" class="text-center">Prioritas</th>
                            <th style="width: 5%;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($announcements as $announcement)
                            <tr>
                                <td>{{ $loop->iteration + ($announcements->currentPage() - 1) * $announcements->perPage() }}</td>
                                <td><strong>{{ $announcement->title }}</strong></td>
                                <td>{{ $announcement->start_date->format('d M Y') }}</td>
                                <td>{{ $announcement->end_date->format('d M Y') }}</td>
                                <td>{{ $announcement->author ? $announcement->author->name : '-' }}</td>
                                <td class="text-center">
                                    @php
                                        $now = now();
                                        $isActive = $announcement->start_date <= $now && $announcement->end_date >= $now;
                                    @endphp
                                    @if($isActive)
                                        <span class="badge bg-success">Aktif</span>
                                    @elseif($announcement->end_date < $now)
                                        <span class="badge bg-secondary">Berakhir</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Terjadwal</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($announcement->is_important)
                                        <span class="badge bg-danger"><i class="bi bi-exclamation-triangle-fill"></i> Penting</span>
                                    @else
                                        <span class="badge bg-secondary">Normal</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.announcements.edit', $announcement) }}">
                                                    <i class="bi bi-pencil me-2"></i>Edit
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('admin.announcements.destroy', $announcement) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?');">
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
                                    <p class="text-muted mt-2">Belum ada pengumuman</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($announcements->hasPages())
                <div class="d-flex justify-content-center mt-3">
                    {{ $announcements->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
