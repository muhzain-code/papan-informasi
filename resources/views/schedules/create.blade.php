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
                    <p class="text-subtitle text-muted">Tambahkan jadwal perkuliahan ke dalam sistem.</p>
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

                        {{-- Mata Kuliah --}}
                        <div class="mb-3">
                            <label for="course_id" class="form-label">Mata Kuliah</label>
                            <select name="course_id" id="course_id"
                                class="form-select @error('course_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Mata Kuliah --</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}"
                                        {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                        {{ $course->code }} - {{ $course->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('course_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Dosen --}}
                        <div class="mb-3">
                            <label for="lecturer_id" class="form-label">Dosen Pengajar</label>
                            <select name="lecturer_id" id="lecturer_id"
                                class="form-select @error('lecturer_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Dosen --</option>
                                @foreach ($lecturers as $lecturer)
                                    <option value="{{ $lecturer->id }}"
                                        {{ old('lecturer_id') == $lecturer->id ? 'selected' : '' }}>
                                        {{ $lecturer->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('lecturer_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Ruangan --}}
                        <div class="mb-3">
                            <label for="room_id" class="form-label">Ruangan</label>
                            <select name="room_id" id="room_id" class="form-select @error('room_id') is-invalid @enderror"
                                required>
                                <option value="">-- Pilih Ruangan --</option>
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}"
                                        {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                        {{ $room->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('room_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Hari --}}
                        <div class="mb-3">
                            <label for="day_of_week" class="form-label">Hari</label>
                            <select name="day_of_week" id="day_of_week"
                                class="form-select @error('day_of_week') is-invalid @enderror" required>
                                <option value="">-- Pilih Hari --</option>
                                @php
                                    $hari = [
                                        1 => 'Senin',
                                        2 => 'Selasa',
                                        3 => 'Rabu',
                                        4 => 'Kamis',
                                        5 => 'Jumat',
                                        6 => 'Sabtu',
                                        7 => 'Minggu',
                                    ];
                                @endphp
                                @foreach ($hari as $num => $name)
                                    <option value="{{ $num }}"
                                        {{ old('day_of_week') == $num ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('day_of_week')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Waktu Mulai --}}
                        <div class="mb-3">
                            <label for="start_time" class="form-label">Waktu Mulai</label>
                            <input type="time" name="start_time" id="start_time"
                                class="form-control @error('start_time') is-invalid @enderror"
                                value="{{ old('start_time') }}" required>
                            @error('start_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Waktu Selesai --}}
                        <div class="mb-3">
                            <label for="end_time" class="form-label">Waktu Selesai</label>
                            <input type="time" name="end_time" id="end_time"
                                class="form-control @error('end_time') is-invalid @enderror" value="{{ old('end_time') }}"
                                required>
                            @error('end_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Buttons --}}
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
