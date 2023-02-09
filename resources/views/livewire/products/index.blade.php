<div>
    <div class="container my-10  mx-auto  px-2 " x-data="{ shopFilterMenuOpen: false }">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 ">
            <div class="fixed  hidden lg:block lg:flex-none lg:relative top-0 left-0 h-full overflow-y-scroll z-40"
                id="shopFilterMenu">


                <div class=" w-screen max-w-xs lg:max-w-screen-md lg:w-full">
                    <div
                        class=" h-full min-h-screen lg:h-auto lg:min-h-full card  p-3 bg-white border border-gray-200 rounded shadow dark:bg-gray-800 dark:border-gray-700 text-gray-800 dark:text-gray-100">
                        <div class="flex">
                            <p class="font-bold flex-grow">Filters</p>

                            <button type="button" x-on:click="shopFilterMenuToggle()"
                                class="-m-2 p-2 text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 lg:hidden">
                                <span class="sr-only">Close panel</span>
                                <!-- Heroicon name: outline/x-mark -->
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <hr class="h-px my-3 bg-gray-200 border-0 dark:bg-gray-700">



                        <div>
                            <div class="rounded p-2.5 dark:bg-gray-900 bg-gray-50">
                                {{ __('Categories') }}
                            </div>


                            <ul class="px-2 ">
                                @foreach ($categories as $category)
                                    <div class="flex gap-3 my-2 items-center">
                                        <input wire:model="cat_id" id="cat-{{ $category->id }}" type="checkbox"
                                            value="{{ $category->id }}"
                                            class="flex-none w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="cat-{{ $category->id }}"
                                            class="flex-grow cursor-pointer ">{{ $category->title }}</label>
                                        <p class="flex-none">({{ $category->products_count }})</p>
                                    </div>
                                @endforeach
                            </ul>

                            Cat id: {{ var_export($cat_id) }}
                        </div>

                    </div>

                </div>
            </div>
            <div class=" lg:col-span-3 ">
                <div
                    class="flex items-center card w-full  p-2  bg-white border border-gray-200 rounded shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex-grow">
                        <button x-on:click="shopFilterMenuToggle()"
                            class="lg:hidden  items-center gap-2 bg-gray-200 rounded px-5 py-1">
                            <x-ri-filter-3-line class="inline" />
                            Filter
                        </button>
                    </div>



                    <div class="justify-self-end">
                        <select id="countries"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Default sorting</option>
                            <option value="US">Price low-high</option>
                            <option value="CA">Price high-low</option>
                            <option value="FR">Latest</option>
                            <option value="DE">Olderst</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 my-6">
                    @foreach ($products as $product)
                        <div
                            class="flex flex-col justify-between bg-white border border-gray-200 rounded-lg overflow-hidden shadow-md dark:bg-gray-800 dark:border-gray-700">
                            <div>


                                <a href="{{ route('products.details', $product->slug) }}">
                                    <div class=" aspect-w-16 aspect-h-9 ">

                                        {{ $product->getMedia('productImages')->last() }}
                                    </div>

                                </a>
                                <div class="p-2 ">
                                    <a href="{{ route('products.details', $product->slug) }}">
                                        <h5 class="line-clamp-2 text-xl  font-bold  text-gray-900 dark:text-white">
                                            {{ $product->title }}</h5>
                                    </a>



                                </div>
                            </div>
                            <div class="p-2">
                                <div class="flex items-center">
                                    <svg aria-hidden="true" class="w-5 h-5 text-yellow-300" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <title>First star</title>
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg aria-hidden="true" class="w-5 h-5 text-yellow-300" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <title>Second star</title>
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg aria-hidden="true" class="w-5 h-5 text-yellow-300" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <title>Third star</title>
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg aria-hidden="true" class="w-5 h-5 text-yellow-300" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <title>Fourth star</title>
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg aria-hidden="true" class="w-5 h-5 text-yellow-300" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <title>Fifth star</title>
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <span
                                        class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ml-3">5.0</span>
                                </div>
                                <div class="mt-3 flex items-center justify-between">
                                    <span
                                        class=" text-sm text-gray-700 dark:text-gray-300 "><del>${{ $product->regular_price }}</del>
                                        <span
                                            class=" text-base text-gray-900 dark:text-white">${{ $product->selling_price }}</span></span>


                                    <button type="button"
                                        class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-3 py-2 text-center">Add
                                        to cart</button>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

                <div class="my-5  text-center">
                    {{-- {{ $products->links('pagination.tailwind') }} --}}
                    <x-primary-button wire:click="loadMore">
                        <span wire:loading.remove>
                            Load More
                        </span>
                        <span wire:loading>
                            <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="#E5E7EB" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentColor" />
                            </svg>
                            Loading...
                        </span>

                    </x-primary-button>
                </div>

            </div>

        </div>

    </div>

    <script>
        const shopFilterMenu = document.getElementById("shopFilterMenu");



        function shopFilterMenuToggle() {

            shopFilterMenu.classList.toggle("hidden");

        }
    </script>
</div>
