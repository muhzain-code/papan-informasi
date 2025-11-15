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
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        @endif

        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h3>Settings</h3>
                    <p class="text-subtitle text-muted">Mengelola konfigurasi dasar website.</p>
                </div>
                <div class="col-12 col-md-6 text-end">
                    <nav aria-label="breadcrumb" class="breadcrumb-header">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">Index</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between flex-wrap mb-4">

                        <!-- Entries Dropdown -->
                        <form method="GET" class="d-flex align-items-center">
                            <label class="me-2">Show</label>
                            <select name="entries" onchange="this.form.submit()" class="form-select form-select-sm w-auto">
                                <option value="10" {{ $entries == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ $entries == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ $entries == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ $entries == 100 ? 'selected' : '' }}>100</option>
                            </select>
                            <span class="ms-2">entries</span>

                            {{-- pertahankan search --}}
                            <input type="hidden" name="search" value="{{ $search }}">
                        </form>

                        <!-- Search -->
                        <form method="GET" class="d-flex">
                            <input type="text" name="search" value="{{ $search }}"
                                class="form-control form-control-sm" placeholder="Cari key / value...">

                            {{-- Pertahankan entries --}}
                            <input type="hidden" name="entries" value="{{ $entries }}">

                            <button class="btn btn-primary btn-sm ms-2">Search</button>
                        </form>
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th>Key</th>
                                <th>Value</th>
                                <th style="width: 80px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($settings as $item)
                                <tr>
                                    <td>{{ $settings->firstItem() + $loop->index }}</td>
                                    <td>{{ $item->key }}</td>
                                    <td>{{ Str::limit($item->value, 50, '...') }}</td>
                                    <td>
                                        <a href="{{ route('admin.settings.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="mt-3">
                        {{ $settings->links() }}
                    </div>

                </div>
            </div>
        </section>



    </div>
@endsection
