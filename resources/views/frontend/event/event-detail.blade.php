@extends('frontend.layouts.dashboard')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Agenda</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('agenda.index') }}">Agenda</a></li>
                <li class="breadcrumb-item active text-primary">Agenda Detail</li>
            </ol>
        </div>
    </div>
    <!-- Header End -->


    <!-- AGENDA DETAIL START -->
    <div class="container agenda-detail-wrapper py-5">

        <!-- BIG IMAGE -->
        <div class="agenda-detail-image mb-4">
            <img src="{{ Illuminate\Support\Facades\Storage::url($event->thumbnail) ?? 'belum ada gambar' }}" alt="Agenda Image" class="img-fluid rounded-4 w-100">
        </div>

        <!-- CONTENT -->
        <div class="agenda-detail-content">

            <h1 class="agenda-detail-title mb-3">{{ $event->title }}</h1>

            <div class="agenda-detail-meta d-flex flex-wrap gap-4 mb-4">
                <div><i class="fa fa-calendar text-primary me-2"></i> Start:
                    {{ \Carbon\Carbon::parse($event->start_date)->translatedFormat('d F Y, H:i') }}</div>
                <div><i class="fa fa-calendar-check text-primary me-2"></i> End:
                    {{ $event->end_date ? \Carbon\Carbon::parse($event->end_date)->translatedFormat('d F Y, H:i') : 'Selesai' }}
                </div>
                <div><i class="fa fa-map-marker-alt text-primary me-2"></i> {{ $event->location }}</div>
            </div>

            <p class="agenda-detail-desc">
                {{ $event->description }}
            </p>

            {{-- <a href="#" class="btn btn-primary rounded-pill py-3 px-5 mt-3">Back to Agenda List</a> --}}
        </div>

    </div>
    <!-- AGENDA DETAIL END -->
@endsection
