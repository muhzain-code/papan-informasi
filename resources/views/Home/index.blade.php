@extends('layouts.dashboard')

@section('content')

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <h3>Dashboard</h3>
    <p class="text-muted">Ringkasan informasi sistem</p>
</div>

<div class="page-content">
<section class="row">

    <!-- LEFT MAIN CONTENT -->
    <div class="col-12 col-lg-9">

        {{-- USER CARD --}}
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-body d-flex align-items-center">
                <div class="avatar avatar-xl me-3">
                    <img src="{{ asset('mazer/dist/assets/compiled/jpg/1.jpg') }}" alt="">
                </div>

                <div>
                    <h4 class="mb-0 fw-bold">{{ Auth::user()->name }}</h4>
                    <small class="text-muted">Selamat datang kembali 👋</small>
                </div>
            </div>
        </div>

        {{-- STAT CARDS --}}
        <div class="row g-3">

            <div class="col-md-4 col-12">
                <div class="card shadow-sm border-0 stat-card">
                    <div class="card-body py-4 d-flex align-items-center">
                        <div class="stats-icon bg-primary text-white me-3">
                            <i class="bi bi-newspaper"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Total Berita</h6>
                            <h3 class="fw-bold mb-0">{{ $newsCount }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-12">
                <div class="card shadow-sm border-0 stat-card">
                    <div class="card-body py-4 d-flex align-items-center">
                        <div class="stats-icon bg-success text-white me-3">
                            <i class="bi bi-calendar-event"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Total Agenda</h6>
                            <h3 class="fw-bold mb-0">{{ $agendaCount }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-12">
                <div class="card shadow-sm border-0 stat-card">
                    <div class="card-body py-4 d-flex align-items-center">
                        <div class="stats-icon bg-warning text-white me-3">
                            <i class="bi bi-envelope-paper"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Pesan Masuk</h6>
                            <h3 class="fw-bold mb-0">{{ $contactCount }}</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- RECENT ACTIVITY --}}
        <div class="card mt-4 shadow-sm border-0">
            <div class="card-header border-0">
                <h4 class="fw-bold mb-0">Aktivitas Terbaru</h4>
            </div>

            <div class="card-body">

                @if ($recentActivity->count() > 0)

                    <ul class="list-group">
                        @foreach ($recentActivity as $act)
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 border-bottom">
                                <div>
                                    <strong>{{ $act->description }}</strong><br>
                                    <small class="text-muted">Model: {{ $act->subject_type }}</small>
                                </div>
                                <small class="text-muted">{{ $act->created_at->diffForHumans() }}</small>
                            </li>
                        @endforeach
                    </ul>

                @else
                    <p class="text-muted">Belum ada aktivitas terbaru.</p>
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
                    <div class="avatar avatar-lg me-3">
                        <img src="{{ asset('mazer/dist/assets/compiled/jpg/1.jpg') }}" alt="">
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">{{ Auth::user()->name }}</h6>
                        <small class="text-muted">User aktif</small>
                    </div>
                </div>

                <hr>

                <p class="mb-1 fw-semibold">Email</p>
                <p class="text-muted">{{ Auth::user()->email }}</p>

                <p class="mb-1 fw-semibold">Role</p>
                <p class="text-muted">{{ Auth::user()->role }}</p>

                <p class="mb-1 fw-semibold">Login Terakhir</p>
                <p class="text-muted">{{ Auth::user()->last_login }}</p>

            </div>
        </div>

    </div>

</section>
</div>

@endsection
