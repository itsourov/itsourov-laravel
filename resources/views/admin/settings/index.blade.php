<x-admin-layout>
    <div class="px-2 sm:px-5">


        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Categories

        </h2>
        <div class=" grid grid-cols-1 lg:grid-cols-5 gap-3 mt-5">
            <div class="lg:col-span-2">
                <div
                    class=" p-3 lg:p-5 mb-5 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 text-gray-900 dark:text-gray-100">

                    <ul class="text-sm grid gap-2" id="settingsSelectTab" data-tabs-toggle="#settingsContent"
                        role="tablist">

                        <x-admin.setting-tab-item target="generalSettings">{{ __('General') }}
                        </x-admin.setting-tab-item>
                        <x-admin.setting-tab-item target="logoSettings"
                            active="{{ request()->get('tab') == 'logoSettings' }}">{{ __('Logo') }}
                        </x-admin.setting-tab-item>



                    </ul>

                </div>

            </div>
            <div class="lg:col-span-3">
                <div id="settingsContent"
                    class=" p-3 lg:p-5 mb-5 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 text-gray-900 dark:text-gray-100">

                    @include('admin.settings.general')
                    @include('admin.settings.logo')


                </div>
            </div>
        </div>
    </div>

    <script>
        var settingsSelectTab = document.getElementById('settingsSelectTab')
        var tabButtons = settingsSelectTab.getElementsByTagName('button')



        for (let item of tabButtons) {
            item.addEventListener('click', event => {


                var refresh = window.location.protocol + "//" + window.location.host + window.location.pathname +
                    '?tab=' + event.target.getAttribute('data-tabs-target').replace('#', '');
                window.history.pushState({
                    path: refresh
                }, '', refresh);
            });
        }
    </script>
</x-admin-layout>
