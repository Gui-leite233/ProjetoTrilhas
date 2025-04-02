<x-guest-error-layout>
    <link href="{{ asset('css/unauthorized.css') }}" rel="stylesheet">
    
    <div class="unauthorized-container min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md mx-auto">
            <div class="error-card bg-white rounded-xl p-6 sm:p-8 mx-4">
                <div class="text-center">
                    <div class="error-icon-wrapper mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>

                    <h3 class="mt-6 text-xl font-bold text-gray-900">
                        {{ __('Acesso Não Autorizado') }}
                    </h3>

                    <p class="mt-3 text-base text-gray-600">
                        {{ __('Você não tem permissão para acessar esta área.') }}
                    </p>

                    @if(isset($attemptedUrl))
                        <div class="mt-4 mx-auto max-w-md">
                            <p class="text-sm text-gray-500 bg-gray-50 rounded-lg p-3 break-all">
                                {{ __('Tentou acessar: ') }} 
                                <span class="font-mono text-xs block mt-1">{{ $attemptedUrl }}</span>
                            </p>
                        </div>
                    @endif

                    <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4">
                        <a href="{{ route('home') }}" 
                           class="primary-button w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white">
                            {{ __('Voltar para Início') }}
                        </a>
                        @auth
                            <a href="{{ route('dashboard') }}" 
                               class="secondary-button w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white">
                                {{ __('Ir para Painel') }}
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-error-layout>