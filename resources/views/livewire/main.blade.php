{{-- @assets
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
@endassets --}}

<div class="space-y-12">
    <x-slider.slider/>
    <livewire:components.book.best-sellers lazy />
    <div class="relative w-full flex flex-wrap justify-between items-center py-4 lg:py-8 px-3 lg:px-16 rounded-2xl bg-primary-900 bg-opacity-20  ">
        <svg class="absolute inset-0 -z-10 h-full w-full stroke-primary-900 opacity-5 " fill="none"><defs><pattern id="pattern-5c1e4f0e-62d5-498b-8ff0-cf77bb448c8e" x="0" y="0" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M-3 13 15-5M-5 5l18-18M-1 21 17 3"></path></pattern></defs><rect stroke="none" fill="url(#pattern-5c1e4f0e-62d5-498b-8ff0-cf77bb448c8e)" width="100%" height="100%"></rect></svg>
        <p class="w-full text-lg lg:text-2xl font-bold text-primary-950 opacity-60">کتاب هایی که زندگی تان را دگرگون خواهند کرد ...</p>
        
        <a class="text-white  bg-primary-800 hover:bg-primary-700 duration-200 rounded-lg text-sm lg:text-xl px-5 py-2.5 text-center  ">
            مشاهده لیست کتاب ها
        </a>
        <video  autoplay muted loop playsinline>
            <source src="{{custom_asset('video/animation_book.webm')}}" type="video/webm" />
        </video>
    </div>
    <livewire:components.book.latest lazy />
    <div class="relative w-full flex flex-wrap justify-between items-center py-4 lg:py-8 px-3 lg:px-16 rounded-2xl bg-emerald-600 bg-opacity-20  ">
        <svg class="absolute inset-0 -z-10 h-full w-full stroke-emerald-700 opacity-5 " fill="none"><defs><pattern id="pattern-5c1e4f0e-62d5-498b-8ff0-cf77bb448c8e" x="0" y="0" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M-3 13 15-5M-5 5l18-18M-1 21 17 3"></path></pattern></defs><rect stroke="none" fill="url(#pattern-5c1e4f0e-62d5-498b-8ff0-cf77bb448c8e)" width="100%" height="100%"></rect></svg>
        <p class="w-full text-lg lg:text-2xl font-bold text-emerald-950 opacity-60">خواندن، انسان را کامل می‌سازد؛ گفت‌وگو، انسان را حاضر جواب؛ و نوشتن، انسان را دقیق</p>
        
        <a class="text-emerald-500 bg-white hover:bg-emerald-600 hover:text-white duration-200 rounded-lg text-sm lg:text-xl px-5 py-2.5 text-center  ">
            مشاهده لیست کتاب ها
        </a>
        <video  autoplay muted loop playsinline>
            <source src="{{custom_asset('video/animation_person.webm')}}" type="video/webm" />
        </video>
    </div>
    <livewire:components.book.best-historical lazy />
</div>