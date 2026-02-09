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
                    <h3>Edit Video</h3>
                    <p class="text-subtitle text-muted">Perbarui data video.</p>
                </div>

                <div class="col-12 col-md-6">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('videos.index') }}">Videos</a></li>
                            <li class="breadcrumb-item active">Edit Video</li>
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

                    <form action="{{ route('videos.update', $video->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Title --}}
                        <div class="mb-3">
                            <label class="form-label">Judul Video</label>
                            <input type="text" name="title" value="{{ old('title', $video->title) }}"
                                class="form-control @error('title') is-invalid @enderror" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Source Type --}}
                        <div class="mb-3">
                            <label class="form-label">Jenis Sumber</label>
                            <select name="source_type" id="source_type"
                                class="form-select @error('source_type') is-invalid @enderror" required>
                                <option value="file"
                                    {{ old('source_type', $video->source_type) == 'file' ? 'selected' : '' }}>
                                    Upload File
                                </option>
                                <option value="youtube"
                                    {{ old('source_type', $video->source_type) == 'youtube' ? 'selected' : '' }}>
                                    YouTube
                                </option>
                            </select>
                            @error('source_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Preview --}}
                        <div class="mb-3">
                            <label class="form-label">Preview Video Saat Ini</label>

                            @if ($video->source_type === 'file' && $video->video_path)
                                <video width="300" controls class="d-block mb-2">
                                    <source src="{{ asset('storage/' . $video->video_path) }}">
                                </video>
                            @elseif ($video->source_type === 'youtube' && $video->video_url)
                                @php preg_match('/v=([^&]+)/', $video->video_url, $yt); @endphp
                                @if (isset($yt[1]))
                                    <iframe width="300" height="180"
                                        src="https://www.youtube.com/embed/{{ $yt[1] }}" class="d-block mb-2"
                                        allowfullscreen></iframe>
                                @endif
                            @endif
                        </div>


                        {{-- Upload File --}}
                        <div class="mb-3 source-field file-field" style="display:none;">
                            <label class="form-label">Upload File Video (opsional ganti)</label>
                            <input type="file" name="video_path"
                                class="form-control @error('video_path') is-invalid @enderror"
                                accept="video/mp4,video/mkv,video/avi,video/webm">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengganti file.</small>
                            @error('video_path')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        {{-- YouTube URL --}}
                        <div class="mb-3 source-field youtube-field" style="display:none;">
                            <label class="form-label">YouTube URL</label>
                            <input type="text" name="video_url"
                                value="{{ old('video_url', $video->source_type == 'youtube' ? $video->video_url : '') }}"
                                class="form-control @error('video_url') is-invalid @enderror">
                            @error('video_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Order --}}
                        <div class="mb-3">
                            <label class="form-label">Urutan</label>
                            <input type="number" name="order" class="form-control @error('order') is-invalid @enderror"
                                value="{{ old('order', $video->order) }}" required>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="mb-3">
                            <label class="form-label">Status</label>

                            <div class="form-check form-check-inline">
                                <input type="radio" name="is_active" value="1" class="form-check-input"
                                    {{ old('is_active', $video->is_active) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label">Aktif</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="radio" name="is_active" value="0" class="form-check-input"
                                    {{ old('is_active', $video->is_active) == 0 ? 'checked' : '' }}>
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
                                    {{ old('is_default', $video->is_default) ? 'checked' : '' }}>
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
                                        value="{{ old('start_date', $video->start_date?->format('Y-m-d')) }}">
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tanggal Selesai</label>
                                    <input type="date" name="end_date"
                                        class="form-control @error('end_date') is-invalid @enderror"
                                        value="{{ old('end_date', $video->end_date?->format('Y-m-d')) }}">
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
                                <i class="bi bi-save"></i> Perbarui Video
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </section>
    </div>

    {{-- Dynamic Source & Default Script --}}
    <script>
        function updateSourceFields() {
            const type = document.getElementById('source_type').value;

            document.querySelectorAll('.source-field').forEach(el => el.style.display = 'none');

            if (type === 'file') {
                document.querySelector('.file-field').style.display = 'block';
            }

            if (type === 'youtube') {
                document.querySelector('.youtube-field').style.display = 'block';
            }
        }

        function updateDefaultFields() {
            const isDefault = document.getElementById('is_default').checked;
            const dateFields = document.getElementById('date-range-fields');

            if (isDefault) {
                dateFields.style.display = 'none';
                dateFields.querySelectorAll('input[type="date"]').forEach(el => el.value = '');
            } else {
                dateFields.style.display = 'block';
            }
        }

        updateSourceFields();
        updateDefaultFields();
        document.getElementById('source_type').addEventListener('change', updateSourceFields);
        document.getElementById('is_default').addEventListener('change', updateDefaultFields);
    </script>

@endsection
