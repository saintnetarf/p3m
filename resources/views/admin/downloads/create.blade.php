@extends('layouts.admin')

@section('title', 'Tambah File Download')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah File Download</h1>
        <a href="{{ route('admin.downloads.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.downloads.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Judul File <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                   id="title" name="title" value="{{ old('title') }}" required autofocus>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="download_category_id" class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select @error('download_category_id') is-invalid @enderror"
                                    id="download_category_id" name="download_category_id" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('download_category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('download_category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description" name="description" rows="4">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Deskripsi singkat tentang file ini</small>
                        </div>

                        <div class="mb-3">
                            <label for="file" class="form-label">File <span class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('file') is-invalid @enderror"
                                   id="file" name="file" required>
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Format: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, ZIP, RAR. Maksimal 10MB</small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.downloads.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Simpan File
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
                        <li>Judul harus jelas dan deskriptif</li>
                        <li>Pilih kategori yang sesuai</li>
                        <li>Deskripsi bersifat opsional</li>
                        <li>File yang didukung:
                            <ul>
                                <li>Dokumen: PDF, DOC, DOCX</li>
                                <li>Spreadsheet: XLS, XLSX</li>
                                <li>Presentasi: PPT, PPTX</li>
                                <li>Arsip: ZIP, RAR</li>
                            </ul>
                        </li>
                        <li>Ukuran maksimal: 10MB</li>
                        <li>File akan tersedia untuk diunduh publik</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
