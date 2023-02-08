{{-- {{ dd($posts->toArray()) }} --}}
<x-app-layout>

    <div class="container my-10  mx-auto gap-5 px-2  ">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 ">
            <div class=" md:col-span-2">

                <x-posts.post-grid classes="grid grid-cols-1 sm:grid-cols-2 gap-4" :posts="$posts" />
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
