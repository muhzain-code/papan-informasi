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
                    <h3>Buat Notification Baru</h3>
                    <p class="text-subtitle text-muted">Tambahkan notifikasi baru.</p>
                </div>

                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('notifications.index') }}">Notifications</a>
                            </li>
                            <li class="breadcrumb-item active">Tambah Notification</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('notifications.store') }}" method="POST">
                        @csrf

                        {{-- Pesan --}}
                        <div class="mb-3">
                            <label for="message" class="form-label">Pesan Notifikasi</label>
                            <textarea name="message" id="message" class="form-control @error('message') is-invalid @enderror" rows="6"
                                required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tanggal --}}
                        <div class="mb-3">
                            <label for="date" class="form-label">Tanggal & Waktu</label>
                            <input type="datetime-local" name="date" id="date"
                                class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}"
                                required>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tombol --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('notifications.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan Notification
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </section>
    </div>
@endsection
