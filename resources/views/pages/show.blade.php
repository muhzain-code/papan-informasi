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
                    <h3>Detail Halaman</h3>
                    <p class="text-subtitle text-muted">Lihat detail halaman statis.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">Pages</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detail</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-body">

                    {{-- Title --}}
                    <div class="mb-3">
                        <label class="form-label"><strong>Judul</strong></label>
                        <p>{{ $page->title }}</p>
                    </div>

                    {{-- Slug --}}
                    <div class="mb-3">
                        <label class="form-label"><strong>Slug</strong></label>
                        <p>{{ $page->slug }}</p>
                    </div>

                    {{-- Featured Image --}}
                    @if ($page->featured_image)
                        <div class="mb-3">
                            <label class="form-label"><strong>Featured Image</strong></label><br>
                            <img src="{{ asset('storage/' . $page->featured_image) }}" alt="Featured Image"
                                class="img-fluid rounded border" style="max-height: 300px;">
                        </div>
                    @endif

                    {{-- Content --}}
                    <div class="mb-3">
                        <label class="form-label"><strong>Konten</strong></label>
                        <div class="border rounded p-3 bg-light">
                            {!! $page->content !!}
                        </div>
                    </div>

                    {{-- Meta Title --}}
                    <div class="mb-3">
                        <label class="form-label"><strong>Meta Title (SEO)</strong></label>
                        <p>{{ $page->meta_title ?? '-' }}</p>
                    </div>

                    {{-- Meta Description --}}
                    <div class="mb-3">
                        <label class="form-label"><strong>Meta Description (SEO)</strong></label>
                        <p>{{ $page->meta_description ?? '-' }}</p>
                    </div>

                    {{-- Created --}}
                    <div class="mb-3">
                        <label class="form-label"><strong>Dibuat pada</strong></label>
                        <p>{{ $page->created_at->format('d M Y, H:i') }}</p>
                    </div>

                    {{-- Updated --}}
                    <div class="mb-3">
                        <label class="form-label"><strong>Terakhir diperbarui</strong></label>
                        <p>{{ $page->updated_at->format('d M Y, H:i') }}</p>
                    </div>

                    {{-- Buttons --}}
                    <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary me-2">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                    <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Edit Halaman
                    </a>

                </div>
            </div>
        </section>
    </div>
@endsection
