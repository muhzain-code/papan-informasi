@extends('frontend.layouts.dashboard')

@section('content')
    <!-- Fullscreen Video Background Section -->
    <section class="video-hero">

        <!-- Background Video -->
        <video autoplay muted loop playsinline class="video-bg">
            <source src="{{ asset('frontend/img/unuja-video.mp4') }}" type="video/mp4">
        </video>

        <!-- Dark Overlay -->
        <!-- <div class="overlay"></div> -->

        <!-- Content -->
        <!-- <div class="hero-content container text-center text-white">
                                                                                                            <h4 class="text-uppercase fw-bold mb-4">Universitas Nurul Jadid</h4>
                                                                                                            <h1 class="display-1 fw-bold mb-4">Fakultas Teknik</h1>
                                                                                                         

                                                                                                            <div class="d-flex justify-content-center flex-wrap">
                                                                                                                <a class="btn btn-light rounded-pill py-3 px-5 me-2 mb-2" href="#">
                                                                                                                    <i class="fas fa-play-circle me-2"></i> Berita
                                                                                                                </a>
                                                                                                                <a class="btn btn-dark rounded-pill py-3 px-5 ms-2 mb-2" href="#">
                                                                                                                    Daftar
                                                                                                                </a>
                                                                                                            </div>
                                                                                                        </div> -->

    </section>

    <!-- Feature Start -->
    <div class="container-fluid feature bg-light py-5 ftnj-section-wrapper">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-primary">Universitas Nurul Jadid</h4>
                <h1 class="display-4 mb-4">Fakultas Teknik</h1>
                <p class="mb-0 ftnj-description">
                    Fakultas Teknik Universitas Nurul Jadid telah berkembang menjadi pusat inovasi dan rekayasa
                    teknologi,
                    berkomitmen mencetak lulusan unggul, berintegritas, dan memiliki kemampuan adaptif terhadap
                    perkembangan
                    era digital. Berbagai layanan dan aplikasi pendukung tersedia untuk pelayanan akademik dan
                    administrasi.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="feature-item p-4 pt-0 ftnj-feature-item">
                        <div class="feature-icon p-4 mb-4 ftnj-icon-box">
                            <i class="fa fa-book"></i>
                        </div>
                        <h4 class="mb-4 ftnj-feature-title">SIAKAD</h4>
                        <p class="mb-4 ftnj-feature-desc">
                            Sistem Informasi Akademik Fakultas Teknik.
                        </p>
                        <a class="btn btn-primary ftnj-btn" href="https://siakadft.unuja.ac.id/">Lihat</a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="feature-item p-4 pt-0 ftnj-feature-item">
                        <div class="feature-icon p-4 mb-4 ftnj-icon-box">
                            <i class="fa fa-tasks"></i>
                        </div>
                        <h4 class="mb-4 ftnj-feature-title">SIAMTEK</h4>
                        <p class="mb-4 ftnj-feature-desc">
                            Sistem Administrasi Monitoring Tugas Akhir, PKL dan KKN.
                        </p>
                        <a class="btn btn-primary ftnj-btn" href="https://siamtek.unuja.ac.id/">Lihat</a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.6s">
                    <div class="feature-item p-4 pt-0 ftnj-feature-item">
                        <div class="feature-icon p-4 mb-4 ftnj-icon-box">
                            <i class="fa fa-user-graduate"></i>
                        </div>
                        <h4 class="mb-4 ftnj-feature-title">Aplikasi Mahasiswa</h4>
                        <p class="mb-4 ftnj-feature-desc">Aplikasi Mahasiswa Universitas Nurul Jadid.</p>
                        <a class="btn btn-primary ftnj-btn" href="https://am.unuja.ac.id/">Lihat</a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.8s">
                    <div class="feature-item p-4 pt-0 ftnj-feature-item">
                        <div class="feature-icon p-4 mb-4 ftnj-icon-box">
                            <i class="fa fa-chalkboard-teacher"></i>
                        </div>
                        <h4 class="mb-4 ftnj-feature-title">Aplikasi Dosen</h4>
                        <p class="mb-4 ftnj-feature-desc">Aplikasi Dosen Universitas Nurul Jadid</p>
                        <a class="btn btn-primary ftnj-btn" href="https://ad.unuja.ac.id/">Lihat</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Feature End -->

    <!-- Blog Start -->
    <div class="container-fluid blog py-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-primary">Berita</h4>
                <h1 class="display-4 mb-4">Berita Terbaru</h1>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach ($news as $berita)
                    {{-- 
                  Grid diubah ke col-lg-4 agar menjadi 3 kolom di layar besar,
                  dan col-md-6 agar menjadi 2 kolom di tablet
                --}}
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.2s">
                        {{-- 
                      Class .blog-item kini diatur oleh CSS di atas 
                      untuk tinggi, bayangan, dan border-radius
                    --}}
                        <div class="blog-item">
                            {{-- 
                          Container BARU untuk aspect-ratio gambar yang fix
                        --}}
                            <div class="blog-img-container">
                                <img src="{{ Illuminate\Support\Facades\Storage::url($berita->thumbnail) ?? 'belum ada gambar' }}"
                                    alt="{{ $berita->title }}">
                            </div>

                            {{-- 
                          Urutan konten diubah (Judul -> Tanggal -> Teks) 
                          agar sesuai gambar referensi
                        --}}
                            <div class="blog-content">

                                {{-- 1. JUDUL (Maks 3 baris) --}}
                                <a href="{{ route('blog.show', $berita->slug) }}"
                                    class="h4 d-inline-block">{{ $berita->title }}</a>

                                {{-- 2. TANGGAL --}}
                                <div class="blog-comment">
                                    <div class="small"><span class="fa fa-calendar text-primary"></span>
                                        {{ \Carbon\Carbon::parse($berita->published_at)->translatedFormat('d F Y, H:i') }}
                                    </div>
                                </div>

                                {{-- 3. KONTEN (Dipotong otomatis) --}}
                                <p>{{ $berita->content }}</p>

                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.2s">
                    <a class="btn btn-primary rounded-pill py-3 px-5" href="{{ route('blog.index') }}">Berita Lainnya</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog End -->

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

                <div class="col-12 text-center mt-5 wow fadeInUp" data-wow-delay="0.2s">
                    <a class="btn btn-primary rounded-pill py-3 px-5" href="{{ route('agenda.index') }}">Agenda
                        Lainnya</a>
                </div>

            </div>
        </div>
    </div>
    <!-- Service End -->

    <!-- Testimonial Start -->
    <div class="container-fluid testimonial pb-5">
        <div class="container pb-5">

            <!-- NEW TITLE -->
            <div class="text-center mx-auto pb-4 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-primary">Video Galeri</h4>
                <h1 class="display-5 mb-3">Video Kegiatan & Dokumentasi</h1>
            </div>

            <!-- NEW VIDEO CAROUSEL -->
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.2s">

                <!-- Video 1 -->
                <div class="video-card-new bg-light rounded overflow-hidden">
                    <div class="ratio ratio-16x9 video-wrapper-new">
                        <iframe src="https://www.youtube.com/embed/Sjo8RhDPEpM" allowfullscreen>
                        </iframe>
                    </div>
                </div>

                <!-- Video 2 -->
                <div class="video-card-new bg-light rounded overflow-hidden">
                    <div class="ratio ratio-16x9 video-wrapper-new">
                        <iframe src="https://www.youtube.com/embed/VIDEO_ID_2" allowfullscreen>
                        </iframe>
                    </div>
                </div>

                <!-- Video 3 -->
                <div class="video-card-new bg-light rounded overflow-hidden">
                    <div class="ratio ratio-16x9 video-wrapper-new">
                        <iframe src="https://www.youtube.com/embed/VIDEO_ID_3" allowfullscreen>
                        </iframe>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- Testimonial End -->
@endsection
