@extends('layouts.frontend')

@section('title', 'Profile')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold mb-2">
                    <i class="bi bi-building me-3"></i>Profile P3M
                </h1>
                <p class="lead mb-0">Pusat Penelitian dan Pengabdian kepada Masyarakat</p>
                <p class="lead">Politeknik Negeri Banjarmasin</p>
            </div>
        </div>
    </div>
</div>

<!-- Profile Content -->
<div class="container my-5">
    <div class="row">
        <!-- Profil Unit -->
        <div class="col-lg-12 mb-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="bi bi-info-circle-fill text-primary" style="font-size: 4rem;"></i>
                        <h2 class="mt-3 mb-4 fw-bold text-primary">Profil Unit</h2>
                    </div>

                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <p class="lead text-muted mb-4" style="text-align: justify;">
                                Pusat Penelitian dan Pengabdian Kepada Masyarakat (P3M) Politeknik Negeri Banjarmasin merupakan unit kerja yang mempunyai tugas menyelenggarakan, mengkoordinasikan, memantau, dan mengevaluasi kegiatan penelitian dan pengabdian kepada masyarakat.
                            </p>

                            {{-- <p class="text-muted mb-4" style="text-align: justify;">
                                P3M berkomitmen untuk mendorong sivitas akademika dalam menghasilkan penelitian yang
                                berkualitas, inovatif, dan berdampak nyata bagi kemajuan ilmu pengetahuan dan teknologi,
                                serta kesejahteraan masyarakat. Melalui berbagai program pengabdian kepada masyarakat,
                                P3M juga berperan aktif dalam mentransfer pengetahuan dan teknologi kepada masyarakat
                                untuk meningkatkan kualitas hidup dan pembangunan daerah.
                            </p> --}}

                            <div class="bg-light p-4 rounded">
                                <h5 class="fw-bold mb-3"><i class="bi bi-gear-fill text-primary me-2"></i>Tugas dan Fungsi P3M</h5>
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Pelaksanaan kegiatan penelitian dan pengabdian kepada masyarakat</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Koordinasi, pemantauan, dan evaluasi pelaksanaan kegiatan  penelitian dan pengabdian kepada masyarakat</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>pelaksanaan penyebarluasan dan publikasi hasil penelitian dan pengabdian kepada masyarakat</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Pelaksanaan kerjasama di bidang penelitian dan pengabdian kepada masyarakat </li>
                               </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Visi -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="bi bi-eye-fill text-primary" style="font-size: 4rem;"></i>
                        <h2 class="mt-3 mb-4 fw-bold text-primary">Visi</h2>
                    </div>

                    <div class="bg-primary bg-opacity-10 p-4 rounded">
                        <p class="lead mb-0 text-center fw-semibold" style="text-align: justify;">
                            Menjadi pusat inovasi ilmu pengetahuan dan teknologi melalui kegiatan penelitian dan pengabdian kepada masyarakat yang mampu menjadi agen perubahan dalam menghadapi tantangan globalisasi
                        </p>
                    </div>

                    <div class="mt-4">
                        <div class="d-flex align-items-start mb-3">
                            <i class="bi bi-star-fill text-warning fs-4 me-3"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Unggulan</h6>
                                <p class="text-muted small mb-0">Menjadi rujukan dalam penelitian dan pengabdian</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                            <i class="bi bi-lightbulb-fill text-warning fs-4 me-3"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Inovatif</h6>
                                <p class="text-muted small mb-0">Menghasilkan karya penelitian yang inovatif</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start">
                            <i class="bi bi-people-fill text-warning fs-4 me-3"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Berdampak</h6>
                                <p class="text-muted small mb-0">Memberikan manfaat nyata bagi masyarakat</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Misi -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="bi bi-bullseye text-success" style="font-size: 4rem;"></i>
                        <h2 class="mt-3 mb-4 fw-bold text-success">Misi</h2>
                    </div>

                    <div class="list-group list-group-flush">
                        <div class="list-group-item border-0 px-0">
                            <div class="d-flex align-items-start">
                                <span class="badge bg-success rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">1</span>
                                <p class="mb-0" style="text-align: justify;">
                                    Membangun dan mengembangkan kemampuan dalam mewujudkan penelitian terapan dan pengabdian kepada masyarakat yang dapat memajukan dan memberdayakan masyarakat serta meningkatkan daya saing perguruan tinggi
                                </p>
                            </div>
                        </div>

                        <div class="list-group-item border-0 px-0">
                            <div class="d-flex align-items-start">
                                <span class="badge bg-success rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">2</span>
                                <p class="mb-0" style="text-align: justify;">
                                    Melaksanakan manajemen yang akuntabel dan transparan dengan mengacu pada Standar Nasional Pendidikan Tinggi
                                </p>
                            </div>
                        </div>

                        <div class="list-group-item border-0 px-0">
                            <div class="d-flex align-items-start">
                                <span class="badge bg-success rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">3</span>
                                <p class="mb-0" style="text-align: justify;">
                                    Mengembangkan jejaring kerjasama penelitian dan pengabdian kepada masyarakat pada tingkat regional, nasional, dan internasional.
                                </p>
                            </div>
                        </div>

                        {{-- <div class="list-group-item border-0 px-0">
                            <div class="d-flex align-items-start">
                                <span class="badge bg-success rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">4</span>
                                <p class="mb-0" style="text-align: justify;">
                                    Membangun kolaborasi strategis dengan industri, pemerintah, dan institusi lain
                                </p>
                            </div>
                        </div>

                        <div class="list-group-item border-0 px-0">
                            <div class="d-flex align-items-start">
                                <span class="badge bg-success rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">5</span>
                                <p class="mb-0" style="text-align: justify;">
                                    Meningkatkan kapasitas dan kompetensi sivitas akademika dalam penelitian dan pengabdian
                                </p>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card bg-primary text-white border-0 shadow">
                <div class="card-body p-5 text-center">
                    <h3 class="mb-3"><i class="bi bi-hand-thumbs-up-fill me-2"></i>Mari Berkolaborasi!</h3>
                    <p class="lead mb-4">
                        Bergabunglah dengan kami dalam mengembangkan penelitian dan pengabdian yang berdampak
                        untuk kemajuan masyarakat dan industri
                    </p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <a href="{{ route('research.index') }}" class="btn btn-light btn-lg">
                            <i class="bi bi-book me-2"></i>Lihat Produk Penelitian
                        </a>
                        <a href="{{ route('announcements.index') }}" class="btn btn-outline-light btn-lg">
                            <i class="bi bi-megaphone me-2"></i>Lihat Pengumuman
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
