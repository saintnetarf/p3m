@extends('layouts.frontend')

@section('title', 'Grafik Statistik')

@push('styles')
<style>
    .chart-container {
        position: relative;
        height: 450px;
        margin-bottom: 2rem;
    }
</style>
@endpush

@section('content')

<!-- Page Header -->
<div class="bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-5 fw-bold mb-3">Grafik Statistik</h1>
                <p class="lead">Tren data penelitian dan pengabdian kepada masyarakat berdasarkan tahun dan kategori</p>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <!-- Research Chart -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-graph-up me-2"></i>Tren Penelitian per Tahun (Berdasarkan Kategori)</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="researchChart"></canvas>
                    </div>
                    <div class="text-muted small mt-3">
                        <i class="bi bi-info-circle me-1"></i>
                        Grafik menampilkan jumlah penelitian per tahun, dikelompokkan berdasarkan kategori.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Service Chart -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="bi bi-graph-up me-2"></i>Tren Pengabdian Masyarakat per Tahun (Berdasarkan Kategori)</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="serviceChart"></canvas>
                    </div>
                    <div class="text-muted small mt-3">
                        <i class="bi bi-info-circle me-1"></i>
                        Grafik menampilkan jumlah pengabdian masyarakat per tahun, dikelompokkan berdasarkan kategori.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Publication Chart -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="bi bi-graph-up me-2"></i>Tren Jurnal per Tahun (Berdasarkan Kategori)</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="publicationChart"></canvas>
                    </div>
                    <div class="text-muted small mt-3">
                        <i class="bi bi-info-circle me-1"></i>
                        Grafik menampilkan jumlah publikasi per tahun, dikelompokkan berdasarkan kategori.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Proseding Chart -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="bi bi-graph-up me-2"></i>Tren Prosiding per Tahun (Berdasarkan Kategori)</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="prosedingChart"></canvas>
                    </div>
                    <div class="text-muted small mt-3">
                        <i class="bi bi-info-circle me-1"></i>
                        Grafik menampilkan jumlah prosiding per tahun, dikelompokkan berdasarkan kategori.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hak Cipta Chart -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0"><i class="bi bi-graph-up me-2"></i>Tren KI per Tahun (Berdasarkan Kategori)</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="hakCiptaChart"></canvas>
                    </div>
                    <div class="text-muted small mt-3">
                        <i class="bi bi-info-circle me-1"></i>
                        Grafik menampilkan jumlah KI per tahun, dikelompokkan berdasarkan kategori.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Book Chart -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="bi bi-graph-up me-2"></i>Tren Buku Ber-ISBN per Tahun (Berdasarkan Kategori)</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="bookChart"></canvas>
                    </div>
                    <div class="text-muted small mt-3">
                        <i class="bi bi-info-circle me-1"></i>
                        Grafik menampilkan jumlah buku per tahun, dikelompokkan berdasarkan kategori.
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Info Card -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0 bg-light">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <i class="bi bi-info-circle-fill text-primary me-3" style="font-size: 2rem;"></i>
                        <div>
                            <h6 class="mb-2">Tentang Grafik</h6>
                            <p class="mb-1">Data grafik diperbarui secara real-time berdasarkan input dari admin sistem.</p>
                            <p class="mb-0 text-muted small">Setiap garis pada grafik merepresentasikan kategori atau program studi yang berbeda, memudahkan untuk melihat tren dan perbandingan antar kategori dari tahun ke tahun.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
    // Configuration for Research Line Chart
    fetch('{{ route('charts.research.data') }}')
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('researchChart');

            if (data.datasets.length === 0) {
                document.getElementById('researchChart').parentElement.innerHTML =
                    '<div class="alert alert-info text-center"><i class="bi bi-info-circle me-2"></i>Belum ada data penelitian tersedia</div>';
                return;
            }

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: data.datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                callback: function(value) {
                                    return Number.isInteger(value) ? value : '';
                                }
                            },
                            title: {
                                display: true,
                                text: 'Jumlah Penelitian'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Tahun'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                padding: 15
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            callbacks: {
                                title: function(context) {
                                    return 'Tahun ' + context[0].label;
                                },
                                label: function(context) {
                                    return context.dataset.label + ': ' + context.parsed.y + ' penelitian';
                                }
                            }
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error loading research data:', error);
            document.getElementById('researchChart').parentElement.innerHTML =
                '<div class="alert alert-danger"><i class="bi bi-exclamation-triangle me-2"></i>Gagal memuat data penelitian</div>';
        });

    // Configuration for Service Line Chart
    fetch('{{ route('charts.service.data') }}')
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('serviceChart');

            if (data.datasets.length === 0) {
                document.getElementById('serviceChart').parentElement.innerHTML =
                    '<div class="alert alert-info text-center"><i class="bi bi-info-circle me-2"></i>Belum ada data pengabdian tersedia</div>';
                return;
            }

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: data.datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                callback: function(value) {
                                    return Number.isInteger(value) ? value : '';
                                }
                            },
                            title: {
                                display: true,
                                text: 'Jumlah Pengabdian'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Tahun'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                padding: 15
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            callbacks: {
                                title: function(context) {
                                    return 'Tahun ' + context[0].label;
                                },
                                label: function(context) {
                                    return context.dataset.label + ': ' + context.parsed.y + ' pengabdian';
                                }
                            }
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error loading service data:', error);
            document.getElementById('serviceChart').parentElement.innerHTML =
                '<div class="alert alert-danger"><i class="bi bi-exclamation-triangle me-2"></i>Gagal memuat data pengabdian</div>';
        });

    // Configuration for Publication Line Chart
    fetch('{{ route('charts.publication.data') }}')
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('publicationChart');

            if (data.datasets.length === 0) {
                document.getElementById('publicationChart').parentElement.innerHTML =
                    '<div class="alert alert-info text-center"><i class="bi bi-info-circle me-2"></i>Belum ada data publikasi tersedia</div>';
                return;
            }

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: data.datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                callback: function(value) {
                                    return Number.isInteger(value) ? value : '';
                                }
                            },
                            title: {
                                display: true,
                                text: 'Jumlah Publikasi'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Tahun'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                padding: 15
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            callbacks: {
                                title: function(context) {
                                    return 'Tahun ' + context[0].label;
                                },
                                label: function(context) {
                                    return context.dataset.label + ': ' + context.parsed.y + ' publikasi';
                                }
                            }
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error loading publication data:', error);
            document.getElementById('publicationChart').parentElement.innerHTML =
                '<div class="alert alert-danger"><i class="bi bi-exclamation-triangle me-2"></i>Gagal memuat data publikasi</div>';
        });

    // Configuration for Proseding Line Chart
    fetch('{{ route('charts.proseding.data') }}')
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('prosedingChart');

            if (data.datasets.length === 0) {
                document.getElementById('prosedingChart').parentElement.innerHTML =
                    '<div class="alert alert-info text-center"><i class="bi bi-info-circle me-2"></i>Belum ada data proseding tersedia</div>';
                return;
            }

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: data.datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                callback: function(value) {
                                    return Number.isInteger(value) ? value : '';
                                }
                            },
                            title: {
                                display: true,
                                text: 'Jumlah Proseding'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Tahun'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                padding: 15
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            callbacks: {
                                title: function(context) {
                                    return 'Tahun ' + context[0].label;
                                },
                                label: function(context) {
                                    return context.dataset.label + ': ' + context.parsed.y + ' proseding';
                                }
                            }
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error loading proseding data:', error);
            document.getElementById('prosedingChart').parentElement.innerHTML =
                '<div class="alert alert-danger"><i class="bi bi-exclamation-triangle me-2"></i>Gagal memuat data proseding</div>';
        });

    // Configuration for Book Line Chart
    fetch('{{ route('charts.book.data') }}')
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('bookChart');

            if (data.datasets.length === 0) {
                document.getElementById('bookChart').parentElement.innerHTML =
                    '<div class="alert alert-info text-center"><i class="bi bi-info-circle me-2"></i>Belum ada data buku tersedia</div>';
                return;
            }

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: data.datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                callback: function(value) {
                                    return Number.isInteger(value) ? value : '';
                                }
                            },
                            title: {
                                display: true,
                                text: 'Jumlah Buku'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Tahun'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                padding: 15
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            callbacks: {
                                title: function(context) {
                                    return 'Tahun ' + context[0].label;
                                },
                                label: function(context) {
                                    return context.dataset.label + ': ' + context.parsed.y + ' buku';
                                }
                            }
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error loading book data:', error);
            document.getElementById('bookChart').parentElement.innerHTML =
                '<div class="alert alert-danger"><i class="bi bi-exclamation-triangle me-2"></i>Gagal memuat data buku</div>';
        });

    // Fetch and render Hak Cipta chart
    fetch('/api/chart/hak-cipta')
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('hakCiptaChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: data.datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            },
                            title: {
                                display: true,
                                text: 'Jumlah Hak Cipta'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Tahun'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                padding: 15
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            callbacks: {
                                title: function(context) {
                                    return 'Tahun ' + context[0].label;
                                },
                                label: function(context) {
                                    return context.dataset.label + ': ' + context.parsed.y + ' hak cipta';
                                }
                            }
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error loading hak cipta data:', error);
            document.getElementById('hakCiptaChart').parentElement.innerHTML =
                '<div class="alert alert-danger"><i class="bi bi-exclamation-triangle me-2"></i>Gagal memuat data hak cipta</div>';
        });
</script>
@endpush
