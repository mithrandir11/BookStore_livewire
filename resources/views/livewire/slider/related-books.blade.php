<div class="swiper ">
    <div class="swiper-wrapper ">
        @foreach ($this->books as $book)
        <div class="swiper-slide">
            <a href="{{route('ShowBook', [$book->id, $book->slug] )}}" @click.prevent="Livewire.navigate('{{route('ShowBook', [$book->id, $book->slug] )}}')"><img class="w-28 lg:w-auto border rounded-lg" src="{{$book->image}}" alt="{{$book->image}}"></a>
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
            },
            '768': {
            slidesPerView: 7,
            },
            '1024': {
            slidesPerView: 9,
            },
        }
        
    });
</script>