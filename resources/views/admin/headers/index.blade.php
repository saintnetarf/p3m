@extends('layouts.admin')

@section('title', 'Manajemen Header')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manajemen Header</h2>
    <a href="{{ route('admin.headers.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah Header
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Logo</th>
                        <th>Nama Institusi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($headers as $index => $header)
                    <tr>
                        <td>{{ $headers->firstItem() + $index }}</td>
                        <td>
                            @if($header->logo)
                            <img src="{{ asset('storage/' . $header->logo) }}" alt="Logo" style="height: 40px;">
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $header->institution_name }}</td>
                        <td>
                            @if($header->is_active)
                            <span class="badge bg-success">Aktif</span>
                            @else
                            <span class="badge bg-secondary">Tidak Aktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.headers.edit', $header->id) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.headers.destroy', $header->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus header ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada header</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $headers->links() }}
        </div>
    </div>
</div>
@endsection
