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
                role="alert" aria-live="assertive" aria-atomic="true" style="z-index:1080">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        @endif

        <div class="page-title mb-4">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h3>Jadwal Kuliah</h3>
                    <p class="text-subtitle text-muted">
                        Data jadwal kuliah dari API UNUJA.
                        @if ($lastSync)
                            <br><small class="text-success">
                                <i class="bi bi-check-circle"></i> Terakhir sync: {{ $lastSync->synced_at->diffForHumans() }}
                                ({{ $lastSync->records_synced }} jadwal)
                            </small>
                        @endif
                    </p>
                </div>

                <div class="col-12 col-md-6">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Jadwal</li>
                            <li class="breadcrumb-item active">Index</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        {{-- Stats Cards (Posisi dirapikan, warna tetap asli) --}}
        <div class="row mb-4">
            <div class="col-6 col-lg-3">
                <div class="card bg-primary text-white mb-3 mb-lg-0">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-calendar-week fs-2 me-3"></i>
                            <div>
                                <h4 class="mb-0 text-white">{{ $stats['total_jadwal'] }}</h4>
                                <small>Total Jadwal</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card bg-success text-white mb-3 mb-lg-0">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-building fs-2 me-3"></i>
                            <div>
                                <h4 class="mb-0 text-white">{{ $stats['total_fakultas'] }}</h4>
                                <small>Fakultas</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card bg-info text-white mb-3 mb-lg-0">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-mortarboard fs-2 me-3"></i>
                            <div>
                                <h4 class="mb-0 text-white">{{ $stats['total_prodi'] }}</h4>
                                <small>Program Studi</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card bg-warning text-dark mb-0">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-book fs-2 me-3"></i>
                            <div>
                                <h4 class="mb-0 text-dark">{{ $stats['total_mata_kuliah'] }}</h4>
                                <small>Mata Kuliah</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                        <h5 class="card-title mb-0">Data Jadwal Kuliah</h5>
                        <form action="{{ route('jadwal.sync') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-arrow-repeat"></i> Sync Data
                            </button>
                        </form>
                    </div>

                    {{-- Filters (Layout Baru: Search di atas, Dropdown di bawah) --}}
                    <form method="GET" class="mb-4 ajax-form">
                        {{-- Baris 1: Pencarian --}}
                        <div class="row g-2 mb-2">
                            <div class="col-12 col-md-5">
                                <input type="text" name="search" value="{{ $search }}" class="form-control"
                                    placeholder="Cari mata kuliah / ruangan...">
                            </div>
                            <div class="col-12 col-md-5">
                                <input type="text" name="dosen" value="{{ $dosen }}" class="form-control"
                                    placeholder="Cari nama dosen...">
                            </div>
                            <div class="col-12 col-md-2 d-grid">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-search"></i> Cari
                                </button>
                            </div>
                        </div>

                        {{-- Baris 2: Dropdown Filter --}}
                        <div class="row g-2">
                            <div class="col-6 col-md-2">
                                <select name="entries" class="form-select form-select-sm">
                                    <option value="15" {{ $entries == 15 ? 'selected' : '' }}>15 Baris</option>
                                    <option value="25" {{ $entries == 25 ? 'selected' : '' }}>25 Baris</option>
                                    <option value="50" {{ $entries == 50 ? 'selected' : '' }}>50 Baris</option>
                                    <option value="100" {{ $entries == 100 ? 'selected' : '' }}>100 Baris</option>
                                </select>
                            </div>

                            <div class="col-6 col-md-2">
                                <select name="hari" class="form-select form-select-sm">
                                    <option value="">Semua Hari</option>
                                    @foreach ($hariList as $h)
                                        <option value="{{ $h }}" {{ $hari == $h ? 'selected' : '' }}>
                                            {{ $h }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-6 col-md-3">
                                <select name="fakultas" class="form-select form-select-sm">
                                    <option value="">Semua Fakultas</option>
                                    @foreach ($fakultasList as $fak)
                                        <option value="{{ $fak->api_id }}" {{ $fakultas == $fak->api_id ? 'selected' : '' }}>
                                            {{ $fak->singkatan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-6 col-md-3">
                                <select name="prodi" class="form-select form-select-sm">
                                    <option value="">Semua Prodi</option>
                                    @foreach ($prodiList as $p)
                                        <option value="{{ $p->api_id }}" {{ $prodi == $p->api_id ? 'selected' : '' }}>
                                            {{ $p->nama }} ({{ $p->jenjang }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            @if ($semesterList->isNotEmpty())
                                <div class="col-6 col-md-2">
                                    <select name="semester" class="form-select form-select-sm">
                                        <option value="">Semua Smt</option>
                                        @foreach ($semesterList as $smt)
                                            <option value="{{ $smt }}" {{ $semester == $smt ? 'selected' : '' }}>
                                                Semester {{ $smt }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                        </div>
                    </form>

                    <div id="table-container">
                        {{-- Table (TIDAK DISENTUH SAMA SEKALI) --}}
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Hari</th>
                                    <th>Jam</th>
                                    <th>Mata Kuliah</th>
                                    <th>SKS</th>
                                    <th>Kelas</th>
                                    <th>Dosen</th>
                                    <th>Ruangan</th>
                                    <th>Prodi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $no = ($jadwal->currentPage() - 1) * $jadwal->perPage() + 1;
                                @endphp

                                @forelse ($jadwal as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td><span class="badge bg-info">{{ $item->hari }}</span></td>
                                        <td><small>{{ $item->waktu }}</small></td>
                                        <td>
                                            <strong>{{ $item->mataKuliah?->nama ?? 'N/A' }}</strong>
                                            <br><small class="text-muted">{{ $item->mata_kuliah_kode }}</small>
                                        </td>
                                        <td>{{ $item->mataKuliah?->sks ?? 0 }}</td>
                                        <td>{{ $item->kelas_nama }}</td>
                                        <td><small>{{ $item->dosen_nama }}</small></td>
                                        <td>{{ $item->ruangan ?? '-' }}</td>
                                        <td>
                                            <span class="badge bg-primary">{{ $item->prodi?->singkatan ?? 'N/A' }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('jadwal.show', $item->id) }}" class="btn btn-info btn-sm">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center text-muted py-4">
                                            <i class="bi bi-calendar-x fs-1 d-block mb-2"></i>
                                            Belum ada data jadwal. Klik tombol "Sync Data" untuk mengambil data dari API.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-3">
                        {{ $jadwal->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const toast = document.getElementById('toast-success');
                if (toast) {
                    const bsToast = new bootstrap.Toast(toast);
                    bsToast.show();
                }
            });
        </script>
    @endpush
@endsection