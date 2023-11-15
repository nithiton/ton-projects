<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Scope') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl text-sm mt-2 text-gray-800 dark:text-gray-200">
                    <form method="post" action="{{ route('scopes.store') }}" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            <x-input-label for="id" :value="__('ID')" />
                            <x-text-input id="id" name="id" type="text" class="mt-1 block w-full" :value="old('id')" required autofocus  />
                            <x-input-error class="mt-2" :messages="$errors->get('id')" />
                        </div>
                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
