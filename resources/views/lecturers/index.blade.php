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
            <div id="toast-success" class="toast align-items-center text-bg-success border-0 position-fixed top-0 end-0 m-3"
                role="alert" aria-live="assertive" aria-atomic="true" style="z-index: 1080;">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        @endif

        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Dosen</h3>
                    <p class="text-subtitle text-muted">Mengelola data dosen yang terdaftar.</p>
                </div>

                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Lecturers</li>
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
                        <h5 class="card-title mb-0">Data Lecturers</h5>
                        <a href="{{ route('lecturers.create') }}" class="btn btn-primary mb-3 ms-auto">
                            <i class="bi bi-plus-circle"></i> Tambah
                        </a>
                    </div>

                    {{-- FILTER --}}
                    <div class="d-flex justify-content-between flex-wrap mb-4">

                        {{-- Entries --}}
                        <form method="GET" class="d-flex align-items-center">
                            <label class="me-2">Show</label>
                            <select name="entries" onchange="this.form.submit()" class="form-select form-select-sm w-auto">
                                <option value="10" {{ $entries == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ $entries == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ $entries == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ $entries == 100 ? 'selected' : '' }}>100</option>
                            </select>
                            <span class="ms-2">entries</span>

                            <input type="hidden" name="search" value="{{ $search }}">
                        </form>

                        {{-- Search --}}
                        <form method="GET" class="d-flex">
                            <input type="text" name="search" value="{{ $search }}"
                                class="form-control form-control-sm" placeholder="Cari nama, NIDN, atau email...">

                            <input type="hidden" name="entries" value="{{ $entries }}">

                            <button class="btn btn-primary btn-sm ms-2">Search</button>
                        </form>
                    </div>

                    {{-- TABLE --}}
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIDN</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $no = ($lecturers->currentPage() - 1) * $lecturers->perPage() + 1;
                            @endphp

                            @foreach ($lecturers as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->nidn }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->created_at?->format('d M Y, H:i') }}</td>

                                    <td>
                                        <div class="d-flex gap-1">

                                            {{-- Edit --}}
                                            <a href="{{ route('lecturers.edit', $item->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            {{-- Delete --}}
                                            <form action="{{ route('lecturers.destroy', $item->id) }}" method="POST"
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

                    {{-- Pagination --}}
                    <div class="mt-3">
                        {{ $lecturers->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Delete confirm
        document.addEventListener('submit', function(e) {
            if (e.target.classList.contains('delete-form')) {
                e.preventDefault();
                let form = e.target;

                Swal.fire({
                    title: 'Hapus Dosen?',
                    text: "Data tidak dapat dikembalikan.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#d33'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        });
    </script>
@endsection
