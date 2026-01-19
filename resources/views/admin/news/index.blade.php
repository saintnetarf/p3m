@extends('layouts.admin')

@section('title', 'Manajemen Berita')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h2 class="mb-0">Manajemen Berita</h2>
        <p class="text-muted">Kelola semua berita dan artikel</p>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Tambah Berita
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="10%">Gambar</th>
                        <th width="30%">Judul</th>
                        <th width="15%">Kategori</th>
                        <th width="12%">Author</th>
                        <th width="10%">Status</th>
                        <th width="13%">Tanggal</th>
                        <th width="5%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($news as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($item->image)
                            <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                            <div class="bg-secondary rounded d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="bi bi-image text-white"></i>
                            </div>
                            @endif
                        </td>
                        <td>
                            <strong>{{ Str::limit($item->title, 50) }}</strong>
                            <br><small class="text-muted"><i class="bi bi-eye"></i> {{ $item->views }} views</small>
                        </td>
                        <td><span class="badge bg-secondary">{{ $item->category->name }}</span></td>
                        <td>{{ $item->author->name }}</td>
                        <td>
                            <span class="badge bg-{{ $item->status === 'published' ? 'success' : 'warning' }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td>{{ $item->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('admin.news.show', $item) }}">
                                        <i class="bi bi-eye me-2"></i>Lihat
                                    </a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.news.edit', $item) }}">
                                        <i class="bi bi-pencil me-2"></i>Edit
                                    </a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('admin.news.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="bi bi-trash me-2"></i>Hapus
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <i class="bi bi-inbox fs-1 text-muted"></i>
                            <p class="text-muted mt-2">Belum ada berita. <a href="{{ route('admin.news.create') }}">Tambah berita pertama</a></p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($news->hasPages())
        <div class="mt-3">
            {{ $news->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
