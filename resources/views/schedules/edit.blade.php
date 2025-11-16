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
                    <h3>Edit Jadwal</h3>
                    <p class="text-subtitle text-muted">Perbarui jadwal kegiatan.</p>
                </div>

                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('schedules.index') }}">Schedules</a>
                            </li>
                            <li class="breadcrumb-item active">Edit Jadwal</li>
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

                    <form action="{{ route('schedules.update', $schedule->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Title --}}
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Kegiatan</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $schedule->title) }}"
                                class="form-control @error('title') is-invalid @enderror" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Place --}}
                        <div class="mb-3">
                            <label for="place" class="form-label">Tempat</label>
                            <input type="text" name="place" id="place" value="{{ old('place', $schedule->place) }}"
                                class="form-control @error('place') is-invalid @enderror">
                            @error('place')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Start At --}}
                        <div class="mb-3">
                            <label for="start_at" class="form-label">Waktu Mulai</label>
                            <input type="datetime-local" name="start_at" id="start_at"
                                value="{{ old('start_at', $schedule->start_at ? \Carbon\Carbon::parse($schedule->start_at)->format('Y-m-d\TH:i') : '') }}"
                                class="form-control @error('start_at') is-invalid @enderror">
                            @error('start_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- End At --}}
                        <div class="mb-3">
                            <label for="end_at" class="form-label">Waktu Selesai</label>
                            <input type="datetime-local" name="end_at" id="end_at"
                                value="{{ old('end_at', $schedule->end_at ? \Carbon\Carbon::parse($schedule->end_at)->format('Y-m-d\TH:i') : '') }}"
                                class="form-control @error('end_at') is-invalid @enderror">
                            @error('end_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Is Active --}}
                        <div class="mb-3">
                            <label class="form-label">Status</label>

                            <div class="form-check form-check-inline">
                                <input type="radio" name="is_active" id="active" value="1"
                                    class="form-check-input @error('is_active') is-invalid @enderror"
                                    {{ old('is_active', $schedule->is_active) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="active">Active</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="radio" name="is_active" id="inactive" value="0"
                                    class="form-check-input @error('is_active') is-invalid @enderror"
                                    {{ old('is_active', $schedule->is_active) == 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="inactive">Inactive</label>
                            </div>

                            @error('is_active')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('schedules.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Perbarui Jadwal
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </section>
    </div>
@endsection
