<div class="grid justify-center ">
    <div class="relative w-40 h-48 lg:w-56 lg:h-72  mx-auto ">
        <img src="{{asset('images/book4.webp')}}" class="w-full h-full object-contain" alt="Background Image">
        <a href="{{route('ShowBook', [$book->id, $book->slug] )}}" wire:navigate class="absolute inset-0 m-auto w-full h-auto px-8 py-5  mr-2">
            <img src="{{$book->image}}" class=" object-cover rounded" alt="Centered Image">
        </a>
    </div>

    <div class="text-center  px-3 ">
        <a href="{{route('ShowBook', [$book->id, $book->slug] )}}" wire:navigate class="line-show-1 mt-1 text-xs lg:text-base text-primary-950 font-bold ">{{ $book->title }}</a>
        <p class="text-primary-700 font-bold  text-sm lg:text-base">{{ $book->price }} تومان</p>
    </div>
</div>