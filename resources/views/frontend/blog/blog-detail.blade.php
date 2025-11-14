@extends('frontend.layouts.dashboard')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Berita</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('blog.index') }}">Berita</a></li>
                <li class="breadcrumb-item active text-primary">Berita Detail</li>
            </ol>
        </div>
    </div>
    <!-- Header End -->

    <div class="container-fluid blog-detail py-5">
    <div class="container py-5">
        <div class="row g-5">

            <div class="col-lg-8">
                <div class="blog-detail-left">
                    <div class="blog-detail-image mb-4">
                        <img src="{{ Illuminate\Support\Facades\Storage::url($news->thumbnail) ?? 'belum ada gambar' }}"
                            class="img-fluid w-100 rounded" alt="Gambar Utama Berita">
                    </div>

                    <div class="blog-detail-meta mb-3">
                        <span class="fa fa-calendar text-primary"></span>
                        {{ \Carbon\Carbon::parse($news->published_at)->translatedFormat('d F Y, H:i') }}
                    </div>

                    <h1 class="blog-detail-title mb-3">
                        {{ $news->title }}
                    </h1>

                    <div class="blog-detail-content">
                        {!! $news->content !!}
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="blog-detail-side">
                    <h4 class="mb-4">Berita Lain</h4>

                    @foreach ($newsAll as $beritaLain)
                        <div class="blog-detail-side-item mb-4">
                            <div class="side-img">
                                <img src="{{ Illuminate\Support\Facades\Storage::url($beritaLain->thumbnail) ?? 'belum ada gambar' }}"
                                    class="img-fluid" alt="Thumbnail {{ $beritaLain->title }}">
                            </div>
                            <div class="side-text">
                                <a href="{{ route('blog.show', $beritaLain->slug) }}" class="side-title">
                                    {{ $beritaLain->title }}
                                </a>
                                <div class="side-date">
                                    <span class="fa fa-calendar text-primary"></span>
                                    {{ \Carbon\Carbon::parse($beritaLain->published_at)->translatedFormat('d F Y, H:i') }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
