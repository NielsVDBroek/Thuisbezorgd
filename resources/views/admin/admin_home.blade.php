<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in as Admin!") }}
                </div>
                <div class="p-6 text-gray-900">
                    <button class="menu-button" onclick="location.href='{{ route('menu.create') }}'">Item toevoegen</button>
                </div>
                <div class="p-6 text-gray-900">
                    <button onclick="location.href='{{ route('menu.index') }}'">Items bekijken</button>
                </div>
                <div class="p-6 text-gray-900">
                    <button onclick="location.href='{{ route('contact.contact-messages') }}'">Berichten bekijken</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
