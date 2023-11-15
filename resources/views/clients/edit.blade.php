<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Clients Detail') }}
        </h2>
    </x-slot>=
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl text-sm mt-2 text-gray-800 dark:text-gray-200">
                    <form method="post" action="{{ route('clients.update', [$client->id]) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')
                        <div>
                            <x-input-label for="id" :value="__('id')" />
                            <x-text-input type="text" class="mt-1 block w-full" :value="old('id', $client->id)" :disabled="true" :readonl="true" />
                        </div>
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $client->name)" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div>
                            <x-input-label for="secret" :value="__('Secret')" />
                            <x-text-input id="secret" name="secret" type="text" class="mt-1 block w-full" :value="old('secret', $client->secret)" :disabled="true" :readonl="true" />
                        </div>
                        <div>
                            <x-input-label for="redirect" :value="__('Redirect')" />
                            @if($client->password_client == 0 && $client->personal_access_client == 0)
                                <x-text-input id="redirect" name="redirect" type="text" class="mt-1 block w-full" :value="old('redirect', $client->redirect)" />
                            @else
                                <x-text-input id="redirect" name="redirect" type="text" class="mt-1 block w-full" :value="old('redirect', $client->redirect)" required />
                            @endif
                            <x-input-error class="mt-2" :messages="$errors->get('redirect')" />
                        </div>
                        <div>
                            @if($client->password_client == 0 && $client->personal_access_client == 1)
                                <input type="hidden" id="client_type" name="client_type" value="personal_access_client" >
                                <x-input-label for="client_type" :value="__('Client Type : Personal access Client')" />
                            @elseif($client->password_client == 1 && $client->personal_access_client == 0)
                                <input type="hidden" id="client_type" name="client_type" value="password_client" >
                                <x-input-label for="client_type" :value="__('Client Type : Password Client')" />
                            @elseif($client->password_client == 0 && $client->personal_access_client == 0)
                                <input type="hidden" id="client_type" name="client_type" value="client_credentials" >
                                <x-input-label for="client_type" :value="__('Client Type : Client Credentials')" />
                            @endif
                        </div>

                        <div>
                            <x-input-label for="scopes" :value="__('Scope')" />
                            @foreach($scopes as $scope)
                                <div>
                                    <input type="checkbox" name="scopes[]" value="{{ $scope->id }}"
                                    @if(in_array($scope->id, $client->scopes)) checked @endif > {{ $scope->description }}
                                </div>
                            @endforeach
                        </div>
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                    @if (session('status') === 'client-updated')
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600 dark:text-gray-400"
                        >{{ __('Saved.') }}</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
