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
                    <h3>Detail Jadwal</h3>
                    <p class="text-subtitle text-muted">Detail jadwal kuliah.</p>
                </div>

                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('jadwal.index') }}">Jadwal</a>
                            </li>
                            <li class="breadcrumb-item active">Detail</li>
                        </ol>
                    </nav>
                </div>

            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            {{-- Mata Kuliah --}}
                            <div class="mb-3">
                                <label class="form-label"><strong>Mata Kuliah</strong></label>
                                <p class="fs-5">{{ $jadwal->mataKuliah?->nama ?? 'N/A' }}</p>
                                <small class="text-muted">Kode: {{ $jadwal->mata_kuliah_kode }}</small>
                            </div>

                            {{-- SKS --}}
                            <div class="mb-3">
                                <label class="form-label"><strong>SKS</strong></label>
                                <p>{{ $jadwal->mataKuliah?->sks ?? 0 }} SKS</p>
                            </div>

                            {{-- Kelas --}}
                            <div class="mb-3">
                                <label class="form-label"><strong>Kelas</strong></label>
                                <p><span class="badge bg-secondary fs-6">{{ $jadwal->kelas_nama }}</span></p>
                            </div>

                            {{-- Dosen --}}
                            <div class="mb-3">
                                <label class="form-label"><strong>Dosen</strong></label>
                                <p>{{ $jadwal->dosen_nama }}</p>
                            </div>

                            {{-- Program Studi --}}
                            <div class="mb-3">
                                <label class="form-label"><strong>Program Studi</strong></label>
                                <p>
                                    <span class="badge bg-primary me-1">{{ $jadwal->prodi?->singkatan ?? 'N/A' }}</span>
                                    {{ $jadwal->prodi?->nama ?? '' }} ({{ $jadwal->prodi?->jenjang ?? '' }})
                                </p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            {{-- Hari --}}
                            <div class="mb-3">
                                <label class="form-label"><strong>Hari</strong></label>
                                <p><span class="badge bg-info fs-6">{{ $jadwal->hari }}</span></p>
                            </div>

                            {{-- Waktu --}}
                            <div class="mb-3">
                                <label class="form-label"><strong>Waktu</strong></label>
                                <p class="fs-5">{{ $jadwal->waktu }}</p>
                                <small class="text-muted">Raw: {{ $jadwal->jam }}</small>
                            </div>

                            {{-- Ruangan --}}
                            <div class="mb-3">
                                <label class="form-label"><strong>Ruangan</strong></label>
                                <p class="fs-5">{{ $jadwal->ruangan ?? '-' }}</p>
                            </div>

                            {{-- Fakultas --}}
                            <div class="mb-3">
                                <label class="form-label"><strong>Fakultas</strong></label>
                                <p>
                                    <span class="badge bg-secondary me-1">{{ $jadwal->prodi?->fakultas?->singkatan ?? 'N/A' }}</span>
                                    {{ $jadwal->prodi?->fakultas?->nama ?? '' }}
                                </p>
                            </div>

                            @if ($jadwal->gabung_mata_kuliah_nama)
                            {{-- Gabung Kelas --}}
                            <div class="mb-3">
                                <label class="form-label"><strong>Gabung dengan</strong></label>
                                <p>
                                    {{ $jadwal->gabung_mata_kuliah_nama }} 
                                    (Kelas {{ $jadwal->gabung_kelas_nama }})
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <hr>

                    {{-- Sync Info --}}
                    <div class="mb-3">
                        <small class="text-muted">
                            <i class="bi bi-clock"></i> Terakhir sync: 
                            {{ $jadwal->synced_at ? $jadwal->synced_at->format('d M Y, H:i') : '-' }}
                        </small>
                    </div>

                    {{-- Tombol --}}
                    <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                </div>
            </div>
        </section>
    </div>
@endsection
