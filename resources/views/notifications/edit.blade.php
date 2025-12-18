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
                    <h3>Edit Notification</h3>
                    <p class="text-subtitle text-muted">Perbarui notifikasi.</p>
                </div>

                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('notifications.index') }}">Notifications</a></li>
                            <li class="breadcrumb-item active">Edit Notification</li>
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

                    <form action="{{ route('notifications.update', $notification->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Pesan --}}
                        <div class="mb-3">
                            <label for="message" class="form-label">Pesan Notifikasi</label>
                            <textarea name="message" id="message" class="form-control @error('message') is-invalid @enderror" rows="6"
                                required>{{ old('message', $notification->message) }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tanggal --}}
                        <div class="mb-3">
                            <label for="date" class="form-label">Tanggal & Waktu</label>
                            <input type="datetime-local" name="date" id="date"
                                value="{{ old('date', $notification->date ? $notification->date->format('Y-m-d\TH:i') : '') }}"
                                class="form-control @error('date') is-invalid @enderror" required>
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
                                <i class="bi bi-save"></i> Perbarui Notification
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </section>
    </div>
@endsection
