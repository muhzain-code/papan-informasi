@extends('layouts.dashboard')

@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">

        {{-- Toast Success --}}
        @if (session('success'))
            <div id="toast-success" class="toast align-items-center text-bg-success position-fixed top-0 end-0 m-3"
                role="alert" aria-live="assertive" aria-atomic="true" style="z-index: 1080;">
                <div class="d-flex">
                    <div class="toast-body">{{ session('success') }}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        @endif

        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h3>Video</h3>
                    <p class="text-subtitle text-muted">Mengelola data video.</p>
                </div>
                <div class="col-12 col-md-6">
                    <nav class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Video</li>
                            <li class="breadcrumb-item active">Index</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex">
                        <h5 class="card-title mb-0">Data Video</h5>
                        <a href="{{ route('videos.create') }}" class="btn btn-primary ms-auto">
                            <i class="bi bi-plus-circle"></i> Tambah
                        </a>
                    </div>
                    <div class="d-flex justify-content-between flex-wrap mb-3 mt-3">

                        {{-- Entries --}}
                        <form method="GET" class="d-flex align-items-center ajax-form">
                            <label class="me-2">Show</label>
                            <select name="entries" class="form-select form-select-sm w-auto">
                                <option value="10" {{ $entries == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ $entries == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ $entries == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ $entries == 100 ? 'selected' : '' }}>100</option>
                            </select>
                            <span class="ms-2">entries</span>

                            <input type="hidden" name="search" value="{{ $search }}">
                            <input type="hidden" name="source_type" value="{{ $sourceType }}">
                            <input type="hidden" name="is_active" value="{{ $isActive }}">
                        </form>

                        {{-- Source Type Filter --}}
                        <form method="GET" class="d-flex align-items-center ajax-form">
                            <select name="source_type" class="form-select form-select-sm w-auto">
                                <option value="">Semua Sumber</option>
                                <option value="file" {{ $sourceType == 'file' ? 'selected' : '' }}>File</option>
                                <option value="youtube" {{ $sourceType == 'youtube' ? 'selected' : '' }}>YouTube</option>
                            </select>
                            <input type="hidden" name="entries" value="{{ $entries }}">
                            <input type="hidden" name="search" value="{{ $search }}">
                            <input type="hidden" name="is_active" value="{{ $isActive }}">
                        </form>

                        {{-- Status Filter --}}
                        <form method="GET" class="d-flex align-items-center ajax-form">
                            <select name="is_active" class="form-select form-select-sm w-auto">
                                <option value="">Semua Status</option>
                                <option value="1" {{ $isActive === '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ $isActive === '0' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                            <input type="hidden" name="entries" value="{{ $entries }}">
                            <input type="hidden" name="search" value="{{ $search }}">
                            <input type="hidden" name="source_type" value="{{ $sourceType }}">
                        </form>

                        {{-- Search --}}
                        <form method="GET" class="d-flex ajax-form">
                            <input type="text" name="search" value="{{ $search }}"
                                class="form-control form-control-sm" placeholder="Cari judul...">
                            <input type="hidden" name="entries" value="{{ $entries }}">
                            <input type="hidden" name="source_type" value="{{ $sourceType }}">
                            <input type="hidden" name="is_active" value="{{ $isActive }}">
                            <button class="btn btn-primary btn-sm ms-2">Search</button>
                        </form>
                    </div>

                    <div id="table-container">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Sumber</th>
                                <th>Video</th>
                                <th>Status</th>
                                <th>Urutan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $no = ($videos->currentPage() - 1) * $videos->perPage() + 1;
                            @endphp

                            @foreach ($videos as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->title ?? '-' }}</td>

                                    <td>
                                        <span class="badge bg-info text-dark">
                                            {{ ucfirst($item->source_type) }}
                                        </span>
                                    </td>

                                    <td>
                                        @if ($item->source_type === 'file' && $item->video_path)
                                            <video width="160" controls>
                                                <source src="{{ asset('storage/' . $item->video_path) }}">
                                            </video>
                                        @elseif ($item->source_type === 'youtube')
                                            <a href="{{ $item->video_url }}" target="_blank" class="btn btn-sm btn-danger">
                                                <i class="bi bi-youtube"></i> Lihat
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>


                                    <td>
                                        @if ($item->is_active)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary">Nonaktif</span>
                                        @endif
                                    </td>

                                    <td>{{ $item->order }}</td>

                                    <td>
                                        <div class="d-flex gap-1">

                                            <a href="{{ route('videos.show', $item->id) }}" class="btn btn-info btn-sm">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            <a href="{{ route('videos.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <form action="{{ route('videos.destroy', $item->id) }}" method="POST"
                                                class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- SweetAlert Delete --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('submit', function(e) {
            if (e.target.classList.contains('delete-form')) {
                e.preventDefault();
                let form = e.target;

                Swal.fire({
                    title: 'Hapus Video?',
                    text: "Video akan dipindahkan ke sampah (soft delete).",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#d33'
                }).then((result) => {
                    if (result.isConfirmed) form.submit();
                });
            }
        });
    </script>
@endsection
