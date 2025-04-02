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
                    <h3 class="text-lg font-medium mb-4">System Statistics</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($stats as $key => $value)
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="text-sm text-gray-600">{{ ucfirst($key) }}</div>
                                <div class="text-2xl font-bold">{{ $value }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
