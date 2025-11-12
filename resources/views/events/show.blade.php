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
                <h3>Detail Event</h3>
                <p class="text-subtitle text-muted">Lihat detail event yang telah dibuat.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.events.index') }}">Event</a></li>
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
                    <label class="form-label"><strong>Judul Event</strong></label>
                    <p>{{ $event->title }}</p>
                </div>

                {{-- Slug --}}
                <div class="mb-3">
                    <label class="form-label"><strong>Slug</strong></label>
                    <p>{{ $event->slug }}</p>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label class="form-label"><strong>Deskripsi</strong></label>
                    <div class="border rounded p-3 bg-light">
                        {!! $event->description !!}
                    </div>
                </div>

                {{-- Lokasi --}}
                @if ($event->location)
                    <div class="mb-3">
                        <label class="form-label"><strong>Lokasi</strong></label>
                        <p>{{ $event->location }}</p>
                    </div>
                @endif

                {{-- Tanggal Mulai --}}
                <div class="mb-3">
                    <label class="form-label"><strong>Tanggal Mulai</strong></label>
                    <p>{{ \Carbon\Carbon::parse($event->start_date)->format('d M Y, H:i') }}</p>
                </div>

                {{-- Tanggal Selesai --}}
                <div class="mb-3">
                    <label class="form-label"><strong>Tanggal Selesai</strong></label>
                    <p>
                        {{ $event->end_date ? \Carbon\Carbon::parse($event->end_date)->format('d M Y, H:i') : '-' }}
                    </p>
                </div>

                {{-- Thumbnail --}}
                @if ($event->thumbnail)
                    <div class="mb-3">
                        <label class="form-label"><strong>Thumbnail</strong></label><br>
                        <img src="{{ asset('storage/' . $event->thumbnail) }}" 
                             alt="Thumbnail Event" 
                             class="img-fluid rounded" 
                             style="max-height: 300px;">
                    </div>
                @endif

                {{-- Waktu Dibuat & Diperbarui --}}
                <div class="mb-3">
                    <label class="form-label"><strong>Dibuat pada</strong></label>
                    <p>{{ $event->created_at->format('d M Y, H:i') }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Terakhir diperbarui</strong></label>
                    <p>{{ $event->updated_at->format('d M Y, H:i') }}</p>
                </div>

                {{-- Tombol Aksi --}}
                <a href="{{ route('admin.events.index') }}" class="btn btn-secondary me-2">
                    <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                </a>
                <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-primary">
                    <i class="bi bi-pencil"></i> Edit
                </a>
            </div>
        </div>
    </section>
</div>
@endsection
