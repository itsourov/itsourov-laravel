<div class="">
    <form wire:submit.prevent="submitForm" action="" method="post" class="space-y-5">
        <div>
            <x-input-label :value="__('Name')" />
            <x-text-input wire:model.lazy="name" type="text" class="mt-1 block w-full" autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label :value="__('Email')" />
            <x-text-input wire:model.lazy="email" type="email" class="mt-1 block w-full" autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>
        <div>
            <x-input-label :value="__('Message')" />
            <x-text-area wire:model.lazy="message" rows="4" type="text" class="mt-1 block w-full">

            </x-text-area>

            <x-input-error class="mt-2" :messages="$errors->get('message')" />
        </div>

        <x-primary-button>{{ __('Send message') }}</x-primary-button>
    </form>

    @if ($successMsg)
        <div class="flex p-4 my-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
            role="alert">
            <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Info</span>
            <div>
                {{ $successMsg }}
            </div>
        </div>
    @endif

</div>
