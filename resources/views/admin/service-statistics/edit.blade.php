@extends('layouts.admin')

@section('title', 'Edit Data Pengabdian')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Data Pengabdian Masyarakat</h2>
    <a href="{{ route('admin.service-statistics.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.service-statistics.update', $statistic->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="year" class="form-label">Tahun <span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('year') is-invalid @enderror"
                       id="year" name="year" value="{{ old('year', $statistic->year) }}"
                       min="2000" max="{{ date('Y') + 10 }}" required>
                @error('year')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Kategori <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('category') is-invalid @enderror"
                       id="category" name="category" value="{{ old('category', $statistic->category) }}"
                       placeholder="Contoh: DIPA Poliban, DIPA DRPM, Mandiri, Ekternal" required>
                @error('category')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="count" class="form-label">Jumlah <span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('count') is-invalid @enderror"
                       id="count" name="count" value="{{ old('count', $statistic->count) }}"
                       min="0" required>
                @error('count')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Update
                </button>
                <a href="{{ route('admin.service-statistics.index') }}" class="btn btn-secondary">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
