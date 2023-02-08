<x-app-layout>
    <section class="text-gray-700 dark:text-gray-200 px-2">


        <div
            class="container mt-10 py-5 mx-auto gap-5 px-2 md:px-6  bg-white border border-gray-200 rounded-lg overflow-hidden shadow-md dark:bg-gray-800 dark:border-gray-700">
            <h2 class="text-center font-bold text-2xl underline">{{ __('Contact') }}</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-5 ">


                <div>
                    <div class="my-4 space-x-2 md:text-start text-center">
                        <button type="button" class="bg-white text-gray-700  p-2 rounded-full shadow ">
                            <x-ri-facebook-fill />
                        </button>
                        <button type="button" class="bg-white text-gray-700  p-2 rounded-full shadow ">
                            <x-ri-github-line />
                        </button>
                        <button type="button" class="bg-white text-gray-700  p-2 rounded-full shadow ">
                            <x-ri-youtube-line />
                        </button>

                    </div>


                    <div class="font-bold">
                        Phone: + 8801872934185
                    </div>
                    <div class="font-bold">
                        Email: sourovbuzz@gmail.com
                    </div>
                    <div class="font-bold">
                        Adress: Magura, Khulna, Bangladesh
                    </div>


                </div>

                <livewire:page.contact-form />

            </div>

        </div>
    </section>
</x-app-layout>
