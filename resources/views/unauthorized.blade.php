<x-guest-error-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="text-center">
                        <svg class="mx-auto h-8 w-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-red-600">
                            {{ __('Unauthorized Access') }}
                        </h3>
                        <p class="mt-2 mb-4 text-gray-600">
                            {{ __('You do not have permission to access this area.') }}
                        </p>
                        @if(isset($attemptedUrl))
                            <p class="mb-4 text-sm text-gray-500">
                                {{ __('Attempted to access: ') }} <span class="font-mono">{{ $attemptedUrl }}</span>
                            </p>
                        @endif
                        <div class="mt-6 space-x-4">
                            <a href="{{ route('home') }}" class="text-blue-600 hover:underline">
                                {{ __('Return to Home') }}
                            </a>
                            @auth
                                <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline">
                                    {{ __('Go to Dashboard') }}
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-error-layout>