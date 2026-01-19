@extends('layouts.admin')

@section('title', 'Edit Header')

@section('content')
<div class="mb-4">
    <h2>Edit Header</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.headers.index') }}">Header</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.headers.update', $header->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="institution_name" class="form-label">Nama Institusi <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('institution_name') is-invalid @enderror"
                       id="institution_name" name="institution_name" value="{{ old('institution_name', $header->institution_name) }}" required>
                @error('institution_name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="logo" class="form-label">Logo</label>
                @if($header->logo)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $header->logo) }}" alt="Current Logo" style="max-height: 100px;">
                    <p class="text-muted small mb-0">Logo saat ini</p>
                </div>
                @endif
                <input type="file" class="form-control @error('logo') is-invalid @enderror"
                       id="logo" name="logo" accept="image/*">
                @error('logo')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengubah.</div>
            </div>

            <div class="mb-3">
                <label for="menu_items" class="form-label">Menu Items (JSON)</label>
                <textarea class="form-control @error('menu_items') is-invalid @enderror"
                          id="menu_items" name="menu_items" rows="5"
                          placeholder='[{"title": "Home", "url": "/"}, {"title": "About", "url": "/about"}]'>{{ old('menu_items', $header->menu_items ? json_encode($header->menu_items, JSON_PRETTY_PRINT) : '') }}</textarea>
                @error('menu_items')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Format JSON array untuk item menu navigasi</div>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="is_active" name="is_active"
                       {{ old('is_active', $header->is_active) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">
                    Aktif
                </label>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Update
                </button>
                <a href="{{ route('admin.headers.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
