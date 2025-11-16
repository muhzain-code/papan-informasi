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
                    <h3>Detail Info</h3>
                    <p class="text-subtitle text-muted">Lihat detail informasi yang telah dibuat.</p>
                </div>

                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('infos.index') }}">Infos</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Detail</li>
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

                    {{-- Judul --}}
                    <div class="mb-3">
                        <label class="form-label"><strong>Judul Info</strong></label>
                        <p>{{ $info->title }}</p>
                    </div>

                    {{-- Isi Informasi --}}
                    <div class="mb-3">
                        <label class="form-label"><strong>Isi Informasi</strong></label>
                        <div class="border rounded p-3 bg-light">
                            {!! nl2br(e($info->message)) !!}
                        </div>
                    </div>

                    {{-- Tanggal Info (opsional) --}}
                    @if ($info->date)
                        <div class="mb-3">
                            <label class="form-label"><strong>Tanggal</strong></label>
                            <p>{{ \Carbon\Carbon::parse($info->date)->format('d M Y') }}</p>
                        </div>
                    @endif

                    {{-- Status --}}
                    <div class="mb-3">
                        <label class="form-label"><strong>Status</strong></label>
                        <p>
                            @if ($info->status === 'active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </p>
                    </div>

                    {{-- Dibuat --}}
                    <div class="mb-3">
                        <label class="form-label"><strong>Dibuat pada</strong></label>
                        <p>{{ $info->created_at->format('d M Y, H:i') }}</p>
                    </div>

                    {{-- Terakhir diperbarui --}}
                    <div class="mb-3">
                        <label class="form-label"><strong>Terakhir diperbarui</strong></label>
                        <p>{{ $info->updated_at->format('d M Y, H:i') }}</p>
                    </div>

                    {{-- Tombol Aksi --}}
                    <a href="{{ route('infos.index') }}" class="btn btn-secondary me-2">
                        <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                    </a>

                    <a href="{{ route('infos.edit', $info->id) }}" class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Edit
                    </a>

                </div>
            </div>
        </section>
    </div>
@endsection
