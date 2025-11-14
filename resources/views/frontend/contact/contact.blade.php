@extends('frontend.layouts.dashboard')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Contact Us</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-primary">Contact</li>
            </ol>
        </div>
    </div>
    <!-- Header End -->


   <div class="container-fluid contact bg-light py-5">
    <div class="container py-5">
        
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-primary">KONTAK KAMI</h4>
            <h1 class="display-4 mb-4">Hubungi Kami Untuk Informasi Lebih Lanjut</h1>
        </div>

        <div class="row g-5">
            
            <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                <div class="h-100 rounded overflow-hidden shadow-sm">
                    <iframe 
                        class="w-100 h-100" 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.511425178586!2d113.51860637592477!3d-7.735172277028121!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd70fe463a62f27%3A0x8c3b706c93f0f33!2sUniversitas%20Nurul%20Jadid%20(UNUJA)!5e0!3m2!1sen!2sid!4v1731601650302!5m2!1sen!2sid" 
                        style="min-height: 450px; border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.4s">
                <div class="bg-white p-4 p-md-5 rounded shadow-sm h-100">
                    <h4 class="text-primary">Kirim Pesan Anda</h4>
                    <p class="mb-4">Formulir kontak saat ini tidak aktif. Dapatkan formulir kontak yang fungsional
                        dengan Ajax & PHP. <a class="text-primary fw-bold" href="https://htmlcodex.com/contact-form">Download
                            Now</a>.</p>
                    <form>
                        <div class="row g-3">
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control bg-light border-0" id="name" placeholder="Your Name">
                                    <label for="name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control bg-light border-0" id="email" placeholder="Your Email">
                                    <label for="email">Your Email</label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="phone" class="form-control bg-light border-0" id="phone" placeholder="Phone">
                                    <label for="phone">Your Phone</label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control bg-light border-0" id="project" placeholder="Project">
                                    <label for="project">Your Project</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control bg-light border-0" id="subject" placeholder="Subject">
                                    <label for="subject">Subject</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control bg-light border-0" placeholder="Leave a message here" id="message" style="height: 120px"></textarea>
                                    <label for="message">Message</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-12">
                <div>
                    <div class="row g-4">
                        <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="contact-add-item">
                                <div class="contact-icon text-primary mb-4">
                                    <i class="fas fa-map-marker-alt fa-2x"></i>
                                </div>
                                <div>
                                    <h4>Alamat</h4>
                                    <p class="mb-0">Karanganyar, Paiton, Probolinggo, Jawa Timur 67291</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.4s">
                            <div class="contact-add-item">
                                <div class="contact-icon text-primary mb-4">
                                    <i class="fas fa-envelope fa-2x"></i>
                                </div>
                                <div>
                                    <h4>Mail Us</h4>
                                    <p class="mb-0">info@example.com</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.6s">
                            <div class="contact-add-item">
                                <div class="contact-icon text-primary mb-4">
                                    <i class="fa fa-phone-alt fa-2x"></i>
                                </div>
                                <div>
                                    <h4>Telephone</h4>
                                    <p class="mb-0">(+012) 3456 7890</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.8s">
                            <div class="contact-add-item">
                                <div class="contact-icon text-primary mb-4">
                                    <i class="fab fa-firefox-browser fa-2x"></i>
                                </div>
                                <div>
                                    <h4>Website</h4>
                                    <p class="mb-0">yoursite.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            </div>
    </div>
</div>
@endsection
