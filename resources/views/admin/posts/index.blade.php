<x-admin-layout>
    <div class="px-2">


        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Posts
        </h2>




        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="p-4">
                            <div class="flex items-center">
                                <input id="checkbox-all-search" type="checkbox"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-all-search" class="sr-only">checkbox</label>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            POSTS
                        </th>
                        <th scope="col" class="px-6 py-3">
                            COMMENTS
                        </th>
                        <th scope="col" class="px-6 py-3">
                            ACTION
                        </th>
                        <th scope="col" class="px-6 py-3">
                            DATE
                        </th>

                    </tr>
                </thead>
                <tbody>

                    @foreach ($posts as $post)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="w-4 p-4">
                                <div class="flex items-center">
                                    <input id="checkbox-table-search-1" type="checkbox"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                </div>
                            </td>
                            <th scope="row" class="flex px-6 py-4 font-medium text-gray-900  dark:text-white">


                                <div class="flex items-center text-sm">
                                    <!-- Avatar with inset shadow -->
                                    <div class="relative  w-10 h-10 mr-3 rounded" style="min-width: 32px">
                                        {{-- <img class="object-cover w-full h-full rounded" src="{{ $post->image->image_url }}"
                                        alt="" loading="lazy" /> --}}
                                        {{ $post->getMedia('thumbnails')->last() }}
                                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true">
                                        </div>
                                    </div>
                                    <div style="min-width: 250px">
                                        <p class="font-semibold">{{ $post->title }}</p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">
                                            10x ok
                                        </p>
                                    </div>
                                </div>
                            </th>
                            <td class="px-6 py-4">
                                {{ $post->comments_count }}
                            </td>
                            <td class="flex items-center px-6 py-4 space-x-3">
                                @if ($post->trashed())
                                    (Deleted)
                                @else
                                    <a href="{{ route('admin.posts.edit', $post) }}"
                                        class="inline mx-1 px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                        Edit
                                    </a>
                                    <a href="{{ route('posts.details', $post) }}"
                                        class="inline mx-1 px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                        View
                                    </a>
                                    <form action="{{ route('admin.posts.delete', $post) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit"
                                            class=" inline mx-1 px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                            Delete
                                        </button>
                                    </form>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                {{ $post->created_at->format('d/m/y') }}
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="my-5">
            {{ $posts->appends(Request::all())->onEachSide(1)->links('pagination.tailwind') }}
        </div>
    </div>

</x-admin-layout>
