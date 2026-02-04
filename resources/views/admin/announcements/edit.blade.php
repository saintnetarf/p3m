@extends('layouts.admin')

@section('title', 'Edit Pengumuman')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Pengumuman</h1>
        <a href="{{ route('admin.announcements.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.announcements.update', $announcement) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Pengumuman <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                   id="title" name="title" value="{{ old('title', $announcement->title) }}" required autofocus>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Slug akan diperbarui otomatis dari judul</small>
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Isi Pengumuman <span class="text-danger"></span></label>
                            <textarea class="form-control @error('content') is-invalid @enderror"
                                      id="content" name="content" rows="8" >{{ old('content', $announcement->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="file_pdf" class="form-label">File PDF</label>
                            @if($announcement->file_pdf)
                            <div class="mb-2">
                                <a href="{{ asset('storage/' . $announcement->file_pdf) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-file-pdf"></i> Lihat PDF saat ini
                                </a>
                            </div>
                            @endif
                            <input type="file" class="form-control @error('file_pdf') is-invalid @enderror"
                                   id="file_pdf" name="file_pdf" accept=".pdf">
                            @error('file_pdf')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Format: PDF. Maksimal 10MB. Kosongkan jika tidak ingin mengubah.</small>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Tanggal <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                           id="start_date" name="start_date" value="{{ old('start_date', $announcement->start_date->format('Y-m-d')) }}" required>
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_important" name="is_important" value="1" {{ old('is_important', $announcement->is_important) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_important">
                                    <i class="bi bi-exclamation-triangle-fill text-danger"></i> Tandai sebagai Pengumuman Penting
                                </label>
                            </div>
                            <small class="form-text text-muted">Pengumuman penting akan ditampilkan dengan highlight di halaman utama</small>
                        </div>

                        @php
                            $now = now();
                            $isActive = $announcement->start_date <= $now && $announcement->end_date >= $now;
                        @endphp
                        <div class="alert alert-{{ $isActive ? 'success' : ($announcement->end_date < $now ? 'secondary' : 'warning') }}" role="alert">
                            <i class="bi bi-info-circle me-2"></i>
                            Status saat ini:
                            @if($isActive)
                                <strong>Aktif</strong> - Pengumuman sedang ditampilkan
                            @elseif($announcement->end_date < $now)
                                <strong>Berakhir</strong> - Pengumuman sudah tidak ditampilkan
                            @else
                                <strong>Terjadwal</strong> - Pengumuman akan ditampilkan pada {{ $announcement->start_date->format('d M Y') }}
                            @endif
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.announcements.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Perbarui Pengumuman
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header bg-info text-white">
                    <i class="bi bi-info-circle me-2"></i>Informasi
                </div>
                <div class="card-body">
                    <h6 class="fw-bold">Detail Pengumuman:</h6>
                    <ul class="small mb-3">
                        <li><strong>Slug:</strong> <code>{{ $announcement->slug }}</code></li>
                        <li><strong>Penulis:</strong> {{ $announcement->author->name }}</li>
                        <li><strong>Dibuat:</strong> {{ $announcement->created_at->format('d M Y H:i') }}</li>
                        <li><strong>Diperbarui:</strong> {{ $announcement->updated_at->format('d M Y H:i') }}</li>
                        <li><strong>Prioritas:</strong>
                            @if($announcement->is_important)
                                <span class="badge bg-danger">Penting</span>
                            @else
                                <span class="badge bg-secondary">Normal</span>
                            @endif
                        </li>
                    </ul>

                    <h6 class="fw-bold">Petunjuk:</h6>
                    <ul class="small">
                        <li>Slug akan diperbarui otomatis jika judul diubah</li>
                        <li>Ubah tanggal untuk mengatur periode tampil</li>
                        <li>Pengumuman otomatis tidak tampil jika sudah melewati tanggal selesai</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
