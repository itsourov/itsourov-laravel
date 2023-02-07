<aside
    class=" p-3 lg:p-5 mb-5 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 text-gray-900 dark:text-gray-100">

    <h3 class="text-lg font-bold pb-5 ">Popular posts</h3>
    <ul>

        @foreach ($popularPosts as $post)
            <li v-for="post in popularPosts"
                class="rounded bg-gray-50 dark:bg-gray-700 text-primary-900 dark:text-gray-100  shadow mb-5 p-2 border-l-4 border-primary-500">
                <a href="{{ route('posts.details', $post->slug) }}">{{ $post->title }}</a>
            </li>
        @endforeach
    </ul>
</aside>
