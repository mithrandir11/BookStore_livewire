<div>
    <form wire:submit="searchBooks"  class="w-full mx-auto">   
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only ">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input wire:model.live.debounce.500ms='query' type="text" id="default-search" class="block w-full py-2 lg:py-2.5 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg outline-none focus:border-primary-600 " placeholder="نام کتاب ، نویسنده ، مترجم ..."  />
            <button type="submit" class="absolute end-1.5 bottom-1.5 flex items-center justify-center  bg-gray-200 hover:bg-gray-300 duration-200 rounded-lg text-sm px-5 py-1 text-center ">
                <UtilsLoding v-if="isLoading" class="ml-3"/>
                جستجو
            </button>


            @if (count($books) > 0)
            <div class="absolute bg-white h-auto w-full  border border-t-0 mt-1 z-10  divide-y divide-dashed px-3 rounded-b-lg">
                @foreach ($books as $book)
                <div class="flex items-center gap-x-3 py-2 ">
                    <img class="border rounded h-16" src="{{$book->image}}" alt="">
                    <div>
                        <a href="{{route('ShowBook', [$book->id, $book->slug] )}}" wire:navigate class="text-sm text-gray-800 font-bold">{{ $book->title }}</a>
                        <p class="text-xs text-gray-600">{{ $book->author->name }}</p>
                    </div>
                </div>
                @endforeach
            </div> 
            
            @elseif(strlen($query) >= 3)
            <div class="absolute bg-white h-auto w-full  border border-t-0 mt-1 z-10  divide-y divide-dashed px-3 rounded-b-lg">
                <div class="flex items-center gap-x-3 py-2 ">
                    <p class="text-sm text-gray-600">موردی یافت نشد !</p>
                </div>
            </div> 
            @endif
            

        </div>
    </form>
</div>
