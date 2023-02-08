{{-- {{ dd($post->toArray()) }} --}}
<x-app-layout pageTitle="{{ $post->title }}">

    <div class="container my-10  mx-auto gap-5 px-2  ">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 ">
            <div class=" md:col-span-2">

                {{-- resources/views/categories/show.blade.php --}}
                {{ Breadcrumbs::render('post', $post) }}
                @if (auth()->user() && auth()->user()->role == 'admin')
                    <div class="flex  justify-end my-5">


                        @if ($post->trashed())
                            (Deleted)
                        @else
                            <a href="{{ route('admin.posts.edit', $post) }}"
                                class="inline mx-1 px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                Edit
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
                    </div>
                @endif
                <div
                    class="p-3 lg:p-5 mb-5 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 text-gray-900 dark:text-gray-100">

                    <article
                        class="text-gray-900 dark:text-gray-100 mx-auto w-full max-w-full format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                        <header class="flex gap-3 not-format items-center mb-2">
                            <img class="w-6 h-6 rounded-full "
                                src="{{ $post->user->getMedia('profileImages')->last()? $post->user->getMedia('profileImages')->last()->getUrl('preview'): asset('images/user.png') }}" />
                            <a href="#"
                                class="text-base  text-gray-500 dark:text-gray-400">{{ $post->user->name }}</a>
                            <div>.</div>
                            <p class="text-base  text-gray-500 dark:text-gray-400"><time pubdate datetime="2022-02-08"
                                    title="February 8th, 2022">{{ $post->created_at->format('M d, Y') }}</time></p>
                        </header>
                        <h2 class="mb-4 font-bold leading-tight text-gray-900 lg:mb-6  dark:text-white">
                            {{ $post->title }}</h2>
                        <figure>

                            <a class="spotlight inline-block"
                                href="{{ $post->getMedia('thumbnails')->last()->getUrl() }}">
                                {{ $post->getMedia('thumbnails')->last() }}
                            </a>

                        </figure>

                        {!! $post->content !!}
                    </article>
                </div>
                <section class="not-format my-5 " id="comment-section">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Discussion</h2>
                    </div>
                    @auth
                        <form class="mb-6" method="POST" action="{{ route('posts.comments', $post->slug) }}">
                            @csrf
                            <div
                                class="py-2 px-4  bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                                <label for="comment" class="sr-only">Your comment</label>
                                <textarea id="comment" rows="6" name="comment"
                                    class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                                    placeholder="Write a comment..."></textarea>

                            </div>
                            @error('comment')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <button type="submit"
                                class="mt-4 inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                                Post comment
                            </button>
                        </form>
                    @else
                        <div
                            class="p-3 lg:p-5  mb-6 text-base  bg-white border border-blue-300 rounded-lg shadow-sm dark:bg-gray-800 dark:border-blue-800 text-gray-900 dark:text-gray-100">
                            <p class="text-center">Please log in to make comments</p>
                        </div>
                    @endauth




                    @foreach ($post->comments as $comment)
                        @if ($comment->trashed())
                            <x-posts.deleted-comment-item :comment='$comment' :post='$post' :isReply='false'
                                :parentId='$comment->id' />
                        @else
                            <x-posts.comment-item :comment='$comment' :post='$post' :isReply='false'
                                :parentId='$comment->id' />
                        @endif
                        @foreach ($comment->replies as $reply)
                            @if ($reply->trashed())
                                <x-posts.deleted-comment-item :comment='$reply' :post='$post' :isReply='true'
                                    :parentId='$comment->id' />
                            @else
                                <x-posts.comment-item :comment='$reply' :post='$post' :isReply='true'
                                    :parentId='$comment->id' />
                            @endif
                        @endforeach
                    @endforeach

                </section>
            </div>
            <div class=" relative">
                <div class="sticky top-0">
                    <x-posts.searchbox />
                    <x-posts.popular-posts />
                    <x-posts.category-list />
                </div>

            </div>
        </div>

    </div>


</x-app-layout>
