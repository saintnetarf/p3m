@extends('layouts.admin')

@section('title', 'Tambah Pengukuran TKT')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Pengukuran TKT</h1>
        <a href="{{ route('admin.pengukuran-tkt.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.pengukuran-tkt.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                   id="title" name="title" value="{{ old('title') }}" required autofocus>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
{{-- 
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <input type="text" class="form-control @error('kategori') is-invalid @enderror"
                                       id="kategori" name="kategori" value="{{ old('kategori') }}" placeholder="Contoh: Teknologi Informasi">
                                @error('kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="level_tkt" class="form-label">Level TKT</label>
                                <select class="form-select @error('level_tkt') is-invalid @enderror" id="level_tkt" name="level_tkt">
                                    <option value="">Pilih Level</option>
                                    @for($i = 1; $i <= 9; $i++)
                                        <option value="{{ $i }}" {{ old('level_tkt') == $i ? 'selected' : '' }}>Level {{ $i }}</option>
                                    @endfor
                                </select>
                                @error('level_tkt')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description" name="description" rows="4">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Deskripsi singkat tentang pengukuran TKT ini</small>
                        </div> --}}

                        <div class="mb-3">
                            <label for="file" class="form-label">File <span class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('file') is-invalid @enderror"
                                   id="file" name="file" required>
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Format: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, ZIP, RAR. Maksimal 20MB</small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.pengukuran-tkt.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header bg-info text-white">
                    <i class="bi bi-info-circle me-2"></i>Informasi TKT
                </div>
                <div class="card-body">
                    <p class="small mb-3">
                        <strong>Technology Readiness Level (TKT)</strong> adalah metode untuk menilai kematangan teknologi dari tahap konsep hingga implementasi.
                    </p>
                    <h6 class="mb-2">Level TKT:</h6>
                    <ul class="small mb-0 ps-3">
                        <li><strong>Level 1-3:</strong> Riset Dasar</li>
                        <li><strong>Level 4-6:</strong> Pengembangan Teknologi</li>
                        <li><strong>Level 7-9:</strong> Demonstrasi dan Implementasi</li>
                    </ul>
                </div>
            </div>

            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <i class="bi bi-exclamation-triangle me-2"></i>Panduan Upload
                </div>
                <div class="card-body">
                    <ul class="small mb-0 ps-3">
                        <li>Format yang didukung: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, ZIP, RAR</li>
                        <li>Ukuran file maksimal 20 MB</li>
                        <li>File harus berisi hasil pengukuran TKT</li>
                        <li>Gunakan nama file yang deskriptif</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
