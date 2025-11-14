$(function () {

    // Header Scroll
    $(window).scroll(function () {
        if ($(window).scrollTop() >= 60) {
            $("header").addClass("fixed-header");
        } else {
            $("header").removeClass("fixed-header");
        }
    });


    // Featured Owl Carousel
 // Featured Owl Carousel
$('.featured-projects-slider .owl-carousel').owlCarousel({
    center: false,             // mulai dari kiri
    loop: false,               // tidak loop
    margin: 24,                // aman (lebih ideal dari 30)
    stagePadding: 0,           // 0 agar tidak ada bug space kanan
    nav: false,
    dots: false,

    autoplay: true,
    autoplayTimeout: 5000,
    autoplayHoverPause: false,

    responsive: {
        0: {
            items: 1,
            margin: 16,
            stagePadding: 0
        },
        600: {
            items: 2,
            margin: 20,
            stagePadding: 0
        },
        1000: {
            items: 3,
            margin: 24,
            stagePadding: 0
        },
        1200: {
            items: 4,
            margin: 24,
            stagePadding: 0
        }
    }
});



    // Count
    $('.count').each(function () {
        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {
            duration: 1000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });


    // ScrollToTop
    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    const btn = document.getElementById("scrollToTopBtn");
    btn.addEventListener("click", scrollToTop);

    window.onscroll = function () {
        const btn = document.getElementById("scrollToTopBtn");
        if (document.documentElement.scrollTop > 100 || document.body.scrollTop > 100) {
            btn.style.display = "flex";
        } else {
            btn.style.display = "none";
        }
    };


    // Aos
    AOS.init({
        once: true,
    });

});

