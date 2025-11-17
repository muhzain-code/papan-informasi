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
                    <h3>Detail Video</h3>
                    <p class="text-subtitle text-muted">Lihat detail video yang telah diunggah.</p>
                </div>

                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('videos.index') }}">Videos</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Detail Video</li>
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
                        <label class="form-label"><strong>Judul Video</strong></label>
                        <p>{{ $video->title }}</p>
                    </div>

                    {{-- Video Player --}}
                    <div class="mb-4">
                        <label class="form-label"><strong>Video</strong></label>

                        {{-- FILE VIDEO --}}
                        @if ($video->source_type === 'file' && $video->video_path && Storage::disk('public')->exists($video->video_path))
                            <video width="100%" controls class="rounded shadow-sm">
                                <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4">
                                Browser Anda tidak mendukung pemutar video.
                            </video>

                            {{-- YOUTUBE (SUDAH EMBED) --}}
                        @elseif ($video->source_type === 'youtube' && $video->video_url)
                            <iframe width="100%" height="400" src="{{ $video->video_url }}" class="rounded shadow-sm"
                                allowfullscreen>
                            </iframe>

                            {{-- TIDAK ADA VIDEO --}}
                        @else
                            <p class="text-danger">Video tidak tersedia.</p>
                        @endif
                    </div>


                    {{-- Status --}}
                    <div class="mb-3">
                        <label class="form-label"><strong>Status</strong></label>
                        <p>
                            @if ($video->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </p>
                    </div>

                    {{-- Created At --}}
                    <div class="mb-3">
                        <label class="form-label"><strong>Dibuat pada</strong></label>
                        <p>{{ $video->created_at->format('d M Y, H:i') }}</p>
                    </div>

                    {{-- Updated At --}}
                    <div class="mb-3">
                        <label class="form-label"><strong>Terakhir diperbarui</strong></label>
                        <p>{{ $video->updated_at->format('d M Y, H:i') }}</p>
                    </div>

                    {{-- Created By --}}
                    @if ($video->createdBy)
                        <div class="mb-3">
                            <label class="form-label"><strong>Diupload oleh</strong></label>
                            <p>{{ $video->createdBy->name }}</p>
                        </div>
                    @endif

                    {{-- Tombol Aksi --}}
                    <a href="{{ route('videos.index') }}" class="btn btn-secondary me-2">
                        <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                    </a>

                    <a href="{{ route('videos.edit', $video->id) }}" class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Edit Video
                    </a>

                </div>
            </div>
        </section>
    </div>
@endsection
