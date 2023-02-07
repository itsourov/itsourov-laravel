<aside
    class=" p-3 lg:p-5 mb-5 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 text-gray-900 dark:text-gray-100">

    <h3 class="text-lg font-bold pb-5 ">Categories</h3>
    <ul>
        @foreach ($categories as $category)
            <a href="{{ route('categories.details', $category->slug) }}">

                <li>
                    <div
                        class="flex divide-x divide-gray-200 dark:divide-gray-600 rounded bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100  shadow mb-5 ">
                        <div class="flex-grow flex items-center">
                            <svg class="h-5 w-5 m-2 flex-none" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z"></path>
                            </svg>
                            <div class="py-2">{{ $category->title }}</div>
                        </div>
                        <div class="p-3 flex items-center">{{ $category->posts_count }}</div>
                    </div>
                </li>
            </a>
        @endforeach
    </ul>
</aside>
