<div>
    <section>
        <form @submit.prevent="handleCreateComment" class="mb-6">
            <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200  ">
                <label for="comment" class="sr-only">Your comment</label>
                <textarea v-model="form.body" id="comment" rows="6"
                    class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none   "
                    placeholder="نوشتن نظر..." ></textarea>
            </div>

            <button type="submit" class="flex  items-center justify-center text-white bg-primary-600 hover:bg-primary-700 duration-200 rounded-lg text-sm px-5 py-2 text-center  ">
                <UtilsLoding v-if="isLoading" class="ml-3"/>
                ارسال نظر
            </button>
        </form>

        @foreach ($comments as $comment)
        <article class="py-6 text-base bg-white rounded-lg ">
            <div class="flex justify-between items-center mb-2">
                <div class="flex items-center">
                    <p class="inline-flex items-center ml-3 text-sm text-gray-900  font-semibold"><img
                            class="ml-2 w-6 h-6 rounded-full"
                            src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
                            alt="Michael Gough">{{ $comment->user->name }}</p>
                    <p class="text-sm text-gray-600 ">
                        <time pubdate datetime="2022-02-08" title="February 8th, 2022">{{ $comment->created_at }}</time>
                    </p>
                </div>
                <button id="dropdownComment1Button" data-dropdown-toggle="dropdownComment1"
                    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500  bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50   "
                    type="button">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                        <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                    </svg>
                    <span class="sr-only">Comment settings</span>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdownComment1"
                    class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow  ">
                    <ul class="py-1 text-sm text-gray-700 "
                        aria-labelledby="dropdownMenuIconHorizontalButton">
                        <li>
                            <a href="#"
                                class="block py-2 px-4 hover:bg-gray-100 ">Edit</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block py-2 px-4 hover:bg-gray-100 ">Remove</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block py-2 px-4 hover:bg-gray-100 ">Report</a>
                        </li>
                    </ul>
                </div>
            </div>
            <p class="text-gray-500 ">{{ $comment->body }}</p>
            
        </article>
        @endforeach
       
    </section>
</div>
