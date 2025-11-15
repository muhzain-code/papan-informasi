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
                    <h3>Detail Pengumuman</h3>
                    <p class="text-subtitle text-muted">Informasi lengkap pengumuman.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('announcements.index') }}">Announcements</a>
                            </li>
                            <li class="breadcrumb-item active">Detail</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-body">

                    {{-- TITLE --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Judul</label>
                        <p>{{ $announcement->title }}</p>
                    </div>

                    {{-- STATUS --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <p>
                            <span class="badge bg-{{ $announcement->status == 'published' ? 'success' : 'secondary' }}">
                                {{ ucfirst($announcement->status) }}
                            </span>
                        </p>
                    </div>

                    {{-- DATES --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Dibuat pada</label>
                        <p>{{ $announcement->created_at->format('d M Y, H:i') }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Terakhir diperbarui</label>
                        <p>{{ $announcement->updated_at->format('d M Y, H:i') }}</p>
                    </div>

                    {{-- BUTTONS --}}
                    <a href="{{ route('announcements.index') }}" class="btn btn-secondary me-2">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                    <a href="{{ route('announcements.edit', $announcement->id) }}" class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Edit
                    </a>

                </div>
            </div>
        </section>
    </div>
@endsection
