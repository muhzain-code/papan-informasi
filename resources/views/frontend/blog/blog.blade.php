@extends('frontend.layouts.dashboard')

@section('content')
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
                    <a class="btn btn-primary rounded-pill py-3 px-5" href="#">Berita Lainnya</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog End -->
@endsection
