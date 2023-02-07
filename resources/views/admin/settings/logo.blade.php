<div class="hidden rounded-lg bg-gray-50 dark:bg-gray-800" id="logoSettings" role="tabpanel"
    aria-labelledby="dashboard-tab">
    <form action="{{ route('admin.settings.site_settings.logo') }}" method="post" class="space-y-6"
        enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div>
            <x-input-label for="navLogoInput" :value="__('Main logo')" />
            <input type="file" id="navLogoInput" accept="image/png" name="nav_logo">
            <x-input-error class="mt-2" :messages="$errors->get('nav_logo')" />
        </div>
        <div>
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" name="showLogoText" class="sr-only peer" value="1"
                    {{ $siteSettings->showLogoText ? 'checked' : '' }}>
                <div
                    class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                </div>
                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Show
                    Logo Text</span>

            </label>
            <x-input-error class="mt-2" :messages="$errors->get('showLogoText')" />
        </div>





        <x-primary-button>{{ __('Submit') }}</x-primary-button>
    </form>
</div>

<script type="module">
    // Get a reference to the file input element
    const inputElement = document.querySelector('input[id="navLogoInput"]');
    // Create a FilePond instance
    const pond = FilePond.create(inputElement, {
        // Only accept images
        acceptedFileTypes: ['image/png'],

    });
    FilePond.setOptions({
        storeAsFile: true,
        allowImagePreview:false,
    });
</script>
