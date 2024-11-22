<div>
    <section class="container mx-auto  ">
        <div class="text-left">
            <a href="{{route('home')}}" wire:navigate class="inline-flex items-center gap-x-1 btn-custom ">
                بازگشت
                <svg class="h-3 w-3 fill-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/></svg>
            </a>
        </div>
    
        <div class="flex flex-wrap  items-center justify-center gap-x-14 lg:px-6 lg:py-12 mx-auto  ">
            <div class="w-full  self-end  sm:max-w-md p-3  ">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl text-center">
                        ساخت حساب کاربری
                    </h1>

                    <form wire:submit="register" class="space-y-4 md:space-y-6" >
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">نام</label>
                            <input type="text" wire:model="name" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" >
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">ایمیل</label>
                            <input type="email" wire:model="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="name@company.com" >
                            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">رمز عبور</label>
                            <input type="password" wire:model="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5    " >
                            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 ">تکرار رمز عبور</label>
                            <input type="password" wire:model="password_confirmation" name="password_confirmation" id="password_confirmation" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5    " >
                            @error('password_confirmation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="flex gap-x-2 w-full items-center justify-center text-white bg-primary-600 hover:bg-primary-700 duration-200 rounded-lg text-sm px-5 py-2.5 text-center  ">
                            <div wire:loading>
                                <x-utils.loading />
                            </div>
                            ساخت حساب
                        </button>
                        <p class="text-sm font-light text-gray-500 ">
                            از قبل حساب کاربری دارید؟ <a href="{{route('login')}}" wire:navigate class="font-medium text-primary-600 hover:underline ">وارد</a> شوید
                        </p>
                    </form>
                    
                </div>
            </div>
            <div>
                <img class="h-44 lg:h-auto" src="{{custom_asset('images/bg_book.jpg')}}" alt="">
            </div>
        </div>
    </section>
</div>
