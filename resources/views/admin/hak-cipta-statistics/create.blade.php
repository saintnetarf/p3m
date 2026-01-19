@extends('layouts.admin')

@section('title', 'Tambah Data Hak Cipta')

@section('content')
<div class="mb-4">
    <h2>Tambah Data Hak Cipta</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.hak-cipta-statistics.index') }}">Data Hak Cipta</a></li>
            <li class="breadcrumb-item active">Tambah Data</li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.hak-cipta-statistics.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="year" class="form-label">Tahun <span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('year') is-invalid @enderror"
                       id="year" name="year" value="{{ old('year', date('Y')) }}"
                       min="2000" max="{{ date('Y') + 10 }}" required>
                @error('year')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Kategori <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('category') is-invalid @enderror"
                       id="category" name="category" value="{{ old('category') }}"
                       placeholder="Contoh: Paten, Desain Industri, Merek, Rahasia Dagang" required>
                @error('category')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Contoh kategori: Paten, Desain Industri, Merek, Rahasia Dagang</div>
            </div>

            <div class="mb-3">
                <label for="count" class="form-label">Jumlah <span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('count') is-invalid @enderror"
                       id="count" name="count" value="{{ old('count', 0) }}"
                       min="0" required>
                @error('count')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-save me-1"></i> Simpan
                </button>
                <a href="{{ route('admin.hak-cipta-statistics.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
