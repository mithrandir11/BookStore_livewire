<div>
    <section class="bg-white py-4 antialiased  md:py-16">
        <div class="mx-auto max-w-screen-xl ">

            {{-- <PurchaseSteps/> --}}
            
            <h2 class="lg:text-xl font-semibold text-gray-900  ">سبد خرید شما</h2>

            @if ($books->count() > 0)
                <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8 mb-48">
                    <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                        <div  class=" divide-y ">

                            @foreach ($books as $book)
                            <div class="py-3">
                                <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                    <a class="shrink-0 md:order-1">
                                        <img class="h-auto w-28 border rounded-lg " src="{{$book->image}}" alt="imac image" />
                                    </a>

                                    <label for="counter-input" class="sr-only">Choose quantity:</label>
                                    <div class="flex items-center justify-between md:order-3 md:justify-end">

                                        <livewire:components.purchase.add-to-cart :book_id="$book->id" wire:key="cart-{{ $book->id }}"/>
                                       
                                        <div class="text-end md:order-4 md:w-32">
                                            <p class=" font-bold text-gray-900 ">{{ $book->price }} تومان </p>
                                        </div>
                                    </div>

                                    <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                                        <NuxtLink  class="text-sm lg:text-base font-medium text-gray-900 hover:underline ">{{ $book->title }}</NuxtLink>

                                        <div class="flex items-center gap-x-8">
                                        <button type="button" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-900 hover:underline ">
                                            <svg class="me-1.5 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                                            </svg>
                                            افزودن به علاقه مندی ها
                                        </button>

                                        <button @click="removeFromCart(product)" type="button" class="inline-flex items-center text-sm font-medium text-red-600 hover:underline ">
                                            <svg class="me-1.5 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                            </svg>
                                            حذف
                                        </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            


                            <!-- <div v-else>
                                <p class="border rounded-lg p-6 w-full text-lg text-center">سبد خرید شما خالی میباشد!</p>
                            </div> -->

                            

                        </div>

                    
                    </div>


                    <div  class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                        <div class="space-y-4 rounded-lg border  bg-white p-4 shadow-sm  sm:p-6">
                            <p class="lg:text-xl font-semibold text-gray-900 text-center">خلاصه سفارش</p>

                            <div class="space-y-4">
                                <div class="space-y-2">
                                    <dl class="flex items-center justify-between gap-4">
                                        <dt class="text-base font-normal text-gray-500 ">قیمت اصلی</dt>
                                        <dd class="text-base font-medium text-gray-900 ">{{ number_format($totalPrice) }} تومان</dd>
                                    </dl>

                                    {{-- <dl v-if="discountPrice" class="flex items-center justify-between gap-4">
                                        <dt class="text-base font-normal text-gray-500 ">تخفیف</dt>
                                       
                                    </dl> --}}

                                    <dl class="flex items-center justify-between gap-4">
                                        <dt class="text-base font-normal text-gray-500 ">هزینه ارسال</dt>
                                        <dd class="text-base font-medium text-gray-900 ">رایگان</dd>
                                    </dl>

                                </div>

                                <dl class="flex items-center justify-between gap-4 border-t  pt-2 ">
                                <dt class="text-base font-bold text-gray-900 ">مبلغ قابل پرداخت</dt>
                                <dd class="text-base font-bold text-gray-900 ">{{ number_format($totalPrice) }} تومان</dd>
                                </dl>
                            </div>

                            <div class="space-y-4 pt-10 justify-self-start w-full">
                                {{-- <div class="space-y-4">
                                    <div class="flex gap-x-2 justify-center items-center  py-3 ">
                                    <div @click="gateway = 'pay'" :class="[gateway == 'pay' ? 'border-primary-600' : '']" class="border rounded-lg cursor-pointer">
                                            <img class="w-20 h-20 p-1" src="/images/payment_logo_pay2.png" alt="">
                                    </div>
                        
                                    <div @click="gateway = 'idpay'" :class="[gateway == 'idpay' ? 'border-primary-600' : '']" class="border rounded-lg cursor-pointer">
                                            <img class="w-20 h-20 p-1" src="/images/payment_logo_idpay.png" alt="">
                                    </div>
                                    </div>
                                </div> --}}

                            {{-- {{$selectedGateway}} --}}
                                <div class="space-y-4">
                                    <div class="flex gap-x-4 items-center py-3  ">
                                        @foreach (['pay', 'idpay', 'zarinpal'] as $gateway)
                                        <div 
                                        wire:click="selectGateway('{{ $gateway }}')" 
                                        class="border rounded-lg cursor-pointer p-1 transition duration-200 grow"
                                        :class="$wire.selectedGateway === '{{ $gateway }}' ? 'border-primary-600' : 'border-gray-300'"
                                    >
                                        <img 
                                            src="/images/payment_logo_{{ $gateway }}.png" 
                                            alt="{{ Str::headline($gateway) }} Logo" 
                                            class="w-20 h-20 object-contain"
                                        >
                                    </div>
                                        @endforeach
                                    </div>
                                </div>
                        
                                @auth
                                <button wire:click="handlePurchaseProcessing"  type="button" class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none ">
                                    <div wire:loading wire:target="handlePurchaseProcessing" class="ml-3">
                                        <x-utils.loading />
                                    </div>
                                    پرداخت و ثبت سفارش
                                </button>
                                @else
                                <div class="text-sm mt-6 text-center">برای ثبت سفارش ابتدا <a href="{{route('login')}}" class="text-primary-600 mx-1 underline">وارد</a> حساب خود شوید !</div>
                                @endauth
                                
                            </div>

                        
                            {{-- <a href="{{route('purchase.payment')}}" wire:navigate  class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none ">مرحله بعدی</a> --}}
                        </div>
                        {{-- <PurchaseDiscountForm/> --}}
                    </div>



                </div>
            @else
                <div class="max-w-md mx-auto text-center mb-72">
                    <p class="mt-8 border rounded-lg p-6 w-full text-lg text-center">سبد خرید شما خالی میباشد!</p>
                    <a href="{{route('books')}}" wire:navigate class="mt-6 inline-flex items-center gap-2 text-sm font-medium   ">
                        مشاهده محصولات
                        <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                        </svg>
                    </a>
                </div>
            @endif
            

           



        </div>
    </section>
</div>
