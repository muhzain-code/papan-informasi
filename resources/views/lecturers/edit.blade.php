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
                    <h3>Edit Dosen</h3>
                    <p class="text-subtitle text-muted">Perbarui data dosen yang terdaftar.</p>
                </div>

                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('lecturers.index') }}">Lecturers</a>
                            </li>
                            <li class="breadcrumb-item active">Edit</li>
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

                    <form action="{{ route('lecturers.update', $lecturer->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- NAMA --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Dosen <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name', $lecturer->name) }}"
                                class="form-control @error('name') is-invalid @enderror" required>

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- NIDN --}}
                        <div class="mb-3">
                            <label for="nidn" class="form-label">NIDN (Opsional)</label>
                            <input type="text" name="nidn" id="nidn" value="{{ old('nidn', $lecturer->nidn) }}"
                                class="form-control @error('nidn') is-invalid @enderror">

                            @error('nidn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- EMAIL --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Email (Opsional)</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $lecturer->email) }}"
                                class="form-control @error('email') is-invalid @enderror">

                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- PHONE --}}
                        <div class="mb-3">
                            <label for="phone" class="form-label">Nomor Telepon (Opsional)</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $lecturer->phone) }}"
                                class="form-control @error('phone') is-invalid @enderror">

                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- BUTTON --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('lecturers.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Perbarui Dosen
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </section>
    </div>
@endsection
