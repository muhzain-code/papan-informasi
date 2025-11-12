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
                    <h3>Buat Berita Baru</h3>
                    <p class="text-subtitle text-muted">Tambahkan berita baru ke dalam sistem.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.news.index') }}">Berita</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Berita</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Judul --}}
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Berita</label>
                            <input type="text" name="title" id="title"
                                class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}"
                                required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Ringkasan (Excerpt) --}}
                        <div class="mb-3">
                            <label for="excerpt" class="form-label">Ringkasan (opsional)</label>
                            <textarea name="excerpt" id="excerpt" class="form-control @error('excerpt') is-invalid @enderror" rows="3"
                                maxlength="500">{{ old('excerpt') }}</textarea>
                            @error('excerpt')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Konten --}}
                        <div class="mb-3">
                            <label for="content" class="form-label">Konten</label>
                            <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="8"
                                required>{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Thumbnail --}}
                        <div class="mb-3">
                            <label for="thumbnail" class="form-label">Thumbnail (opsional)</label>
                            <input type="file" name="thumbnail" id="thumbnail"
                                class="form-control @error('thumbnail') is-invalid @enderror" accept="image/*">
                            <small class="text-muted">Format: JPG, JPEG, PNG, WEBP (maks. 2MB)</small>
                            @error('thumbnail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="mt-2" id="preview-container" style="display:none;">
                                <p class="text-muted mb-1">Preview:</p>
                                <img id="preview-image" src="#" alt="Preview" class="img-fluid rounded"
                                    style="max-height: 200px;">
                            </div>
                        </div>

                        {{-- Tanggal Publikasi --}}
                        <div class="mb-3">
                            <label for="published_at" class="form-label">Tanggal Publikasi (opsional)</label>
                            <input type="datetime-local" name="published_at" id="published_at"
                                class="form-control @error('published_at') is-invalid @enderror"
                                value="{{ old('published_at') }}">
                            @error('published_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror"
                                required>
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>
                                    Published
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tombol --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan Berita
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

    {{-- Script Preview Gambar --}}
    <script>
        document.getElementById('thumbnail').addEventListener('change', function(event) {
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
