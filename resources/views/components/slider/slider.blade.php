
@assets
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
@endassets

<div class="swiper mt-12">
    <div class="swiper-wrapper ">
        <div class="swiper-slide">
            <img class="rounded-2xl" src="{{ asset('images/slider3.webp') }}" alt="">
        </div>
        <div class="swiper-slide">
            <img class="rounded-2xl" src="{{ asset('images/slider2.webp') }}" alt="">
        </div>
    </div>

    <!-- Pagination -->
    <div class="swiper-pagination"></div>

    <!-- Navigation -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>


<script>
    var swiper = new Swiper('.swiper', {
        slidesPerView: 1,
        spaceBetween: 50,
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        effect: 'creative',
        creativeEffect: {
            prev: {
                shadow: true,
                translate: [0, 0, -400],
            },
            next: {
                translate: ['100%', 0, 0],
            },
        },
        pagination:false,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>