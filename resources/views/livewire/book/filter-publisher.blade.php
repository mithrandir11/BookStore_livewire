<div class=" rounded-lg p-6 self-start bg-primary-900 bg-opacity-20 ">
    <div class="w-full space-y-8">
        <div class="flex items-center gap-x-2   text-primary-950 font-bold">
            <svg class="h-4 w-4  fill-primary-950" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M40 48C26.7 48 16 58.7 16 72l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24L40 48zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L192 64zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zM16 232l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24l-48 0c-13.3 0-24 10.7-24 24zM40 368c-13.3 0-24 10.7-24 24l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24l-48 0z"/></svg>
            انتشارات
            <div class="grow border-t border-dashed border-primary-800"></div>
            <button wire:click="$dispatch('publisher-change', { publisher_id: null })" type="button" class="text-primary-950 text-xs">حذف فیلتر</button>
        </div>

        <div class="space-y-2 mt-3 text-primary-950 h-64 overflow-y-auto">
            @foreach ($publishers as $publisher)
            <div class="flex items-center gap-x-2">
                <input wire:click="$dispatch('publisher-change', { publisher_id: {{ $publisher->id }} })" name="publisher" type="radio">
                <label class="text-sm">{{ $publisher->name }}</label>
            </div>
            @endforeach
        </div>
    </div>
</div>