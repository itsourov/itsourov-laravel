<div class="hidden " id="generalSettings" role="tabpanel" aria-labelledby="profile-tab">

    <form action="{{ route('admin.settings.site_settings.general') }}" method="post" class="space-y-6">
        @method('PUT')
        @csrf





        <div>
            <x-input-label for="site_title" :value="__('Site title')" />
            <x-text-input id="site_title" placeholder="Title here" name="site_title" type="text"
                class="mt-1 block w-full" value="{{ old('site_title') ?? $siteSettings->site_title }}" />
            <x-input-error class="mt-2" :messages="$errors->get('site_title')" />
        </div>
        <div>
            <x-input-label for="site_tagline" :value="__('Site tagline')" />
            <x-text-input id="site_tagline" placeholder="Title here" name="site_tagline" type="text"
                class="mt-1 block w-full" value="{{ old('site_tagline') ?? $siteSettings->site_tagline }}" />
            <x-input-error class="mt-2" :messages="$errors->get('site_tagline')" />
        </div>
        <div>
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" name="site_active" class="sr-only peer" value="1"
                    {{ $siteSettings->site_active ? 'checked' : '' }}>
                <div
                    class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                </div>
                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Site
                    active</span>

            </label>
            <x-input-error class="mt-2" :messages="$errors->get('site_active')" />
        </div>




        <x-primary-button>{{ __('Submit') }}</x-primary-button>
    </form>
</div>
