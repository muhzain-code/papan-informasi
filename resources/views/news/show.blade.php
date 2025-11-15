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
                    <h3>Detail Berita</h3>
                    <p class="text-subtitle text-muted">Lihat detail berita yang telah dibuat.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('news.index') }}">Berita</a></li>
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
                        <label class="form-label"><strong>Judul</strong></label>
                        <p>{{ $news->title }}</p>
                    </div>

                    {{-- Konten --}}
                    <div class="mb-3">
                        <label class="form-label"><strong>Konten</strong></label>
                        <div class="border rounded p-3 bg-light">
                            {!! $news->content !!}
                        </div>
                    </div>
                    
                    {{-- Thumbnail --}}
                    @if ($news->thumbnail)
                        <div class="mb-3">
                            <label class="form-label"><strong>Thumbnail</strong></label><br>
                            <img src="{{ asset('storage/' . $news->thumbnail) }}" alt="Thumbnail" class="img-fluid rounded"
                                style="max-height: 300px;">
                        </div>
                    @endif

                    {{-- Status --}}
                    <div class="mb-3">
                        <label class="form-label"><strong>Status</strong></label>
                        <p>
                            <span class="badge bg-{{ $news->status === 'published' ? 'success' : 'secondary' }}">
                                {{ ucfirst($news->status) }}
                            </span>
                        </p>
                    </div>

                    {{-- Tanggal Publikasi --}}
                    <div class="mb-3">
                        <label class="form-label"><strong>Tanggal Publikasi</strong></label>
                        <p>{{ $news->published_at ? $news->published_at->format('d M Y, H:i') : '-' }}</p>
                    </div>

                    {{-- Penulis --}}
                    <div class="mb-3">
                        <label class="form-label"><strong>Dibuat oleh</strong></label>
                        <p>{{ $news->creator ? $news->creator->name : '-' }}</p>
                    </div>

                    <a href="{{ route('news.index') }}" class="btn btn-secondary me-2">
                        <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                    </a>
                    <a href="{{ route('news.edit', $news->id) }}" class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection
