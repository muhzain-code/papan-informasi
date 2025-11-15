@extends('layouts.dashboard')

@section('content')

    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>Dashboard</h3>
        <p class="text-muted">Ringkasan informasi penting sistem</p>
    </div>

    <div class="page-content">
        <section class="row">

            <!-- LEFT CONTENT -->
            <div class="col-12 col-lg-9">

                {{-- USER CARD --}}
                <div class="card mb-4">
                    <div class="card-body d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="{{ asset('mazer/dist/assets/compiled/jpg/1.jpg') }}" alt="">
                        </div>

                        <div class="ms-3">
                            <h4 class="mb-0">{{ Auth::user()->name }}</h4>
                            <small class="text-muted">Selamat datang kembali</small>
                        </div>
                    </div>
                </div>

                {{-- STAT CARDS --}}
                <div class="row">

                    <div class="col-md-4 col-12">
                        <div class="card">
                            <div class="card-body py-4 d-flex align-items-center">
                                <div class="stats-icon bg-primary text-white me-3">
                                    <i class="bi bi-newspaper"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted mb-1">Total Berita</h6>
                                    <h4 class="mb-0">{{ $newsCount }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-12">
                        <div class="card">
                            <div class="card-body py-4 d-flex align-items-center">
                                <div class="stats-icon bg-success text-white me-3">
                                    <i class="bi bi-calendar-event"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted mb-1">Total Agenda</h6>
                                    <h4 class="mb-0">{{ $agendaCount }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-12">
                        <div class="card">
                            <div class="card-body py-4 d-flex align-items-center">
                                <div class="stats-icon bg-warning text-white me-3">
                                    <i class="bi bi-envelope-paper"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted mb-1">Pesan Masuk</h6>
                                    <h4 class="mb-0">{{ $contactCount }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- RECENT ACTIVITY --}}
                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Aktivitas Terbaru</h4>
                    </div>
                    <div class="card-body">
                        @if ($recentActivity->count() > 0)
                            <ul class="list-group">
                                @foreach ($recentActivity as $act)
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>{{ $act->activity }}</span>
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

                <div class="card">
                    <div class="card-header">
                        <h4>Profil Pengguna</h4>
                    </div>

                    <div class="card-body">

                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar avatar-lg">
                                <img src="{{ asset('mazer/dist/assets/compiled/jpg/1.jpg') }}" alt="">
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                <small class="text-muted">User aktif</small>
                            </div>
                        </div>

                        <hr>

                        <p class="mb-1"><strong>Email</strong></p>
                        <p class="text-muted">{{ Auth::user()->email }}</p>

                        <p class="mb-1"><strong>Role</strong></p>
                        <p class="text-muted">{{ Auth::user()->role }}</p>

                        <p class="mb-1"><strong>Login Terakhir</strong></p>
                        <p class="text-muted">{{ Auth::user()->last_login }}</p>

                    </div>
                </div>

            </div>

        </section>
    </div>

@endsection
