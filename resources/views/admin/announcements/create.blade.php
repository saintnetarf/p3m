@extends('layouts.admin')

@section('title', 'Tambah Pengumuman')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Pengumuman</h1>
        <a href="{{ route('admin.announcements.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.announcements.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Pengumuman <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                   id="title" name="title" value="{{ old('title') }}" required autofocus>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Slug akan dibuat otomatis dari judul</small>
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Isi Pengumuman <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('content') is-invalid @enderror"
                                      id="content" name="content" rows="8" required>{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="file_pdf" class="form-label">File PDF</label>
                            <input type="file" class="form-control @error('file_pdf') is-invalid @enderror"
                                   id="file_pdf" name="file_pdf" accept=".pdf">
                            @error('file_pdf')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Format: PDF. Maksimal 10MB. Opsional.</small>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                           id="start_date" name="start_date" value="{{ old('start_date', date('Y-m-d')) }}" required>
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="end_date" class="form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                           id="end_date" name="end_date" value="{{ old('end_date') }}" required>
                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_important" name="is_important" value="1" {{ old('is_important') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_important">
                                    <i class="bi bi-exclamation-triangle-fill text-danger"></i> Tandai sebagai Pengumuman Penting
                                </label>
                            </div>
                            <small class="form-text text-muted">Pengumuman penting akan ditampilkan dengan highlight di halaman utama</small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.announcements.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Simpan Pengumuman
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
                    <h6 class="fw-bold">Petunjuk Pengisian:</h6>
                    <ul class="small">
                        <li>Judul harus jelas dan menarik perhatian</li>
                        <li>Slug akan dibuat otomatis dari judul</li>
                        <li>Isi pengumuman dengan detail lengkap</li>
                        <li>Tentukan periode aktif pengumuman:
                            <ul>
                                <li><strong>Tanggal Mulai</strong>: Kapan pengumuman mulai ditampilkan</li>
                                <li><strong>Tanggal Selesai</strong>: Kapan pengumuman berakhir</li>
                            </ul>
                        </li>
                        <li>Centang "Penting" untuk pengumuman prioritas tinggi</li>
                        <li>Pengumuman penting akan muncul dengan badge merah</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
