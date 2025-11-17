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
                    <p class="text-subtitle text-muted">Detail jadwal kuliah.</p>
                </div>

                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('schedules.index') }}">Schedules</a>
                            </li>
                            <li class="breadcrumb-item active">Detail</li>
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

                    {{-- Mata Kuliah --}}
                    <div class="mb-3">
                        <label class="form-label"><strong>Mata Kuliah</strong></label>
                        <p>{{ $schedule->course->name }} ({{ $schedule->course->code }})</p>
                    </div>

                    {{-- Dosen --}}
                    <div class="mb-3">
                        <label class="form-label"><strong>Dosen</strong></label>
                        <p>{{ $schedule->lecturer->name }}</p>
                    </div>

                    {{-- Ruangan --}}
                    <div class="mb-3">
                        <label class="form-label"><strong>Ruangan</strong></label>
                        <p>{{ $schedule->room->name }}</p>
                    </div>

                    {{-- Hari --}}
                    <div class="mb-3">
                        <label class="form-label"><strong>Hari</strong></label>
                        <p>
                            @php
                                $days = [
                                    1 => 'Senin',
                                    2 => 'Selasa',
                                    3 => 'Rabu',
                                    4 => 'Kamis',
                                    5 => 'Jumat',
                                    6 => 'Sabtu',
                                    7 => 'Minggu',
                                ];
                            @endphp
                            {{ $days[$schedule->day_of_week] ?? '-' }}
                        </p>
                    </div>

                    {{-- Waktu --}}
                    <div class="mb-3">
                        <label class="form-label"><strong>Waktu</strong></label>
                        <p>{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                            - {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</p>
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

                    {{-- Created By --}}
                    @if ($schedule->createdBy)
                        <div class="mb-3">
                            <label class="form-label"><strong>Dibuat oleh</strong></label>
                            <p>{{ $schedule->createdBy->name }}</p>
                        </div>
                    @endif

                    {{-- Tombol --}}
                    <a href="{{ route('schedules.index') }}" class="btn btn-secondary me-2">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                    <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Edit Schedule
                    </a>

                </div>
            </div>
        </section>
    </div>
@endsection
