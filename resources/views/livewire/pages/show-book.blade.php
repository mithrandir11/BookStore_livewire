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

            <livewire:components.purchase.add-to-cart :book_id="$book->id" />

            

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
        <livewire:slider.related-books  />
    </div>

    <div class="py-8">
        <h4 class="font-bold lg:text-xl mb-3">نظرات کاربران</h4>
        <livewire:components.comment :comments="$book->comments" :book_id="$book->id" lazy />
    </div>

</div>