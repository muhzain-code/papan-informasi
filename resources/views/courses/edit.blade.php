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
                    <h3>Edit Mata Kuliah</h3>
                    <p class="text-subtitle text-muted">Perbarui data mata kuliah.</p>
                </div>

                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('courses.index') }}">Courses</a>
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

                    <form action="{{ route('courses.update', $course->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- KODE --}}
                        <div class="mb-3">
                            <label for="code" class="form-label">Kode Mata Kuliah</label>
                            <input type="text" name="code" id="code" value="{{ old('code', $course->code) }}"
                                class="form-control @error('code') is-invalid @enderror" required>

                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- NAMA --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Mata Kuliah</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $course->name) }}"
                                class="form-control @error('name') is-invalid @enderror" required>

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- SKS --}}
                        <div class="mb-3">
                            <label for="sks" class="form-label">Jumlah SKS</label>
                            <input type="number" name="sks" id="sks" min="1" max="10"
                                value="{{ old('sks', $course->sks) }}"
                                class="form-control @error('sks') is-invalid @enderror" required>

                            @error('sks')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- DESKRIPSI --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi (Opsional)</label>
                            <textarea name="description" id="description" rows="4"
                                class="form-control @error('description') is-invalid @enderror">{{ old('description', $course->description) }}</textarea>

                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- BUTTON --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('courses.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Perbarui Mata Kuliah
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </section>
    </div>
@endsection
