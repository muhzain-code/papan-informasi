@extends('layouts.dashboard')

@section('content')

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <h3 class="fw-bold">Dashboard</h3>
    <p class="text-gray-600">Ringkasan aktivitas dan statistik sistem</p>
</div>

<div class="page-content">
    <section class="row">

        <!-- LEFT CONTENT -->
        <div class="col-12 col-lg-9">

            {{-- User Welcome --}}
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle overflow-hidden me-3" style="width:65px; height:65px;">
                        <img src="{{ asset('mazer/dist/assets/compiled/jpg/1.jpg') }}"
                             class="w-100 h-100" style="object-fit: cover;">
                    </div>

                    <div>
                        <h4 class="fw-bold mb-0">{{ $user->name }}</h4>
                        <small class="text-gray-600">Selamat datang kembali 👋</small>
                    </div>
                </div>
            </div>

            {{-- Statistic Cards --}}
            <div class="row g-3">

                <!-- Berita -->
                <div class="col-md-4 col-12">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body py-4 d-flex align-items-center">
                            <div class="d-flex justify-content-center align-items-center bg-primary text-white rounded-3 me-3"
                                 style="width:50px; height:50px;">
                                <i class="bi bi-newspaper fs-4"></i>
                            </div>
                            <div>
                                <p class="text-gray-600 mb-1">Total Berita</p>
                                <h3 class="fw-bold mb-0">{{ $newsCount }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informasi -->
                <div class="col-md-4 col-12">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body py-4 d-flex align-items-center">
                            <div class="d-flex justify-content-center align-items-center bg-warning text-white rounded-3 me-3"
                                 style="width:50px; height:50px;">
                                <i class="bi bi-info-circle fs-4"></i>
                            </div>
                            <div>
                                <p class="text-gray-600 mb-1">Informasi</p>
                                <h3 class="fw-bold mb-0">{{ $infoCount }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Video -->
                <div class="col-md-4 col-12">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body py-4 d-flex align-items-center">
                            <div class="d-flex justify-content-center align-items-center bg-danger text-white rounded-3 me-3"
                                 style="width:50px; height:50px;">
                                <i class="bi bi-camera-video fs-4"></i>
                            </div>
                            <div>
                                <p class="text-gray-600 mb-1">Video</p>
                                <h3 class="fw-bold mb-0">{{ $videoCount }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mata Kuliah -->
                <div class="col-md-4 col-12">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body py-4 d-flex align-items-center">
                            <div class="d-flex justify-content-center align-items-center bg-secondary text-white rounded-3 me-3"
                                 style="width:50px; height:50px;">
                                <i class="bi bi-book fs-4"></i>
                            </div>
                            <div>
                                <p class="text-gray-600 mb-1">Mata Kuliah</p>
                                <h3 class="fw-bold mb-0">{{ $courseCount }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ruangan -->
                <div class="col-md-4 col-12">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body py-4 d-flex align-items-center">
                            <div class="d-flex justify-content-center align-items-center bg-info text-white rounded-3 me-3"
                                 style="width:50px; height:50px;">
                                <i class="bi bi-house-door fs-4"></i>
                            </div>
                            <div>
                                <p class="text-gray-600 mb-1">Ruangan</p>
                                <h3 class="fw-bold mb-0">{{ $roomCount }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dosen -->
                <div class="col-md-4 col-12">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body py-4 d-flex align-items-center">
                            <div class="d-flex justify-content-center align-items-center bg-success text-white rounded-3 me-3"
                                 style="width:50px; height:50px;">
                                <i class="bi bi-person-badge fs-4"></i>
                            </div>
                            <div>
                                <p class="text-gray-600 mb-1">Dosen</p>
                                <h3 class="fw-bold mb-0">{{ $lecturerCount }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Recent Activity --}}
            <div class="card mt-4 shadow-sm border-0">
                <div class="card-header border-0">
                    <h4 class="fw-bold mb-0">Aktivitas Terbaru</h4>
                </div>

                <div class="card-body">

                    @if ($recentActivity->count())
                        <ul class="list-group list-group-flush">
                            @foreach ($recentActivity as $act)
                                <li class="list-group-item px-0 d-flex justify-content-between align-items-start">
                                    <div>
                                        <strong>{{ $act->description }}</strong><br>
                                        <small class="text-gray-600">
                                            {{ class_basename($act->subject_type) }}
                                            @if ($act->causer)
                                                — {{ $act->causer->name }}
                                            @endif
                                        </small>
                                    </div>
                                    <small class="text-gray-600">
                                        {{ $act->created_at->diffForHumans() }}
                                    </small>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-600">Belum ada aktivitas terbaru.</p>
                    @endif

                </div>
            </div>

        </div>

        <!-- RIGHT SIDEBAR -->
        <div class="col-12 col-lg-3">

            <div class="card shadow-sm border-0">
                <div class="card-header border-0">
                    <h4 class="fw-bold mb-0">Profil Pengguna</h4>
                </div>

                <div class="card-body">

                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle overflow-hidden me-3" style="width:60px; height:60px;">
                            <img src="{{ asset('mazer/dist/assets/compiled/jpg/1.jpg') }}"
                                 class="w-100 h-100" style="object-fit: cover;">
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">{{ $user->name }}</h6>
                            <small class="text-gray-600">User aktif</small>
                        </div>
                    </div>

                    <hr>

                    <p class="fw-semibold mb-1">Email</p>
                    <p class="text-gray-600">{{ $user->email }}</p>

                    {{-- <p class="fw-semibold mb-1">Role</p>
                    <p class="text-gray-600">{{ $user->role }}</p> --}}

                    <p class="fw-semibold mb-1">Login Terakhir</p>
                    <p class="text-gray-600">{{ $user->last_login }}</p>

                </div>
            </div>

        </div>

    </section>
</div>

@endsection
