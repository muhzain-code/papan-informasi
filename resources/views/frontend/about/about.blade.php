 @extends('frontend.layouts.dashboard')

 @section('content')
       <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">About Us</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-primary">About</li>
            </ol>
        </div>
    </div>
    <!-- Header End -->


    <!-- About Start -->
   <div class="container-fluid about-fakultas-wrapper py-5 bg-light">
    <div class="container py-5">
        
        <div class="row g-5 align-items-center">

            <div class="col-lg-5 wow fadeInUp" data-wow-delay="0.2s">
                <div class="about-fakultas-image rounded overflow-hidden shadow-lg">
                    <img src="{{ asset('frontend/img/ft.jpg') }}" class="w-100 img-fluid" alt="Gedung Fakultas Teknik UNUJA">
                </div>
            </div>

            <div class="col-lg-7 wow fadeInUp" data-wow-delay="0.4s">
                <h4 class="text-primary mb-2">Sejarah Fakultas Teknik</h4>
                <h1 class="display-5 fw-bold mb-4">Universitas Nurul Jadid</h1>

                <p class="mb-3 lead" style="text-align: justify;">
                    Fakultas Teknik Universitas Nurul Jadid berdiri sebagai bagian dari pengembangan
                    pendidikan tinggi yang berkomitmen untuk mencetak generasi unggul di bidang teknologi
                    dan rekayasa. Sejak awal berdirinya, fakultas ini berfokus pada penguatan riset,
                    inovasi, serta pengabdian kepada masyarakat.
                </p>

                <p class="mb-4" style="text-align: justify;">
                    Dengan berbagai program studi dan fasilitas modern, fakultas ini terus berkembang
                    mengikuti kebutuhan industri dan dunia kerja.
                </p>

                <ul class="about-f-list list-unstyled mt-4">
                    <li class="mb-2"><i class="fa fa-check text-primary me-3"></i>Fokus pada inovasi dan teknologi</li>
                    <li class="mb-2"><i class="fa fa-check text-primary me-3"></i>Kerjasama industri dan akademik</li>
                    <li class="mb-2"><i class="fa fa-check text-primary me-3"></i>Pusat riset dan laboratorium lengkap</li>
                </ul>

            </div>

        </div>
    </div>
</div>
 @endsection
