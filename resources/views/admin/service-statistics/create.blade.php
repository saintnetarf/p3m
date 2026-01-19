@extends('layouts.admin')

@section('title', 'Tambah Data Pengabdian')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Tambah Data Pengabdian Masyarakat</h2>
    <a href="{{ route('admin.service-statistics.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.service-statistics.store') }}" method="POST">
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
                       placeholder="Contoh: DIPA Poliban, DIPA DRPM, Mandiri, Ekternal" required>
                @error('category')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Masukkan kategori pengabdian</div>
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
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <a href="{{ route('admin.service-statistics.index') }}" class="btn btn-secondary">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
