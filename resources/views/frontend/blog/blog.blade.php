@extends('frontend.layouts.dashboard')

@section('content')
    <!-- Blog Start -->
<div class="container-fluid blog blog-list-view py-5">
    <div class="container py-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-primary">Berita</h4>
            <h1 class="display-4 mb-4">Berita Terbaru</h1>
        </div>
        
        <div class="row g-4">
            @foreach ($news as $berita)
                
                <div class="col-md-12 col-lg-6 wow fadeInUp" data-wow-delay="0.2s">
                    
                    <div class="blog-item">
                        <div class="blog-img-container">
                            <img src="{{ Illuminate\Support\Facades\Storage::url($berita->thumbnail) ?? 'belum ada gambar' }}"
                                alt="{{ $berita->title }}">
                        </div>
                        <div class="blog-content">
                            <div class="blog-comment">
                                <div class="small"><span class="fa fa-calendar text-primary"></span>
                                    {{ \Carbon\Carbon::parse($berita->published_at)->translatedFormat('d F Y, H:i') }}
                                </div>
                            </div>
                            
                            <a href="{{ route('blog.show', $berita->slug) }}"
                                class="h4 d-inline-block">{{ $berita->title }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
            
            <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.2s">
                <a class="btn btn-primary rounded-pill py-3 px-5" href="#">Berita Lainnya</a>
            </div>
        </div>
    </div>
</div>
    <!-- Blog End -->
@endsection
