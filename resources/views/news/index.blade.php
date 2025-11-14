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
                        <a href="{{ route('admin.news.create') }}" class="btn btn-primary mb-3 ms-auto">
                            <i class="bi bi-plus-circle"></i> Tambah
                        </a>
                    </div>

                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Tanggal Publikasi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($news as $item)
                                <tr>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->published_at ? $item->published_at->format('d M Y, H:i') : '-' }}</td>
                                    <td>
                                        @if ($item->status === 'draft')
                                            <span class="badge bg-warning text-dark">Draft</span>
                                        @else
                                            <span class="badge bg-success">Published</span>
                                        @endif
                                    </td>
                                    <td class="d-flex gap-1">
                                        @if ($item->status === 'draft')
                                            <form action="{{ route('admin.news.publish', $item->id) }}" method="POST"
                                                class="d-inline form-publish">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm"
                                                    title="Publish Berita">
                                                    <i class="bi bi-check-circle"></i>
                                                </button>
                                            </form>
                                        @elseif ($item->status === 'published')
                                            <form action="{{ route('admin.news.draft', $item->id) }}" method="POST"
                                                class="d-inline form-draft">
                                                @csrf
                                                <button type="submit" class="btn btn-secondary btn-sm" title="Set Draft">
                                                    <i class="bi bi-arrow-counterclockwise"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('admin.news.show', $item->id) }}" class="btn btn-info btn-sm"
                                            title="Lihat">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-warning btn-sm"
                                            title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST"
                                            class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus Berita">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
