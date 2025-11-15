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
                    <h3>Edit Berita</h3>
                    <p class="text-subtitle text-muted">Perbarui data berita.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('news.index') }}">Berita</a>
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

                    <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Judul --}}
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $news->title) }}"
                                class="form-control @error('title') is-invalid @enderror" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Konten --}}
                        <div class="mb-3">
                            <label for="content" class="form-label">Konten</label>
                            <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="6"
                                required>{{ old('content', $news->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tanggal Terbit --}}
                        <div class="mb-3">
                            <label for="published_at" class="form-label">Tanggal Terbit (opsional)</label>
                            <input type="datetime-local" name="published_at" id="published_at"
                                class="form-control @error('published_at') is-invalid @enderror"
                                value="{{ old('published_at', $news->published_at ? \Carbon\Carbon::parse($news->published_at)->format('Y-m-d\TH:i') : '') }}">
                            @error('published_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <div class="form-check form-switch">

                                <input type="hidden" name="status" value="draft">

                                <input class="form-check-input @error('status') is-invalid @enderror" type="checkbox"
                                    role="switch" id="status" name="status" value="published"
                                    {{ old('status', $news->status) == 'published' ? 'checked' : '' }}>

                                <label class="form-check-label" for="status">
                                    Published (Jika non-aktif = Draft)
                                </label>

                                @error('status')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Thumbnail --}}
                        <div class="mb-3">
                            <label for="thumbnail" class="form-label">Thumbnail (opsional)</label>
                            <input type="file" name="thumbnail" id="thumbnail"
                                class="form-control @error('thumbnail') is-invalid @enderror" accept="image/*">
                            @error('thumbnail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <div class="row mt-3 align-items-start">
                                {{-- Thumbnail lama --}}
                                <div class="col-md-6 text-center">
                                    <p class="mb-1 fw-bold text-muted">Thumbnail Lama</p>
                                    @if ($news->thumbnail)
                                        <img id="thumbnail-old" src="{{ asset('storage/' . $news->thumbnail) }}"
                                            alt="Thumbnail Lama" class="img-fluid rounded border" width="200">
                                    @else
                                        <p class="text-muted fst-italic">Belum ada thumbnail</p>
                                    @endif
                                </div>

                                {{-- Preview Thumbnail baru --}}
                                <div class="col-md-6 text-center">
                                    <p class="mb-1 fw-bold text-muted">Thumbnail Baru</p>
                                    <img id="thumbnail-preview" src="#" alt="Preview Thumbnail"
                                        class="img-fluid rounded border d-none" width="200">
                                </div>
                            </div>
                        </div>

                        {{-- Tombol --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('news.index') }}" class="btn btn-secondary me-2">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Perbarui Berita
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <script>
        document.getElementById('thumbnail').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('thumbnail-preview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = "#";
                preview.classList.add('d-none');
            }
        });
    </script>
@endsection
