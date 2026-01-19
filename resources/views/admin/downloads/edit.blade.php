@extends('layouts.admin')

@section('title', 'Edit File Download')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit File Download</h1>
        <a href="{{ route('admin.downloads.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.downloads.update', $download) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Judul File <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                   id="title" name="title" value="{{ old('title', $download->title) }}" required autofocus>
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
                                    <option value="{{ $category->id }}" {{ old('download_category_id', $download->download_category_id) == $category->id ? 'selected' : '' }}>
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
                                      id="description" name="description" rows="4">{{ old('description', $download->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Deskripsi singkat tentang file ini</small>
                        </div>

                        <div class="mb-3">
                            <label for="file" class="form-label">File</label>
                            @if($download->file_path)
                                <div class="mb-2">
                                    <a href="{{ Storage::url($download->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-download"></i> Download File Saat Ini
                                    </a>
                                    <p class="small text-muted mb-0 mt-1">
                                        <strong>{{ $download->file_name }}</strong>
                                        ({{ number_format($download->file_size / 1024, 2) }} KB)
                                    </p>
                                </div>
                            @endif
                            <input type="file" class="form-control @error('file') is-invalid @enderror"
                                   id="file" name="file">
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Upload file baru untuk mengganti file lama. Format: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, ZIP, RAR. Maksimal 10MB</small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.downloads.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Perbarui File
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
                    <h6 class="fw-bold">Detail File:</h6>
                    <ul class="small mb-3">
                        <li><strong>Slug:</strong> <code>{{ $download->slug }}</code></li>
                        <li><strong>Penulis:</strong> {{ $download->author ? $download->author->name : '-' }}</li>
                        <li><strong>Dibuat:</strong> {{ $download->created_at->format('d M Y H:i') }}</li>
                        <li><strong>Diperbarui:</strong> {{ $download->updated_at->format('d M Y H:i') }}</li>
                        <li><strong>Total Download:</strong> {{ $download->download_count ?? 0 }}x</li>
                    </ul>

                    <h6 class="fw-bold">Petunjuk:</h6>
                    <ul class="small">
                        <li>Slug akan diperbarui otomatis jika judul diubah</li>
                        <li>File lama akan diganti jika upload file baru</li>
                        <li>Kosongkan field file jika tidak ingin mengganti</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
