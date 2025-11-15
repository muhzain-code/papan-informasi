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
                    <h3>Buat Halaman Baru</h3>
                    <p class="text-subtitle text-muted">Tambahkan halaman statis ke dalam sistem.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.pages.index') }}">Pages</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Page</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- TITLE --}}
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Halaman</label>
                            <input type="text" name="title" id="title"
                                class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}"
                                required>

                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- CONTENT --}}
                        <div class="mb-3">
                            <label for="content" class="form-label">Konten</label>
                            <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="8"
                                required>{{ old('content') }}</textarea>

                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- FEATURED IMAGE --}}
                        <div class="mb-3">
                            <label for="featured_image" class="form-label">Gambar Utama (opsional)</label>
                            <input type="file" name="featured_image" id="featured_image"
                                class="form-control @error('featured_image') is-invalid @enderror" accept="image/*">

                            <small class="text-muted">Format: JPG, JPEG, PNG, WEBP maksimal 2MB</small>

                            @error('featured_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <div class="mt-2" id="preview-container" style="display:none;">
                                <p class="text-muted mb-1">Preview:</p>
                                <img id="preview-image" src="#" alt="Preview" class="img-fluid rounded"
                                    style="max-height: 200px;">
                            </div>
                        </div>

                        {{-- META TITLE --}}
                        <div class="mb-3">
                            <label for="meta_title" class="form-label">Meta Title (SEO)</label>
                            <input type="text" name="meta_title" id="meta_title"
                                class="form-control @error('meta_title') is-invalid @enderror"
                                value="{{ old('meta_title') }}">

                            @error('meta_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- META DESCRIPTION --}}
                        <div class="mb-3">
                            <label for="meta_description" class="form-label">Meta Description (SEO)</label>
                            <textarea name="meta_description" id="meta_description"
                                class="form-control @error('meta_description') is-invalid @enderror" rows="3">{{ old('meta_description') }}</textarea>

                            @error('meta_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- BUTTONS --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan Halaman
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </section>
    </div>

    {{-- IMAGE PREVIEW SCRIPT --}}
    <script>
        document.getElementById('featured_image').addEventListener('change', function(event) {
            const [file] = event.target.files;
            const previewContainer = document.getElementById('preview-container');
            const previewImage = document.getElementById('preview-image');

            if (file) {
                previewImage.src = URL.createObjectURL(file);
                previewContainer.style.display = 'block';
            } else {
                previewContainer.style.display = 'none';
            }
        });
    </script>
@endsection
