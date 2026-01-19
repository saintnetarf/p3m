@extends('layouts.admin')

@section('title', 'Data Penelitian')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Data Penelitian</h2>
    <a href="{{ route('admin.research-statistics.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Data
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tahun</th>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($statistics as $index => $statistic)
                    <tr>
                        <td>{{ $statistics->firstItem() + $index }}</td>
                        <td><span class="badge bg-primary">{{ $statistic->year }}</span></td>
                        <td>{{ $statistic->category }}</td>
                        <td><strong>{{ $statistic->count }}</strong></td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.research-statistics.edit', $statistic->id) }}"
                                   class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.research-statistics.destroy', $statistic->id) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                            <p class="mt-2 mb-0">Belum ada data penelitian</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($statistics->hasPages())
        <div class="d-flex justify-content-center mt-3">
            {{ $statistics->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Summary Card -->
@if($statistics->count() > 0)
<div class="row mt-4">
    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title">Total Data</h5>
                <h2>{{ $statistics->total() }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">Total Penelitian</h5>
                <h2>{{ App\Models\ResearchStatistic::sum('count') }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h5 class="card-title">Tahun Terbaru</h5>
                <h2>{{ $years->first() ?? '-' }}</h2>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
