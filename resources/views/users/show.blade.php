@extends('layouts.dashboard')

@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">

        {{-- Page Title --}}
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Detail User</h3>
                    <p class="text-subtitle text-muted">Informasi lengkap tentang user.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                            <li class="breadcrumb-item active">Detail</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-body">

                    {{-- NAME --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama</label>
                        <p>{{ $user->name }}</p>
                    </div>

                    {{-- EMAIL --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <p>{{ $user->email }}</p>
                    </div>

                    {{-- ROLES --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Role</label>
                        <p>
                            @foreach ($user->roles as $role)
                                <span class="badge bg-primary me-1">{{ $role->name }}</span>
                            @endforeach
                        </p>
                    </div>

                    {{-- STATUS --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <p>
                            <span class="badge bg-{{ $user->is_active ? 'success' : 'secondary' }}">
                                {{ $user->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </p>
                    </div>

                    {{-- CREATED & UPDATED --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Dibuat pada</label>
                        <p>{{ $user->created_at->format('d M Y, H:i') }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Terakhir diperbarui</label>
                        <p>{{ $user->updated_at->format('d M Y, H:i') }}</p>
                    </div>

                    {{-- BUTTONS --}}
                    <a href="{{ route('users.index') }}" class="btn btn-secondary me-2">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Edit
                    </a>

                </div>
            </div>
        </section>

    </div>
@endsection
