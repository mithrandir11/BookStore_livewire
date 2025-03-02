<div class="grid grid-cols-5 gap-x-1 my-6 lg:my-16 ">

    <div class="hidden lg:block col-auto  space-y-5">
        <livewire:components.book.filter-publisher/>
        <livewire:components.book.filter-author/>
    </div>

    <div x-data="{ showFilter: false }" class="lg:hidden col-span-full mb-5  space-y-5">

        <button @click="showFilter = !showFilter" type="button" class="flex items-center justify-center border bg-gray-100 rounded-lg px-3 py-1 text-sm">
            <svg class="h-4 w-4 ml-2 fill-gray-600 opacity-70" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.9 54.9C10.5 40.9 24.5 32 40 32l432 0c15.5 0 29.5 8.9 36.1 22.9s4.6 30.5-5.2 42.5L320 320.9 320 448c0 12.1-6.8 23.2-17.7 28.6s-23.8 4.3-33.5-3l-64-48c-8.1-6-12.8-15.5-12.8-25.6l0-79.1L9 97.3C-.7 85.4-2.8 68.8 3.9 54.9z"/></svg>
            فیلتر نتایج
        </button>

        <div x-show="showFilter" x-cloak x-transition>
            <livewire:components.book.filter-publisher/>
            <livewire:components.book.filter-author/>
        </div>
    </div>

    <div  class="col-span-5 lg:col-span-4 ">

        <div class="lg:pb-4 flex justify-end items-center gap-x-6  mb-1 ">
            <span class="hidden lg:block text-gray-700 font-bold ">مرتب سازی بر اساس :</span>
            <div class="flex self-start mx-auto lg:mx-0 gap-x-2  w-full lg:w-auto">
                <button wire:click="setSortBy('latest')"          class="@if($sort_by === 'latest') border-primary-700 border @endif         btn-custom-2 text-sm grow">جدید ترین</button>
                <button wire:click="setSortBy('best_seller')"     class="@if($sort_by === 'best_seller') border-primary-700 border @endif    btn-custom-2 text-sm grow">پرفروش ترین</button>
                <button wire:click="setSortBy('cheapest')"        class="@if($sort_by === 'cheapest') border-primary-700 border @endif       btn-custom-2 text-sm grow">ارزان ترین</button>
                <button wire:click="setSortBy('most_expensive')"  class="@if($sort_by === 'most_expensive') border-primary-700 border @endif btn-custom-2 text-sm grow">گران ترین</button>
            </div>
        </div>

        <div class=" grid grid-cols-2  md:grid-cols-3 lg:grid-cols-4  justify-center gap-3 lg:gap-4 mt-6 ">
            @foreach ($books as $book)
                <x-book.cover :book="$book"/>
            @endforeach
        </div>



        <div class="flex  justify-center items-center gap-x-1 lg:gap-x-2 mt-10 lg:mt-16 ">
            {{ $books->links() }}
        </div>

    </div>
   
</div>
