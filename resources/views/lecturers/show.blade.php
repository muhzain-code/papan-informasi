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
                    <h3>Detail Lecturer</h3>
                    <p class="text-subtitle text-muted">Informasi lengkap dosen.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('lecturers.index') }}">Lecturers</a></li>
                            <li class="breadcrumb-item active">Detail</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-body">

                    {{-- NAME --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Dosen</label>
                        <p>{{ $lecturer->name }}</p>
                    </div>

                    {{-- NIDN --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">NIDN</label>
                        <p>{{ $lecturer->nidn ?? '-' }}</p>
                    </div>

                    {{-- EMAIL --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <p>{{ $lecturer->email ?? '-' }}</p>
                    </div>

                    {{-- PHONE --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nomor Telepon</label>
                        <p>{{ $lecturer->phone ?? '-' }}</p>
                    </div>

                    {{-- CREATED BY --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Dibuat oleh</label>
                        <p>{{ $lecturer->creator->name ?? '-' }}</p>
                    </div>

                    {{-- UPDATED BY --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Terakhir diperbarui oleh</label>
                        <p>{{ $lecturer->updater->name ?? '-' }}</p>
                    </div>

                    {{-- DELETED BY (SOFT DELETE) --}}
                    @if ($lecturer->deleted_by)
                        <div class="mb-3">
                            <label class="form-label fw-bold">Dihapus oleh</label>
                            <p>{{ $lecturer->deleter->name ?? '-' }}</p>
                        </div>
                    @endif

                    {{-- CREATED DATE --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Dibuat pada</label>
                        <p>{{ $lecturer->created_at->format('d M Y, H:i') }}</p>
                    </div>

                    {{-- UPDATED DATE --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Terakhir diperbarui</label>
                        <p>{{ $lecturer->updated_at->format('d M Y, H:i') }}</p>
                    </div>

                    {{-- DELETED DATE (IF SOFT DELETED) --}}
                    @if ($lecturer->deleted_at)
                        <div class="mb-3">
                            <label class="form-label fw-bold">Dihapus pada</label>
                            <p>{{ $lecturer->deleted_at->format('d M Y, H:i') }}</p>
                        </div>
                    @endif

                    {{-- BUTTONS --}}
                    <a href="{{ route('lecturers.index') }}" class="btn btn-secondary me-2">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                    <a href="{{ route('lecturers.edit', $lecturer->id) }}" class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Edit
                    </a>

                </div>
            </div>
        </section>
    </div>
@endsection
