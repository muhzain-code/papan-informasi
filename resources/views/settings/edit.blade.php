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
                    <h3>Edit Setting</h3>
                    <p class="text-subtitle text-muted">Perbarui konfigurasi website.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.settings.index') }}">Settings</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
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

                    <form action="{{ route('admin.settings.update', $setting->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Key (readonly) --}}
                        <div class="mb-3">
                            <label for="key" class="form-label">Key</label>
                            <input type="text" name="key" id="key" value="{{ $setting->key }}"
                                class="form-control" readonly>
                        </div>

                        {{-- Value --}}
                        <div class="mb-3">
                            <label for="value" class="form-label">Value</label>
                            <textarea name="value" id="value" rows="4" class="form-control @error('value') is-invalid @enderror"
                                required>{{ old('value', $setting->value) }}</textarea>
                            @error('value')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tombol --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.settings.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Perbarui Setting
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
