<div>
    <div class="border-b-2 border-dashed border-primary-800 border-opacity-30 py-4 flex justify-between col-span-full">
        <span class="text-primary-950  font-bold lg:text-xl">برترین کتاب های تاریخی</span>
        <a class="flex items-center gap-x-1 text-primary-950  lg:text-xl">
            مشاهده همه
            <svg class="h-4 w-4 fill-primary-950" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/></svg>
        </a>
    </div>

    <div class="my-8 py-6 w-full flex max-w-full overflow-x-auto hidden-scroll lg:grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 justify-center gap-3 lg:gap-4  rounded-2xl">
        @foreach ($books as $book)
            <x-book.cover  :key="$book->id" :book="$book"/> 
        @endforeach
    </div>
</div>