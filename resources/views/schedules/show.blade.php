@extends('layouts.dashboard')

@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">

                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Detail Schedule</h3>
                    <p class="text-subtitle text-muted">Lihat detail jadwal yang telah dibuat.</p>
                </div>

                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('schedules.index') }}">Schedules</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Detail</li>
                        </ol>
                    </nav>
                </div>

            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-body">

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    {{-- Judul --}}
                    <div class="mb-3">
                        <label class="form-label"><strong>Nama Schedule</strong></label>
                        <p>{{ $schedule->title }}</p>
                    </div>

                    {{-- Tempat --}}
                    <div class="mb-3">
                        <label class="form-label"><strong>Tempat</strong></label>
                        <p>{{ $schedule->place ?? '-' }}</p>
                    </div>

                    {{-- Waktu Mulai --}}
                    <div class="mb-3">
                        <label class="form-label"><strong>Waktu Mulai</strong></label>
                        <p>
                            {{ $schedule->start_at ? \Carbon\Carbon::parse($schedule->start_at)->format('d M Y, H:i') : '-' }}
                        </p>
                    </div>

                    {{-- Waktu Selesai --}}
                    <div class="mb-3">
                        <label class="form-label"><strong>Waktu Selesai</strong></label>
                        <p>
                            {{ $schedule->end_at ? \Carbon\Carbon::parse($schedule->end_at)->format('d M Y, H:i') : '-' }}
                        </p>
                    </div>

                    {{-- Status --}}
                    <div class="mb-3">
                        <label class="form-label"><strong>Status</strong></label>
                        <p>
                            @if ($schedule->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </p>
                    </div>

                    {{-- Created at --}}
                    <div class="mb-3">
                        <label class="form-label"><strong>Dibuat pada</strong></label>
                        <p>{{ $schedule->created_at->format('d M Y, H:i') }}</p>
                    </div>

                    {{-- Updated at --}}
                    <div class="mb-3">
                        <label class="form-label"><strong>Terakhir diperbarui</strong></label>
                        <p>{{ $schedule->updated_at->format('d M Y, H:i') }}</p>
                    </div>

                    {{-- Optional: created_by --}}
                    @if ($schedule->createdBy)
                        <div class="mb-3">
                            <label class="form-label"><strong>Dibuat oleh</strong></label>
                            <p>{{ $schedule->createdBy->name }}</p>
                        </div>
                    @endif

                    {{-- Tombol Aksi --}}
                    <a href="{{ route('schedules.index') }}" class="btn btn-secondary me-2">
                        <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                    </a>

                    <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Edit Schedule
                    </a>

                </div>
            </div>
        </section>
    </div>
@endsection
