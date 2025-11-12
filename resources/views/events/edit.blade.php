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
                    <h3>Edit Event</h3>
                    <p class="text-subtitle text-muted">Perbarui data event.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.events.index') }}">Event</a></li>
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

                    <form action="{{ route('admin.events.update', $event->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Judul --}}
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Event</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $event->title) }}"
                                class="form-control @error('title') is-invalid @enderror" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                rows="6" required>{{ old('description', $event->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Lokasi --}}
                        <div class="mb-3">
                            <label for="location" class="form-label">Lokasi (opsional)</label>
                            <input type="text" name="location" id="location"
                                value="{{ old('location', $event->location) }}"
                                class="form-control @error('location') is-invalid @enderror">
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tanggal Mulai --}}
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Tanggal Mulai</label>
                            <input type="datetime-local" name="start_date" id="start_date"
                                value="{{ old('start_date', \Carbon\Carbon::parse($event->start_date)->format('Y-m-d\TH:i')) }}"
                                class="form-control @error('start_date') is-invalid @enderror" required>
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tanggal Selesai --}}
                        <div class="mb-3">
                            <label for="end_date" class="form-label">Tanggal Selesai (opsional)</label>
                            <input type="datetime-local" name="end_date" id="end_date"
                                value="{{ old('end_date', $event->end_date ? \Carbon\Carbon::parse($event->end_date)->format('Y-m-d\TH:i') : '') }}"
                                class="form-control @error('end_date') is-invalid @enderror">
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
                                    @if ($event->thumbnail)
                                        <img id="thumbnail-old" src="{{ asset('storage/' . $event->thumbnail) }}"
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
                            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary me-2">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Perbarui Event
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
