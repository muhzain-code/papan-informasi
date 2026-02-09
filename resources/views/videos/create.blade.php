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
                <div class="col-12 col-md-6">
                    <h3>Tambah Video</h3>
                    <p class="text-subtitle text-muted">Unggah atau tambahkan video ke sistem.</p>
                </div>
                <div class="col-12 col-md-6">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('videos.index') }}">Videos</a></li>
                            <li class="breadcrumb-item active">Tambah Video</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Title --}}
                        <div class="mb-3">
                            <label class="form-label">Judul Video</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Source Type --}}
                        <div class="mb-3">
                            <label class="form-label">Jenis Sumber</label>
                            <select name="source_type" id="source_type"
                                class="form-select @error('source_type') is-invalid @enderror" required>
                                <option value="file" {{ old('source_type') == 'file' ? 'selected' : '' }}>Upload File
                                </option>
                                <option value="youtube" {{ old('source_type') == 'youtube' ? 'selected' : '' }}>YouTube
                                </option>
                            </select>
                            @error('source_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Upload File --}}
                        <div class="mb-3 source-field file-field" style="display:none;">
                            <label class="form-label">Upload File Video</label>
                            <input type="file" name="video_path"
                                class="form-control @error('video_path') is-invalid @enderror"
                                accept="video/mp4,video/mkv,video/avi,video/webm">
                            <small class="text-muted">Format: mp4, mkv, avi, webm. Maksimal 200MB.</small>
                            @error('video_path')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- YouTube URL --}}
                        <div class="mb-3 source-field youtube-field" style="display:none;">
                            <label class="form-label">YouTube URL</label>
                            <input type="text" name="video_url"
                                class="form-control @error('video_url') is-invalid @enderror"
                                value="{{ old('video_url') }}">
                            <small class="text-muted">Contoh: https://www.youtube.com/watch?v=xxxx</small>
                            @error('video_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Order --}}
                        <div class="mb-3">
                            <label class="form-label">Urutan Tampil</label>
                            <input type="number" name="order" class="form-control @error('order') is-invalid @enderror"
                                value="{{ old('order', 0) }}" required>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="mb-3">
                            <label class="form-label">Status</label>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="is_active" value="1"
                                    {{ old('is_active', 1) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label">Aktif</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="is_active" value="0"
                                    {{ old('is_active') == '0' ? 'checked' : '' }}>
                                <label class="form-check-label">Tidak Aktif</label>
                            </div>

                            @error('is_active')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Default Checkbox --}}
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_default" name="is_default" value="1"
                                    {{ old('is_default', 1) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="is_default">Default</label>
                            </div>
                            <small class="text-muted">Jika dicentang, video ini akan diputar kapan saja (tanpa batas tanggal).</small>
                        </div>

                        {{-- Date Range (hidden when is_default is checked) --}}
                        <div class="mb-3" id="date-range-fields" style="display:none;">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Tanggal Mulai</label>
                                    <input type="date" name="start_date"
                                        class="form-control @error('start_date') is-invalid @enderror"
                                        value="{{ old('start_date') }}">
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tanggal Selesai</label>
                                    <input type="date" name="end_date"
                                        class="form-control @error('end_date') is-invalid @enderror"
                                        value="{{ old('end_date') }}">
                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <small class="text-muted">Video akan diputar hanya dalam rentang tanggal ini.</small>
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('videos.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan Video
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </section>
    </div>

    {{-- SCRIPT Dynamic Input --}}
    <script>
        function updateSourceFields() {
            const type = document.getElementById('source_type').value;

            document.querySelectorAll('.source-field').forEach(el => el.style.display = 'none');

            if (type === 'file') {
                document.querySelector('.file-field').style.display = 'block';
            } else if (type === 'youtube') {
                document.querySelector('.youtube-field').style.display = 'block';
            }
        }

        function updateDefaultFields() {
            const isDefault = document.getElementById('is_default').checked;
            const dateFields = document.getElementById('date-range-fields');

            if (isDefault) {
                dateFields.style.display = 'none';
                // Clear date inputs when default is checked
                dateFields.querySelectorAll('input[type="date"]').forEach(el => el.value = '');
            } else {
                dateFields.style.display = 'block';
            }
        }

        document.getElementById('source_type').addEventListener('change', updateSourceFields);
        document.getElementById('is_default').addEventListener('change', updateDefaultFields);

        updateSourceFields();
        updateDefaultFields();
    </script>
@endsection
