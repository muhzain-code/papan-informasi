@extends('frontend.layouts.dashboard')

@section('content')
    <!--  Banner Section -->
    <section class="banner-section banner-inner-section position-relative overflow-hidden d-flex align-items-end"
        style="background-image: url(../assets/images/backgrounds/blog-detail-banner.jpg);">
        <div class="container">
            <div class="d-flex flex-column gap-4 pb-5 pb-xl-10 position-relative z-1">
                <div class="row align-items-center">
                    <div class="col-xl-4">
                        <div class="d-flex align-items-center gap-4" data-aos="fade-up" data-aos-delay="100"
                            data-aos-duration="1000">
                            <img src="../assets/images/svgs/primary-leaf.svg" alt="" class="img-fluid animate-spin">
                            <p class="mb-0 text-white fs-5 text-opacity-70">In a <span class="text-primary">world where
                                    standing</span> still means falling behind, we
                                knew it was time for a bold transformation..</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-end gap-3" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                    <h1 class="mb-0 fs-15 text-white lh-1">A campaign that connects</h1>
                    <a href="javascript:void(0)" class="p-1 ps-7 bg-primary rounded-pill">
                        <span class="bg-white round-52 rounded-circle d-flex align-items-center justify-content-center">
                            <iconify-icon icon="lucide:arrow-up-right" class="fs-8 text-dark"></iconify-icon>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!--  Blog Detail Section -->
    <section class="blog-detail py-5 py-lg-11 py-xl-12">
        <div class="container">
            <div class="d-flex flex-column gap-7 gap-xl-11">

                <!-- Blog Image -->
                <div class="blog-detail-img text-center" data-aos="fade-up" data-aos-delay="300" data-aos-duration="1000"
                    style="overflow:hidden; border-radius:12px;">
                    <img src="../assets/images/backgrounds/blog-detail-img.jpg" alt="blog-detail" class="img-fluid w-100"
                        style="object-fit:cover; max-height:480px;">
                </div>

                <!-- Title + Date + Content -->
                <div class="row justify-content-end">
                    <div class="col-lg-12 d-flex flex-column gap-3">

                        <!-- Title -->
                        <h2 class="fw-bold" data-aos="fade-up" data-aos-delay="320" data-aos-duration="1000"
                            style="line-height:1.3;">
                            Judul Blog yang Menarik dan Informatif
                        </h2>

                        <!-- Blog Date -->
                        <div class="blog-date mb-1" data-aos="fade-up" data-aos-delay="350" data-aos-duration="1000">
                            <span class="date-text text-muted">Published on • 12 November 2025</span>
                        </div>

                        <!-- Blog Content -->
                        <div data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">
                            <p class="fs-5 mb-0">
                                Blogger outreach campaigns adalah strategi kolaborasi antara bisnis dengan blogger
                                berpengaruh untuk
                                mempromosikan produk, layanan, atau konten tertentu. Teknik pemasaran ini memanfaatkan
                                kredibilitas
                                dan jangkauan yang dimiliki blogger di dalam niche mereka, sehingga mampu meningkatkan
                                awareness dan
                                engagement secara signifikan.
                            </p>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
