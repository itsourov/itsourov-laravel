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
</div>
