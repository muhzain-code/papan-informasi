@extends('layouts.dashboard')

@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        {{-- Toast Success Message --}}
        @if (session('success'))
            <div id="toast-success" class="toast align-items-center text-bg-success border-0 position-fixed top-0 end-0 m-3"
                role="alert" aria-live="assertive" aria-atomic="true" style="z-index: 1080;">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        @endif

        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Berita</h3>
                    <p class="text-subtitle text-muted">Mengelola data berita.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Berita</li>
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
                        <h5 class="card-title mb-0">Data Berita</h5>
                        <a href="{{ route('news.create') }}" class="btn btn-primary mb-3 ms-auto">
                            <i class="bi bi-plus-circle"></i> Tambah
                        </a>
                    </div>

                    <div class="d-flex justify-content-between flex-wrap mb-4">

                        <!-- Entries Dropdown -->
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
                            <input type="hidden" name="status" value="{{ $status }}">
                        </form>

                        <!-- Status Filter -->
                        <form method="GET" class="d-flex align-items-center ajax-form">
                            <select name="status" class="form-select form-select-sm w-auto">
                                <option value="">Semua Status</option>
                                <option value="draft" {{ $status == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ $status == 'published' ? 'selected' : '' }}>Published</option>
                            </select>
                            <input type="hidden" name="entries" value="{{ $entries }}">
                            <input type="hidden" name="search" value="{{ $search }}">
                        </form>

                        <!-- Search -->
                        <form method="GET" class="d-flex ajax-form">
                            <input type="text" name="search" value="{{ $search }}"
                                class="form-control form-control-sm" placeholder="Cari judul...">
                            <input type="hidden" name="entries" value="{{ $entries }}">
                            <input type="hidden" name="status" value="{{ $status }}">
                            <button class="btn btn-primary btn-sm ms-2">Search</button>
                        </form>
                    </div>

                    <div id="table-container">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Tanggal Publikasi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $no = ($news->currentPage() - 1) * $news->perPage() + 1;
                            @endphp

                            @foreach ($news as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->published_at ? $item->published_at->format('d M Y, H:i') : '-' }}</td>
                                    <td>
                                        @if ($item->status === 'draft')
                                            <span class="badge bg-warning text-dark">Draft</span>
                                        @else
                                            <span class="badge bg-success">Published</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">

                                            {{-- Publish --}}
                                            @if ($item->status === 'draft')
                                                <form action="{{ route('news.publish', $item->id) }}" method="POST"
                                                    class="d-inline form-publish">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        <i class="bi bi-check-circle"></i>
                                                    </button>
                                                </form>

                                                {{-- Draft --}}
                                            @else
                                                <form action="{{ route('news.draft', $item->id) }}" method="POST"
                                                    class="d-inline form-draft">
                                                    @csrf
                                                    <button type="submit" class="btn btn-secondary btn-sm">
                                                        <i class="bi bi-arrow-counterclockwise"></i>
                                                    </button>
                                                </form>
                                            @endif

                                            {{-- Show --}}
                                            <a href="{{ route('news.show', $item->id) }}"
                                                class="btn btn-info btn-sm">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            {{-- Edit --}}
                                            <a href="{{ route('news.edit', $item->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            {{-- Delete --}}
                                            <form action="{{ route('news.destroy', $item->id) }}" method="POST"
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Delegated listener untuk Publish
        document.addEventListener('submit', function(e) {
            if (e.target.classList.contains('form-publish')) {
                e.preventDefault();

                let form = e.target;

                Swal.fire({
                    title: 'Publish Berita?',
                    text: "Berita akan langsung tampil di halaman utama.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Publish!',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        });

        // Delegated listener untuk Draft
        document.addEventListener('submit', function(e) {
            if (e.target.classList.contains('form-draft')) {
                e.preventDefault();

                let form = e.target;

                Swal.fire({
                    title: 'Kembalikan ke Draft?',
                    text: "Berita tidak akan tampil lagi ke publik.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Set Draft!',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#6c757d'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        });
    </script>
@endsection
