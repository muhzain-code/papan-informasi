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
                    <h3>Buat Jadwal Baru</h3>
                    <p class="text-subtitle text-muted">Tambahkan jadwal kegiatan ke dalam sistem.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('schedules.index') }}">Schedules</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Jadwal</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('schedules.store') }}" method="POST">
                        @csrf

                        {{-- Title --}}
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Kegiatan</label>
                            <input type="text" name="title" id="title"
                                class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}"
                                required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Place --}}
                        <div class="mb-3">
                            <label for="place" class="form-label">Tempat (opsional)</label>
                            <input type="text" name="place" id="place"
                                class="form-control @error('place') is-invalid @enderror" value="{{ old('place') }}">
                            @error('place')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Start At --}}
                        <div class="mb-3">
                            <label for="start_at" class="form-label">Waktu Mulai</label>
                            <input type="datetime-local" name="start_at" id="start_at"
                                class="form-control @error('start_at') is-invalid @enderror" value="{{ old('start_at') }}">
                            @error('start_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- End At --}}
                        <div class="mb-3">
                            <label for="end_at" class="form-label">Waktu Selesai</label>
                            <input type="datetime-local" name="end_at" id="end_at"
                                class="form-control @error('end_at') is-invalid @enderror" value="{{ old('end_at') }}">
                            @error('end_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Is Active --}}
                        <div class="mb-3">
                            <label class="form-label">Status</label>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('is_active') is-invalid @enderror" type="radio"
                                    name="is_active" id="active" value="1"
                                    {{ old('is_active', 1) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="active">Active</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('is_active') is-invalid @enderror" type="radio"
                                    name="is_active" id="inactive" value="0"
                                    {{ old('is_active') == '0' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inactive">Inactive</label>
                            </div>

                            @error('is_active')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Button --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('schedules.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan Jadwal
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </section>
    </div>
@endsection
