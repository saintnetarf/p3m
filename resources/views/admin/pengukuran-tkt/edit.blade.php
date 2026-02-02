@extends('layouts.admin')

@section('title', 'Edit Pengukuran TKT')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Pengukuran TKT</h1>
        <a href="{{ route('admin.pengukuran-tkt.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.pengukuran-tkt.update', $pengukuranTkt) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                   id="title" name="title" value="{{ old('title', $pengukuranTkt->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <input type="text" class="form-control @error('kategori') is-invalid @enderror"
                                       id="kategori" name="kategori" value="{{ old('kategori', $pengukuranTkt->kategori) }}" placeholder="Contoh: Teknologi Informasi">
                                @error('kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="level_tkt" class="form-label">Level TKT</label>
                                <select class="form-select @error('level_tkt') is-invalid @enderror" id="level_tkt" name="level_tkt">
                                    <option value="">Pilih Level</option>
                                    @for($i = 1; $i <= 9; $i++)
                                        <option value="{{ $i }}" {{ old('level_tkt', $pengukuranTkt->level_tkt) == $i ? 'selected' : '' }}>Level {{ $i }}</option>
                                    @endfor
                                </select>
                                @error('level_tkt')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description" name="description" rows="4">{{ old('description', $pengukuranTkt->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="file" class="form-label">File</label>
                            @if($pengukuranTkt->file)
                                <div class="alert alert-info d-flex align-items-center mb-2">
                                    @php
                                        $ext = strtolower($pengukuranTkt->file_type ?? pathinfo($pengukuranTkt->file_name, PATHINFO_EXTENSION));
                                        $iconClass = match($ext) {
                                            'pdf' => 'bi-file-earmark-pdf-fill',
                                            'doc', 'docx' => 'bi-file-earmark-word-fill',
                                            'xls', 'xlsx' => 'bi-file-earmark-excel-fill',
                                            'ppt', 'pptx' => 'bi-file-earmark-ppt-fill',
                                            'zip', 'rar' => 'bi-file-earmark-zip-fill',
                                            default => 'bi-file-earmark-fill'
                                        };
                                    @endphp
                                    <i class="bi {{ $iconClass }} me-2"></i>
                                    <div class="flex-grow-1">
                                        <strong>File saat ini:</strong> {{ $pengukuranTkt->file_name }}
                                        <br><small class="text-muted">{{ number_format($pengukuranTkt->file_size / 1024, 2) }} KB</small>
                                    </div>
                                    <a href="{{ Storage::url($pengukuranTkt->file) }}" target="_blank" class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye"></i> Lihat
                                    </a>
                                </div>
                            @endif
                            <input type="file" class="form-control @error('file') is-invalid @enderror"
                                   id="file" name="file">
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah file. Format: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, ZIP, RAR. Maksimal 20MB</small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.pengukuran-tkt.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Update Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header bg-secondary text-white">
                    <i class="bi bi-clock-history me-2"></i>Informasi Data
                </div>
                <div class="card-body">
                    <table class="table table-sm table-borderless mb-0">
                        <tr>
                            <td class="text-muted">Dibuat:</td>
                            <td><strong>{{ $pengukuranTkt->created_at->format('d M Y H:i') }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Diupdate:</td>
                            <td><strong>{{ $pengukuranTkt->updated_at->format('d M Y H:i') }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Oleh:</td>
                            <td><strong>{{ $pengukuranTkt->author ? $pengukuranTkt->author->name : '-' }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Download:</td>
                            <td><strong>{{ $pengukuranTkt->download_count }}x</strong></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
