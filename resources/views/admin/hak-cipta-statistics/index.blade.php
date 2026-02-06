@extends('layouts.admin')

@section('title', 'Data Hak Cipta')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Data Hak Cipta</h2>
    <a href="{{ route('admin.hak-cipta-statistics.create') }}" class="btn btn-danger">
        <i class="bi bi-plus-circle me-1"></i> Tambah Data
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
                <thead class="table-danger">
                    <tr>
                        <th>No</th>
                        <th>Tahun</th>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($statistics as $index => $stat)
                    <tr>
                        <td>{{ $statistics->firstItem() + $index }}</td>
                        <td>{{ $stat->year }}</td>
                        {{-- <td>
                            <span class="badge bg-danger">{{ $stat->category }}</span>
                        </td> --}}
                        <td>{{ $stat->category }}</td>
                        <td>{{ $stat->count }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.hak-cipta-statistics.edit', $stat->id) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.hak-cipta-statistics.destroy', $stat->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
                        <td colspan="5" class="text-center text-muted">Belum ada data hak cipta</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $statistics->links() }}
        </div>
    </div>
</div>

<!-- Cards Summary -->
<div class="row mt-4">
    @foreach($years as $year)
    @php
        $yearStats = \App\Models\HakCiptaStatistic::where('year', $year)->get();
        $totalCount = $yearStats->sum('count');
    @endphp
    <div class="col-md-3 mb-3">
        <div class="card border-danger">
            <div class="card-body">
                <h6 class="card-subtitle mb-2 text-danger">Tahun {{ $year }}</h6>
                <h3 class="card-title">{{ $totalCount }}</h3>
                <p class="card-text text-muted small">Total Hak Cipta</p>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
