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
                    <h3>Buat Ruangan Baru</h3>
                    <p class="text-subtitle text-muted">Tambahkan data ruangan ke dalam sistem.</p>
                </div>

                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('rooms.index') }}">Rooms</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('rooms.store') }}" method="POST">
                        @csrf

                        {{-- KODE RUANGAN --}}
                        <div class="mb-3">
                            <label for="code" class="form-label">Kode Ruangan</label>
                            <input type="text" name="code" id="code"
                                class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}"
                                required>

                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- NAMA RUANGAN --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Ruangan (Opsional)</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- KAPASITAS --}}
                        <div class="mb-3">
                            <label for="capacity" class="form-label">Kapasitas</label>
                            <input type="number" name="capacity" id="capacity" min="1"
                                class="form-control @error('capacity') is-invalid @enderror" value="{{ old('capacity') }}"
                                required>

                            @error('capacity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- BUTTON --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('rooms.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan Ruangan
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </section>
    </div>
@endsection
