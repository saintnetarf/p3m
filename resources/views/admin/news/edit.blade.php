@extends('layouts.admin')

@section('title', 'Edit Berita')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Berita</h1>
        <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Berita <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                   id="title" name="title" value="{{ old('title', $news->title) }}" required autofocus>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="news_category_id" class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select @error('news_category_id') is-invalid @enderror"
                                    id="news_category_id" name="news_category_id" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                            {{ old('news_category_id', $news->news_category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('news_category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Konten Berita <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('content') is-invalid @enderror"
                                      id="content" name="content" rows="10" required>{{ old('content', $news->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar Berita</label>
                            @if($news->image)
                                <div class="mb-2">
                                    <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}" class="img-thumbnail" style="max-height: 150px;">
                                    <p class="small text-muted mb-0">Gambar saat ini</p>
                                </div>
                            @endif
                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                   id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Upload gambar baru untuk mengganti gambar lama. Format: JPG, PNG, GIF. Maksimal 2MB</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_draft"
                                           value="draft" {{ old('status', $news->status) == 'draft' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_draft">Draft</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_published"
                                           value="published" {{ old('status', $news->status) == 'published' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_published">Terbitkan</label>
                                </div>
                            </div>
                            @error('status')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3" id="published_at_field" style="display: {{ old('status', $news->status) == 'published' ? 'block' : 'none' }};">
                            <label for="published_at" class="form-label">Tanggal Terbit</label>
                            <input type="datetime-local" class="form-control @error('published_at') is-invalid @enderror"
                                   id="published_at" name="published_at"
                                   value="{{ old('published_at', $news->published_at ? $news->published_at->format('Y-m-d\TH:i') : '') }}">
                            @error('published_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Kosongkan untuk menggunakan waktu saat ini</small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Perbarui Berita
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
                    <h6 class="fw-bold">Detail Berita:</h6>
                    <ul class="small mb-3">
                        <li><strong>Slug:</strong> <code>{{ $news->slug }}</code></li>
                        <li><strong>Penulis:</strong> {{ $news->author->name }}</li>
                        <li><strong>Dibuat:</strong> {{ $news->created_at->format('d M Y H:i') }}</li>
                        <li><strong>Diperbarui:</strong> {{ $news->updated_at->format('d M Y H:i') }}</li>
                        @if($news->published_at)
                            <li><strong>Diterbitkan:</strong> {{ $news->published_at->format('d M Y H:i') }}</li>
                        @endif
                    </ul>

                    <h6 class="fw-bold">Petunjuk:</h6>
                    <ul class="small">
                        <li>Slug akan diperbarui otomatis jika judul diubah</li>
                        <li>Gambar lama akan diganti jika upload gambar baru</li>
                        <li>Status draft tidak akan muncul di halaman publik</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusRadios = document.querySelectorAll('input[name="status"]');
    const publishedAtField = document.getElementById('published_at_field');

    statusRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'published') {
                publishedAtField.style.display = 'block';
            } else {
                publishedAtField.style.display = 'none';
            }
        });
    });
});
</script>
@endsection
