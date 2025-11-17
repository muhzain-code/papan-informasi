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
                    <h3>Detail Room</h3>
                    <p class="text-subtitle text-muted">Informasi lengkap ruang kelas.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('rooms.index') }}">Rooms</a></li>
                            <li class="breadcrumb-item active">Detail</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-body">

                    {{-- CODE --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kode Ruangan</label>
                        <p>{{ $room->code }}</p>
                    </div>

                    {{-- NAME --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Ruangan</label>
                        <p>{{ $room->name }}</p>
                    </div>

                    {{-- CAPACITY --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kapasitas</label>
                        <p>{{ $room->capacity }}</p>
                    </div>

                    {{-- CREATED BY --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Dibuat oleh</label>
                        <p>{{ $room->creator->name ?? '-' }}</p>
                    </div>

                    {{-- UPDATED BY --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Terakhir diperbarui oleh</label>
                        <p>{{ $room->updater->name ?? '-' }}</p>
                    </div>

                    {{-- DATES --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Dibuat pada</label>
                        <p>{{ $room->created_at->format('d M Y, H:i') }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Terakhir diperbarui</label>
                        <p>{{ $room->updated_at->format('d M Y, H:i') }}</p>
                    </div>

                    {{-- BUTTONS --}}
                    <a href="{{ route('rooms.index') }}" class="btn btn-secondary me-2">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                    <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Edit
                    </a>

                </div>
            </div>
        </section>
    </div>
@endsection
