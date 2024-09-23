<div class="divide-y ">
    <nav class="flex    py-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a class="inline-flex items-center text-xs lg:text-sm font-medium text-gray-700 hover:text-primary-600 ">
                    خانه
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <a href="{{route('books')}}" wire:navigate class="ms-1 text-xs lg:text-sm font-medium text-gray-700 hover:text-primary-600 md:ms-2 ">کتاب ها</a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <a href="{{route('showCategory', [$book->category->id, $book->category->slug])}}" wire:navigate class="ms-1 text-xs lg:text-sm font-medium text-gray-700 hover:text-primary-600 md:ms-2 ">{{  $book->category->title }}</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ms-1 text-xs lg:text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">{{ $book->title }}</span>
                </div>
            </li>
        </ol>
    </nav>
    
    <div class="flex  py-8">
        <img class="border rounded-lg w-40 lg:w-52 h-auto self-start" src="{{$book->image}}" alt="">
        <div class=" grow  grid  pr-5 mr-5 border-r">
            <h3 class="font-bold lg:text-2xl">ویژگی های محصول</h3>
        
            <div class="grid content-between text-xs lg:text-base  gap-y-1 mt-3">
                <p class="text-primary-950 font-bold">{{ $book->title }} </p>
                <div>
                    <span>نویسنده :</span>
                    <span class="mr-2"> {{ $book->author->name }} </span>
                </div>
                <div>
                    <span>مترجم :</span>
                    <span class="mr-2"> {{ $book->translator->name }} </span>
                </div>
                <div>
                    <span>انتشارات :</span>
                    <span class="mr-2"> {{ $book->publisher->name }} </span>
                </div>
                <div>
                    <span>سال انتشار :</span>
                    <span class="mr-2"> {{ $book->published_year }} </span>
                </div>
                <div>
                    <span>موضوع :</span>
                    <span class="mr-2"> {{ $book->category->title }} </span>
                </div>
                <div>
                    <span>تعداد صفحه :</span>
                    <span class="mr-2"> {{ $book->pages }} </span>
                </div>
                <div>
                    <span>شابک :</span>
                    <span class="mr-2"> {{ $book->isbn }} </span>
                </div>
                <div>
                    <span>قیمت :</span>
                    <span class="mr-2 text-emerald-500 font-bold tracking-widest ml-1"> {{ $book->price }} </span> تومان
                </div>   

            </div>

            <div class="self-end justify-self-start lg:justify-self-end mt-4 ">
                {{-- <div v-if="cartItem" class=" flex items-center gap-x-6 rounded-lg border   px-5 py-2.5  ">
                    <button @click="increaseProductInCart" type="button">
                        <svg class="w-6 h-6 fill-primary-700  rounded-md p-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z"/></svg>
                    </button>
                    <span>1</span>
                    <button @click="decreaseProductInCart" type="button">
                        <svg class="w-6 h-6 fill-primary-700  rounded-md p-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M432 256c0 17.7-14.3 32-32 32L48 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/></svg>
                    </button>
                </div> --}}

                <button v-else @click="addToCart" type="button" class="flex items-center gap-x-3 rounded-lg bg-primary-700 px-5 py-2.5 text-sm  text-white duration-200 hover:bg-primary-800 focus:outline-none">
                    افزودن به سبد
                    <svg class="w-5 h-5 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96zM252 160c0 11 9 20 20 20l44 0 0 44c0 11 9 20 20 20s20-9 20-20l0-44 44 0c11 0 20-9 20-20s-9-20-20-20l-44 0 0-44c0-11-9-20-20-20s-20 9-20 20l0 44-44 0c-11 0-20 9-20 20z"/></svg>
                </button>
            </div>
        </div>
    </div>

    <div class="py-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 text-sm lg:text-base gap-y-10 justify-around bg-primary-900 bg-opacity-10 rounded-lg py-8 ">
            <div class="text-center">
                <img class="mx-auto" src="{{custom_asset('images/product_icons/express-delivery.png')}}" alt="">
                <p class="mt-2">تحویل سریع و به‌موقع</p>
            </div>

            <div class="text-center">
                <img class="mx-auto" src="{{custom_asset('images/product_icons/protect.png')}}" alt="">
                <p class="mt-2">تضمین سلامت فیزیکی کتاب‌ها</p>
            </div>

            <div class="text-center">
                <img class="mx-auto" src="{{custom_asset('images/product_icons/check-box.png')}}" alt="">
                <p class="mt-2">تنوع بی‌نظیر در انتخاب کتاب‌ها</p>
            </div>

            <div class="text-center">
                <img class="mx-auto" src="{{custom_asset('images/product_icons/call.png')}}" alt="">
                <p class="mt-2">پشتیبانی 24/7</p>
            </div>
            
        </div>
    </div>

    <div class="py-8">
        <h4 class="font-bold lg:text-xl mb-3">معرفی کتاب {{ $book->title }}</h4>
        <p class="text-gray-500">{{ $book->description }}</p>
    </div>

    <div class="py-8">
        <h4 class="font-bold lg:text-xl mb-3">کتاب های مرتبط</h4>
        {{-- <x-slider.related-books :books="$book->relatedBooks()"/> --}}
        <livewire:slider.related-books/>
    </div>

    <div class="py-8">
        <h4 class="font-bold lg:text-xl mb-3">نظرات کاربران</h4>
        <livewire:components.comment :comments="$book->comments" :book_id="$book->id"/>
    </div>

</div>