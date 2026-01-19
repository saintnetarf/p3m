@extends('layouts.admin')

@section('title', 'Produk Penelitian')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Produk Penelitian</h1>
        <a href="{{ route('admin.research-products.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Tambah Produk
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="width: 10%;">Gambar</th>
                            <th style="width: 25%;">Judul</th>
                            <th style="width: 12%;">Peneliti</th>
                            <th style="width: 12%;">Kategori</th>
                            <th style="width: 8%;" class="text-center">Tahun</th>
                            <th style="width: 10%;">Penulis</th>
                            <th style="width: 10%;" class="text-center">Status</th>
                            <th style="width: 8%;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}</td>
                                <td>
                                    @if($product->image)
                                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->title }}" class="img-thumbnail" style="max-height: 60px; max-width: 80px; object-fit: cover;">
                                    @else
                                        <div class="bg-light text-center p-2" style="width: 80px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $product->title }}</strong>
                                    @if($product->file)
                                        <br><small class="text-muted"><i class="bi bi-file-earmark-pdf"></i> File tersedia</small>
                                    @endif
                                </td>
                                <td>{{ $product->researcher }}</td>
                                <td>
                                    @if($product->category == 'Penelitian')
                                        <span class="badge bg-primary">{{ $product->category }}</span>
                                    @elseif($product->category == 'Pengabdian Masyarakat')
                                        <span class="badge bg-success">{{ $product->category }}</span>
                                    @else
                                        <span class="badge bg-info">{{ $product->category }}</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $product->year }}</td>
                                <td>{{ $product->author->name }}</td>
                                <td class="text-center">
                                    @if($product->is_featured)
                                        <span class="badge bg-warning text-dark"><i class="bi bi-star-fill"></i> Unggulan</span>
                                    @else
                                        <span class="badge bg-secondary">Regular</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            @if($product->file)
                                                <li>
                                                    <a class="dropdown-item" href="{{ Storage::url($product->file) }}" target="_blank">
                                                        <i class="bi bi-download me-2"></i>Download File
                                                    </a>
                                                </li>
                                                <li><hr class="dropdown-divider"></li>
                                            @endif
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.research-products.edit', $product) }}">
                                                    <i class="bi bi-pencil me-2"></i>Edit
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('admin.research-products.destroy', $product) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk penelitian ini?');">
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
                                <td colspan="9" class="text-center py-4">
                                    <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                                    <p class="text-muted mt-2">Belum ada produk penelitian</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($products->hasPages())
                <div class="d-flex justify-content-center mt-3">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
