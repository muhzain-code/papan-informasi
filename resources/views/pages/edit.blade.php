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
                    <h3>Edit Halaman</h3>
                    <p class="text-subtitle text-muted">Perbarui konten halaman statis.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.pages.index') }}">Pages</a>
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

                    <form action="{{ route('admin.pages.update', $page->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Judul --}}
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Halaman</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $page->title) }}"
                                class="form-control @error('title') is-invalid @enderror" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Konten --}}
                        <div class="mb-3">
                            <label for="content" class="form-label">Konten Halaman</label>
                            <textarea name="content" id="content" rows="8" class="form-control @error('content') is-invalid @enderror"
                                required>
                            {{ old('content', $page->content) }}
                        </textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Featured Image --}}
                        <div class="mb-3">
                            <label for="featured_image" class="form-label">Featured Image (opsional)</label>
                            <input type="file" name="featured_image" id="featured_image"
                                class="form-control @error('featured_image') is-invalid @enderror" accept="image/*">
                            @error('featured_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <div class="row mt-3">
                                <div class="col-md-6 text-center">
                                    <p class="fw-bold text-muted">Gambar Lama</p>
                                    @if ($page->featured_image)
                                        <img src="{{ asset('storage/' . $page->featured_image) }}"
                                            class="img-fluid rounded border" width="200">
                                    @else
                                        <p class="text-muted fst-italic">Tidak ada gambar</p>
                                    @endif
                                </div>

                                <div class="col-md-6 text-center">
                                    <p class="fw-bold text-muted">Preview Gambar Baru</p>
                                    <img id="preview" src="#" class="img-fluid rounded border d-none"
                                        width="200">
                                </div>
                            </div>
                        </div>

                        {{-- Meta Title --}}
                        <div class="mb-3">
                            <label for="meta_title" class="form-label">Meta Title (SEO)</label>
                            <input type="text" name="meta_title" id="meta_title"
                                value="{{ old('meta_title', $page->meta_title) }}"
                                class="form-control @error('meta_title') is-invalid @enderror">
                            @error('meta_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Meta Description --}}
                        <div class="mb-3">
                            <label for="meta_description" class="form-label">Meta Description (SEO)</label>
                            <textarea name="meta_description" id="meta_description" rows="3"
                                class="form-control @error('meta_description') is-invalid @enderror">{{ old('meta_description', $page->meta_description) }}</textarea>
                            @error('meta_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tombol --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Perbarui Halaman
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </section>
    </div>

    <script>
        document.getElementById('featured_image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('preview');

            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('d-none');
            } else {
                preview.classList.add('d-none');
            }
        });
    </script>
@endsection
