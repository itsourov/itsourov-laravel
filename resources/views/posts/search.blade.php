<x-app pageTitle="Search Results">

    <div class="container my-10  mx-auto gap-5 px-2  ">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 ">
            <div class=" md:col-span-2">


                {{ Breadcrumbs::render('search', request('search') ?? '') }}
                <h2 class="text-gray-900 dark:text-gray-100 font-bold text-2xl my-8 "><span
                        class="text-primary-500">{{ request('search') }}</span> - search
                    results
                </h2>
                <x-posts.post-grid classes="grid grid-cols-1 sm:grid-cols-2 gap-4" :posts="$posts" />
            </div>
            <div class=" relative">
                <div class="sticky top-0">
                    @include('inc.sidebar.searchbox')

                    @include('inc.sidebar.popular-posts')

                    @include('inc.sidebar.category-list')
                </div>

            </div>
        </div>

    </div>


</x-app>
