@props(['shouldPaginate' => true, 'classes', 'posts'])
<div class="{{ $classes }}">

    @foreach ($posts as $post)
        <div
            class=" bg-white border border-gray-200 rounded-lg overflow-hidden shadow-md dark:bg-gray-800 dark:border-gray-700">
            <a href="{{ route('posts.details', $post->slug) }}">
                <div class=" aspect-w-16 aspect-h-9 ">

                    {{ $post->getMedia('thumbnails')->last() }}
                </div>

            </a>
            <div class="p-2 lg:p-5">
                <a href="{{ route('posts.details', $post->slug) }}">
                    <h5 class="line-clamp-2 mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                        {{ $post->title }}</h5>
                </a>
                <p class=" mb-3 font-normal text-gray-700 dark:text-gray-400 line-clamp-2">
                    {{ $post->excerpt }}</p>
                <div class="flex justify-between">
                    <a href="{{ route('posts.details', $post->slug) }}"
                        class="inline-flex items-center px-3 py-2 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm  dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                        Read more
                        <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                    <a href="{{ route('posts.details', $post->slug) }}#comment-section"
                        class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400">
                        <svg aria-hidden="true" class="mr-1 w-4 h-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                            </path>
                        </svg>
                        {{ $post->comments_count }}
                    </a>
                </div>

            </div>
        </div>
    @endforeach
</div>
@if ($shouldPaginate)
    <div class="my-5">
        {{ $posts->appends(Request::all())->onEachSide(1)->links('pagination.tailwind') }}
    </div>
@endif
