@extends('frontend.layouts.dashboard')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Agenda</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active text-primary">Agenda</li>
            </ol>
        </div>
    </div>
    <!-- Header End -->

    <!-- Service Start -->
    <div class="container-fluid service py-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-primary">Agenda</h4>
                <h1 class="display-4 mb-4">Agenda Terbaru</h1>
            </div>

            <div class="row g-lg-4 g-3 justify-content-center">

                @foreach ($events as $event)
                    <div class="col-12 col-lg-6 wow fadeInUp" data-wow-delay="0.2s">

                        <a href="{{ route('agenda.show', $event->slug) }}" class="agenda-card-stylish"
                            aria-label="Lihat detail {{ $event->title }}"
                            style="background-image: url('{{ Illuminate\Support\Facades\Storage::url($event->thumbnail) ?? 'https://via.placeholder.com/600x400.png?text=No+Image' }}');">

                            <div class="agenda-content-overlay">

                                <div class="agenda-meta-stylish">
                                    <span class="meta-pill">
                                        <i class="fa fa-calendar-alt"></i>
                                        <span>
                                            {{ \Carbon\Carbon::parse($event->start_date)->translatedFormat('d M Y') }}
                                            @if (
                                                $event->end_date &&
                                                    \Carbon\Carbon::parse($event->start_date)->format('Y-m-d') !=
                                                        \Carbon\Carbon::parse($event->end_date)->format('Y-m-d'))
                                                - {{ \Carbon\Carbon::parse($event->end_date)->translatedFormat('d M Y') }}
                                            @endif
                                        </span>
                                    </span>
                                    <span class="meta-pill">
                                        <i class="fa fa-map-marker-alt"></i>
                                        <span>{{ $event->location }}</span>
                                    </span>
                                </div>

                                <h4 class="agenda-title-stylish">{{ $event->title }}</h4>
                            </div>

                        </a>
                    </div>
                @endforeach

                <div class="col-12 wow fadeInUp" data-wow-delay="0.2s">

                    <div class="d-flex justify-content-between align-items-center">

                        <div class="pagination-info text-muted small">
                            {{-- Menampilkan {{ $news->firstItem() }} - {{ $news->lastItem() }} dari {{ $news->total() }} berita --}}
                        </div>

                        <div>
                            {{ $events->links() }}
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Service End -->
@endsection
