@extends('layouts.dashboard')

@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>Detail Log Aktivitas</h3>

        <div class="card mt-3">
            <div class="card-body">

                <table class="table table-bordered">
                    <tr>
                        <th width="200">ID Log</th>
                        <td>{{ $activity->id }}</td>
                    </tr>

                    <tr>
                        <th>Aktivitas</th>
                        <td>{{ $activity->description }}</td>
                    </tr>

                    <tr>
                        <th>User</th>
                        <td>{{ $activity->causer->name ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>Model</th>
                        <td>{{ class_basename($activity->subject_type) ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>Tanggal</th>
                        <td>{{ $activity->created_at->format('d M Y H:i') }}</td>
                    </tr>

                    <tr>
                        <th>Detail Properties</th>
                        <td>
                            <pre style="white-space: pre-wrap; background:#f8f9fa; padding:12px; border-radius:6px;">
{{ json_encode($activity->properties, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}
                        </pre>
                        </td>
                    </tr>
                </table>

                <!-- Tombol kembali di bawah kiri -->
                <div class="mt-3">
                    <a href="{{ route('activity.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection
