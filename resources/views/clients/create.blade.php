<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Client') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl text-sm mt-2 text-gray-800 dark:text-gray-200">
                    <form method="post" action="{{ route('clients.store') }}" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div>
                            <x-input-label for="redirect" :value="__('Redirect')" />
                            <x-text-input id="redirect" name="redirect" type="text" class="mt-1 block w-full" :value="old('redirect')" />
                            <x-input-error class="mt-2" :messages="$errors->get('redirect')" />
                        </div>
                        <div>
                            <input type="radio" id="client_type" name="client_type" value="personal_access_client" >
                            <x-input-label for="client_type" :value="__('Personal access Client')" />

                            <input type="radio" id="client_type" name="client_type" value="password_client" >
                            <x-input-label for="client_type" :value="__('Password Client')" />

                            <input type="radio" id="client_type" name="client_type" value="client_credentials" >
                            <x-input-label for="client_type" :value="__('Client Credentials')" />

                            <x-input-error class="mt-2" :messages="$errors->get('client_type')" />
                        </div>
                        <div>
                            <x-input-label for="scopes" :value="__('Scope')" />
                            @foreach($scopes as $scope)
                                <div>
                                    <input type="checkbox" name="scopes[]" value="{{ $scope->id }}"> {{ $scope->description }}
                                </div>
                            @endforeach
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
