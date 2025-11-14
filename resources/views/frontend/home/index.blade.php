@extends('frontend.layouts.dashboard')

@section('content')
    <!--  Banner Section -->
    <section class="banner-section position-relative d-flex align-items-end min-vh-100">
        <video class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover" autoplay muted loop playsinline>
            <source src="../assets/images/backgrounds/unuja-video.mp4" type="video/mp4" />
        </video>
        <div class="container">
            <div class="d-flex flex-column gap-4 pb-8 position-relative z-1">
                <div class="row align-items-center">
                    <div class="col-xl-4">
                        <div class="d-flex align-items-center gap-4" data-aos="fade-up" data-aos-delay="100"
                            data-aos-duration="1000">
                            <img src="../assets/images/svgs/primary-leaf.svg" alt="" class="img-fluid animate-spin">
                            <p class="mb-0 text-dark fs-5 text-opacity-0">Welcome<br><span
                                    class="text-bg-primary">Universitas Nurul
                                    Jadid</span></p>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-end gap-3" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                    <h1 class="mb-0 fs-15 text-dark lh-1">Fakultas Teknik</h1>
                </div>
            </div>
        </div>
    </section>
    <!--  About Highlight Section -->
    <section class="stats-facts py-5 py-lg-11 py-xl-12 position-relative overflow-hidden">
        <div class="container">
            <div class="row align-items-center g-5">

                <!-- Left Video -->
                <div class="col-lg-5" data-aos="fade-right" data-aos-delay="100" data-aos-duration="1000">

                    <div class="ratio ratio-16x9 rounded-4 overflow-hidden"
                        style="width: 100%; max-height: 400px; position: relative; z-index: 5;">

                        <iframe src="https://www.youtube.com/embed/Sjo8RhDPEpM?rel=0&controls=1&modestbranding=1"
                            title="YouTube video" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                            style="width: 100%; height: 100%; border:0; position:absolute; top:0; left:0; z-index:10;">
                        </iframe>

                    </div>

                </div>

                <!-- Right Content -->
                <div class="col-lg-7">
                    <div class="d-flex flex-column gap-4" data-aos="fade-up" data-aos-delay="150" data-aos-duration="1000">

                        <h3 class="mb-0">High quality web design solutions you can trust.</h3>

                        <p class="fs-4 mb-0">
                            When selecting a web design agency, it's essential to consider its reputation,
                            experience, and the specific needs of your project.
                        </p>

                        <a href="about-us.html" class="btn mt-2" data-aos="fade-up" data-aos-delay="300"
                            data-aos-duration="1000">
                            <span class="btn-text">Who we are</span>
                            <iconify-icon icon="lucide:arrow-up-right"
                                class="btn-icon bg-white text-dark round-52 rounded-circle hstack justify-content-center fs-7 shadow-sm">
                            </iconify-icon>
                        </a>

                    </div>
                </div>

            </div>
        </div>

        <!-- Background Decorative -->
        <div class="position-absolute bottom-0 start-0" data-aos="zoom-in" data-aos-delay="100" data-aos-duration="1000"
            style="z-index: 1; pointer-events: none;">
            <img src="../assets/images/backgrounds/stats-facts-bg.svg" alt="" class="img-fluid">
        </div>
    </section>



    <!--  Recent news Section -->
    <section class="Recent-news bg-light-gray py-5 py-lg-11 py-xl-12 modern-news-grid">
        <div class="container">
            <div class="d-flex flex-column gap-5 gap-xl-11">
                <div class="row gap-7 gap-xl-0">
                    <div class="col-xl-4 col-xxl-4">
                        <div class="d-flex align-items-center gap-7 py-2" data-aos="fade-right" data-aos-delay="100"
                            data-aos-duration="1000">
                            <span
                                class="round-36 flex-shrink-0 text-dark rounded-circle bg-primary hstack justify-content-center fw-medium">01</span>
                            <hr class="border-line">
                            <span class="badge text-bg-dark">Berita</span>
                        </div>
                    </div>
                    <div class="col-xl-8 col-xxl-7">

                        <div class="row">
                            <div class="col-xxl-8">
                                <div class="d-flex flex-column gap-6" data-aos="fade-up" data-aos-delay="100"
                                    data-aos-duration="1000">
                                    <h2 class="mb-0">Berita Terbaru</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modern Grid -->
                <div class="modern-grid">
                    @foreach ($news as $berita)
                        <a href="#" class="news-card-link">
                            <div class="news-card" data-aos="fade-up" data-aos-delay="100">

                                <div class="news-img-wrapper">
                                    <img src="{{ Illuminate\Support\Facades\Storage::url($berita->thumbnail) ?? 'belum ada gambar' }}"
                                        alt="resources" class="news-img">
                                </div>

                                <div class="news-info">
                                    <p class="date">{{ $berita->published_at }}</p>
                                    <h4 class="news-title line-clamp-2">{{ $berita->title }}</h4>
                                    <p class="news-desc line-clamp-2">{{ $berita->excerpt }}</p>
                                </div>

                            </div>
                        </a>
                    @endforeach

                </div>

            </div>
            <!-- More News Button -->
            <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="150">
                <a href="blog.html" class="more-news-btn">
                    More News
                    <span class="arrow-icon">→</span>
                </a>
            </div>
        </div>
    </section>



    <!--  Featured Projects Section -->
    <section class="featured-projects py-5 py-lg-11 py-xl-12 bg-light-gray">
        <div class="d-flex flex-column gap-5 gap-xl-11">

            <div class="container">
                <div class="row gap-7 gap-xl-0">
                    <div class="col-xl-4 col-xxl-4">
                        <div class="d-flex align-items-center gap-7 py-2" data-aos="fade-right" data-aos-delay="100"
                            data-aos-duration="1000">
                            <span
                                class="round-36 flex-shrink-0 text-dark rounded-circle bg-primary hstack justify-content-center fw-medium">02</span>
                            <hr class="border-line">
                            <span class="badge text-bg-dark">Agenda</span>
                        </div>
                    </div>
                    <div class="col-xl-8 col-xxl-7">
                        <div class="row">
                            <div class="col-xxl-8">
                                <div class="d-flex flex-column gap-6" data-aos="fade-up" data-aos-delay="100"
                                    data-aos-duration="1000">
                                    <h2 class="mb-0">Agenda Terbaru</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="featured-projects-slider-wrapper">
                <div class="featured-projects-slider">
                    <div class="owl-carousel owl-theme">

                        @foreach ($events as $event)
                            <!-- ITEM 4 -->
                            <div class="item">
                                <div class="portfolio d-flex flex-column gap-6">
                                    <div class="portfolio-img position-relative overflow-hidden">
                                        <img src="{{ Illuminate\Support\Facades\Storage::url($event->thumbnail) }}"
                                            alt="" class="img-fluid">
                                        <div class="portfolio-overlay">
                                            <a href="projects-detail.html"
                                                class="position-absolute top-50 start-50 translate-middle bg-primary round-64 rounded-circle hstack justify-content-center">
                                                <iconify-icon icon="lucide:arrow-up-right"
                                                    class="fs-8 text-dark"></iconify-icon>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="portfolio-details d-flex flex-column gap-3 flex-grow-1">

                                        <h3 class="mb-0">{{ $event->title }}</h3>

                                        <div class="portfolio-meta d-flex flex-column gap-1">
                                            <span class="text-muted small"><strong>Start:</strong>
                                                {{ $event->start_date }}</span>
                                            <span class="text-muted small"><strong>End:</strong>
                                                {{ $event->end_date ?? 'belum ditentukan' }}</span>
                                            <span class="text-muted small"><strong>Location:</strong>
                                                {{ $event->location }}</span>
                                            <p class="text-muted small mb-0">
                                                {{ $event->description }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="text-center mt-5">
                        <a href="blog.html" class="more-news-btn">
                            More Events <span class="arrow-icon">→</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
