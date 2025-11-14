@extends('frontend.layouts.dashboard')

@section('content')
    <!--  Banner Section -->
    <section class="banner-section banner-inner-section position-relative overflow-hidden d-flex align-items-end"
        style="background-image: url(../assets/images/backgrounds/projects-banner.jpg);">
        <div class="container">
            <div class="d-flex flex-column gap-4 pb-5 pb-xl-10 position-relative z-1">
                <div class="row align-items-center">
                    <div class="col-xl-4">
                        <div class="d-flex align-items-center gap-4" data-aos="fade-up" data-aos-delay="100"
                            data-aos-duration="1000">
                            <img src="../assets/images/svgs/primary-leaf.svg" alt="" class="img-fluid animate-spin">
                            <p class="mb-0 text-white fs-5 text-opacity-70">A <span class="text-primary">showcase of
                                    creativity</span>, strategy, and results explore the projects that define us.</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-end gap-3" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                    <h1 class="mb-0 fs-16 text-white lh-1">Projects</h1>
                    <a href="javascript:void(0)" class="p-1 ps-7 bg-primary rounded-pill">
                        <span class="bg-white round-52 rounded-circle d-flex align-items-center justify-content-center">
                            <iconify-icon icon="lucide:arrow-up-right" class="fs-8 text-dark"></iconify-icon>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!--  Project Section -->
    <section class="project py-5 py-lg-11 py-xl-12">
        <div class="container">
            <div class="row">
                @foreach ($events as $event)
                    <div class="col-lg-6 mb-7">
                        <div class="portfolio d-flex flex-column gap-6" data-aos="fade-up" data-aos-delay="100"
                            data-aos-duration="1000">
                            <div class="portfolio-img position-relative overflow-hidden">
                                <img src="{{ Illuminate\Support\Facades\Storage::url($event->thumbnail) ?? 'belum ada gambar' }}"
                                    alt="" class="img-fluid w-100">
                                <div class="portfolio-overlay">
                                    <a href="{{ route('agenda.show', $event->slug) }}"
                                        class="position-absolute top-50 start-50 translate-middle bg-primary round-64 rounded-circle hstack justify-content-center">
                                        <iconify-icon icon="lucide:arrow-up-right" class="fs-8 text-dark"></iconify-icon>
                                    </a>
                                </div>
                            </div>
                            <div class="portfolio-details d-flex flex-column gap-3 modern-portfolio-details">

                                <!-- TITLE -->
                                <h3 class="portfolio-title mb-0">{{ $event->title }}</h3>

                                <!-- SHORT CONTENT -->
                                <div class="project-content">
                                    {{ $event->description }}
                                </div>

                                <!-- META INFO -->
                                <div class="project-meta-grid">
                                    <div class="meta-item">
                                        <iconify-icon icon="lucide:calendar" class="meta-icon"></iconify-icon>
                                        <span>
                                            {{ \Carbon\Carbon::parse($event->start_date)->translatedFormat('d F Y, H:i') }}
                                            -
                                            {{ $event->end_date ? \Carbon\Carbon::parse($event->end_date)->translatedFormat('d F Y, H:i') : 'Selesai' }}
                                        </span>

                                    </div>

                                    <div class="meta-item">
                                        <iconify-icon icon="lucide:map-pin" class="meta-icon"></iconify-icon>
                                        <span>{{ $event->location }}</span>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection
