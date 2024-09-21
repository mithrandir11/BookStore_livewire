
@assets
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
@endassets

<div class="swiper ">
    <div class="swiper-wrapper ">
        @foreach ($books as $book)
        <div class="swiper-slide">
            <a href="{{route('ShowBook', [$book->id, $book->slug] )}}" wire:navigate><img class="w-28 lg:w-auto border rounded-lg" src="{{$book->image}}" alt=""></a>
        </div>
        @endforeach
    </div>

    <div class="swiper-pagination"></div>

    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>

<script>
    var swiper = new Swiper('.swiper', {
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination:false,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        breakpoints:{
            '0': {
            slidesPerView: 3,
            spaceBetween: 0,
            },
            '640': {
            slidesPerView: 5,
            // spaceBetween: 20,
            },
            '768': {
            slidesPerView: 7,
            // spaceBetween: 40,
            },
            '1024': {
            slidesPerView: 9,
            // spaceBetween: 50,
            },
        }
        
    });
</script>