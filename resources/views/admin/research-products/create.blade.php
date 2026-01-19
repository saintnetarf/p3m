@extends('layouts.admin')

@section('title', 'Tambah Produk Penelitian')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Produk Penelitian</h1>
        <a href="{{ route('admin.research-products.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.research-products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Penelitian <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                   id="title" name="title" value="{{ old('title') }}" required autofocus>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="researcher" class="form-label">Nama Peneliti <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('researcher') is-invalid @enderror"
                                           id="researcher" name="researcher" value="{{ old('researcher') }}" required>
                                    @error('researcher')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="year" class="form-label">Tahun <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('year') is-invalid @enderror"
                                           id="year" name="year" value="{{ old('year', date('Y')) }}" min="1900" max="{{ date('Y') + 10 }}" required>
                                    @error('year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Penelitian" {{ old('category') == 'Penelitian' ? 'selected' : '' }}>Penelitian</option>
                                <option value="Pengabdian Masyarakat" {{ old('category') == 'Pengabdian Masyarakat' ? 'selected' : '' }}>Pengabdian Masyarakat</option>
                                <option value="Publikasi" {{ old('category') == 'Publikasi' ? 'selected' : '' }}>Publikasi</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description" name="description" rows="6" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar Produk</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                   id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Format: JPG, PNG, GIF. Maksimal 2MB. Gambar akan ditampilkan di halaman publik.</small>
                        </div>

                        <div class="mb-3">
                            <label for="file" class="form-label">File Dokumen</label>
                            <input type="file" class="form-control @error('file') is-invalid @enderror"
                                   id="file" name="file" accept=".pdf,.doc,.docx">
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Format: PDF, DOC, DOCX. Maksimal 10MB</small>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">
                                    <i class="bi bi-star-fill text-warning"></i> Tandai sebagai Unggulan
                                </label>
                            </div>
                            <small class="form-text text-muted">Produk unggulan akan ditampilkan di halaman utama</small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.research-products.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Simpan Produk
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
                        <li>Isi judul penelitian dengan lengkap</li>
                        <li>Nama peneliti dapat berisi satu atau beberapa nama</li>
                        <li>Pilih tahun pelaksanaan penelitian</li>
                        <li>Kategori:
                            <ul>
                                <li><strong>Penelitian</strong>: Hasil riset ilmiah</li>
                                <li><strong>Pengabdian Masyarakat</strong>: Kegiatan pengabdian</li>
                                <li><strong>Publikasi</strong>: Artikel jurnal, prosiding</li>
                            </ul>
                        </li>
                        <li>Upload file dokumen pendukung (opsional)</li>
                        <li>Centang "Unggulan" untuk produk terbaik</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
