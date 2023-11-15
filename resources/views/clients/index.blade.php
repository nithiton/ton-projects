<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <div class="" >
                {{ __('Client List') }}
            </div>
            <div class="">
                <a href="{{ route('clients.create') }}">
                    {{ __('CREATE NEW CLIENT +') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @foreach($clients as $client)
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <a href="{{ route('clients.edit', [$client->id]) }}">
                        <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                            {{ $client->name }} >
                        </p>
                    </a>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</x-app-layout>
