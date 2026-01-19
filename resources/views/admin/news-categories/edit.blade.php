@extends('layouts.admin')

@section('title', 'Edit Kategori Berita')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Kategori Berita</h1>
        <a href="{{ route('admin.news-categories.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.news-categories.update', $newsCategory) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name', $newsCategory->name) }}" required autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Slug akan diperbarui otomatis dari nama kategori</small>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description" name="description" rows="4">{{ old('description', $newsCategory->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Deskripsi singkat tentang kategori ini</small>
                        </div>

                        <div class="alert alert-warning" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            Kategori ini digunakan oleh <strong>{{ $newsCategory->news()->count() }} berita</strong>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.news-categories.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Perbarui Kategori
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
                    <h6 class="fw-bold">Detail Kategori:</h6>
                    <ul class="small mb-3">
                        <li><strong>Slug:</strong> <code>{{ $newsCategory->slug }}</code></li>
                        <li><strong>Dibuat:</strong> {{ $newsCategory->created_at->format('d M Y H:i') }}</li>
                        <li><strong>Diperbarui:</strong> {{ $newsCategory->updated_at->format('d M Y H:i') }}</li>
                    </ul>

                    <h6 class="fw-bold">Petunjuk:</h6>
                    <ul class="small">
                        <li>Nama kategori harus unik</li>
                        <li>Perubahan tidak akan mempengaruhi berita yang sudah ada</li>
                        <li>Kategori yang memiliki berita tidak dapat dihapus</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
