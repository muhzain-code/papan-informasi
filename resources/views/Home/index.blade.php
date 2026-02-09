@extends('layouts.dashboard')

@section('content')

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <h3 class="fw-bold">Dashboard</h3>
    <p class="text-subtitle text-muted">Ringkasan aktivitas dan statistik sistem</p>
</div>

<div class="page-content">
    <section class="row">

        <!-- LEFT CONTENT -->
        <div class="col-12 col-lg-8">

            {{-- User Welcome --}}
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-body d-flex align-items-center py-3">
                    <div class="rounded-circle overflow-hidden me-3 flex-shrink-0" style="width:55px; height:55px;">
                        <img src="{{ asset('mazer/dist/assets/compiled/jpg/1.jpg') }}"
                             class="w-100 h-100" style="object-fit: cover;" alt="Avatar">
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">{{ $user->name }}</h5>
                        <small class="text-muted">Selamat datang kembali 👋</small>
                    </div>
                </div>
            </div>

            {{-- Statistic Cards - Row 1: Konten --}}
            <div class="row g-3 mb-3">
                <div class="col-6 col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body py-3 px-3">
                            <div class="d-flex align-items-center">
                                <div class="d-flex justify-content-center align-items-center rounded-3 me-3 flex-shrink-0"
                                     style="width:45px; height:45px; background-color: rgba(67, 94, 190, 0.15);">
                                    <i class="bi bi-newspaper fs-5" style="color: #435ebe;"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-muted mb-0 small">Berita</p>
                                    <h4 class="fw-bold mb-0">{{ $newsCount }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body py-3 px-3">
                            <div class="d-flex align-items-center">
                                <div class="d-flex justify-content-center align-items-center rounded-3 me-3 flex-shrink-0"
                                     style="width:45px; height:45px; background-color: rgba(255, 171, 0, 0.15);">
                                    <i class="bi bi-info-circle fs-5" style="color: #ffab00;"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-muted mb-0 small">Informasi</p>
                                    <h4 class="fw-bold mb-0">{{ $infoCount }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body py-3 px-3">
                            <div class="d-flex align-items-center">
                                <div class="d-flex justify-content-center align-items-center rounded-3 me-3 flex-shrink-0"
                                     style="width:45px; height:45px; background-color: rgba(220, 53, 69, 0.15);">
                                    <i class="bi bi-camera-video fs-5" style="color: #dc3545;"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-muted mb-0 small">Video</p>
                                    <h4 class="fw-bold mb-0">{{ $videoCount }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Statistic Cards - Row 2: Akademik --}}
            <div class="row g-3 mb-4">
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body py-3 px-3">
                            <div class="d-flex align-items-center">
                                <div class="d-flex justify-content-center align-items-center rounded-3 me-3 flex-shrink-0"
                                     style="width:40px; height:40px; background-color: rgba(67, 94, 190, 0.15);">
                                    <i class="bi bi-calendar-week fs-6" style="color: #435ebe;"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-muted mb-0 small">Jadwal</p>
                                    <h5 class="fw-bold mb-0">{{ $jadwalCount }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body py-3 px-3">
                            <div class="d-flex align-items-center">
                                <div class="d-flex justify-content-center align-items-center rounded-3 me-3 flex-shrink-0"
                                     style="width:40px; height:40px; background-color: rgba(25, 135, 84, 0.15);">
                                    <i class="bi bi-building fs-6" style="color: #198754;"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-muted mb-0 small">Fakultas</p>
                                    <h5 class="fw-bold mb-0">{{ $fakultasCount }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body py-3 px-3">
                            <div class="d-flex align-items-center">
                                <div class="d-flex justify-content-center align-items-center rounded-3 me-3 flex-shrink-0"
                                     style="width:40px; height:40px; background-color: rgba(13, 202, 240, 0.15);">
                                    <i class="bi bi-mortarboard fs-6" style="color: #0dcaf0;"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-muted mb-0 small">Prodi</p>
                                    <h5 class="fw-bold mb-0">{{ $prodiCount }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body py-3 px-3">
                            <div class="d-flex align-items-center">
                                <div class="d-flex justify-content-center align-items-center rounded-3 me-3 flex-shrink-0"
                                     style="width:40px; height:40px; background-color: rgba(108, 117, 125, 0.15);">
                                    <i class="bi bi-book fs-6" style="color: #6c757d;"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-muted mb-0 small">Mata Kuliah</p>
                                    <h5 class="fw-bold mb-0">{{ $mataKuliahCount }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Recent Activity --}}
            <div class="card shadow-sm border-0">
                <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-activity me-2"></i>Aktivitas Terbaru
                    </h5>
                    @if ($recentActivity->count())
                        <span class="badge bg-primary rounded-pill">{{ $recentActivity->count() }}</span>
                    @endif
                </div>

                <div class="card-body p-0">
                    @if ($recentActivity->count())
                        <div class="list-group list-group-flush">
                            @foreach ($recentActivity as $act)
                                <div class="list-group-item list-group-item-action border-0 px-4 py-3">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="d-flex align-items-start me-3">
                                            @php
                                                $actIcon = 'bi-circle';
                                                $actColor = '#6c757d';
                                                $desc = strtolower($act->description);
                                                if (str_contains($desc, 'created') || str_contains($desc, 'membuat')) {
                                                    $actIcon = 'bi-plus-circle-fill';
                                                    $actColor = '#198754';
                                                } elseif (str_contains($desc, 'updated') || str_contains($desc, 'mengubah')) {
                                                    $actIcon = 'bi-pencil-fill';
                                                    $actColor = '#ffab00';
                                                } elseif (str_contains($desc, 'deleted') || str_contains($desc, 'menghapus')) {
                                                    $actIcon = 'bi-trash-fill';
                                                    $actColor = '#dc3545';
                                                }
                                            @endphp
                                            <i class="bi {{ $actIcon }} me-3 mt-1 flex-shrink-0" style="color: {{ $actColor }}; font-size: 0.85rem;"></i>
                                            <div class="min-w-0">
                                                <p class="mb-1 fw-semibold text-truncate" style="max-width: 400px;">{{ $act->description }}</p>
                                                <small class="text-muted">
                                                    <i class="bi bi-tag me-1"></i>{{ class_basename($act->subject_type) }}
                                                    @if ($act->causer)
                                                        <span class="mx-1">•</span>
                                                        <i class="bi bi-person me-1"></i>{{ $act->causer->name }}
                                                    @endif
                                                </small>
                                            </div>
                                        </div>
                                        <small class="text-muted text-nowrap flex-shrink-0">
                                            {{ $act->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-clock-history fs-1 text-muted d-block mb-2"></i>
                            <p class="text-muted mb-0">Belum ada aktivitas terbaru.</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>

        <!-- RIGHT SIDEBAR -->
        <div class="col-12 col-lg-4 mt-4 mt-lg-0">

            {{-- Profil Pengguna --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header border-bottom">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-person-circle me-2"></i>Profil Pengguna
                    </h5>
                </div>

                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="rounded-circle overflow-hidden mx-auto mb-3" style="width:80px; height:80px;">
                            <img src="{{ asset('mazer/dist/assets/compiled/jpg/1.jpg') }}"
                                 class="w-100 h-100" style="object-fit: cover;" alt="Avatar">
                        </div>
                        <h6 class="fw-bold mb-1">{{ $user->name }}</h6>
                        <span class="badge bg-primary rounded-pill">Admin</span>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-envelope me-2 text-muted"></i>
                            <small class="fw-semibold text-muted">Email</small>
                        </div>
                        <p class="mb-0 ps-4 small">{{ $user->email }}</p>
                    </div>

                    <div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-clock-history me-2 text-muted"></i>
                            <small class="fw-semibold text-muted">Login Terakhir</small>
                        </div>
                        <p class="mb-0 ps-4 small">{{ $user->last_login ?? '-' }}</p>
                    </div>
                </div>
            </div>

            {{-- Quick Stats Summary --}}
            <div class="card shadow-sm border-0">
                <div class="card-header border-bottom">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-bar-chart me-2"></i>Ringkasan
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center px-4 py-3">
                            <span class="text-muted small"><i class="bi bi-newspaper me-2"></i>Total Berita</span>
                            <span class="badge bg-primary rounded-pill">{{ $newsCount }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-4 py-3">
                            <span class="text-muted small"><i class="bi bi-info-circle me-2"></i>Total Informasi</span>
                            <span class="badge bg-warning rounded-pill">{{ $infoCount }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-4 py-3">
                            <span class="text-muted small"><i class="bi bi-camera-video me-2"></i>Total Video</span>
                            <span class="badge bg-danger rounded-pill">{{ $videoCount }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-4 py-3">
                            <span class="text-muted small"><i class="bi bi-calendar-week me-2"></i>Total Jadwal</span>
                            <span class="badge bg-info rounded-pill">{{ $jadwalCount }}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
</div>

@endsection
