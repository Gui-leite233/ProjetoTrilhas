@extends('templates.main', ['menu' => "Home", "submenu" => "Login"])

@section('titulo') Login @endsection

@section('conteudo')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 fade-in">
            <div class="card border-0 shadow-lg" x-data="{ loading: false }">
                <div class="card-header text-white bg-dark py-3">
                    <h5 class="card-title mb-0 text-center">{{ __('Login') }}</h5>
                </div>
                <div class="card-body p-4">
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" 
                          @submit="loading = true"
                          x-data="{ email: '', password: '' }">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />

                            <x-text-input id="password" class="block mt-1 w-full"
                                            type="password"
                                            name="password"
                                            required autocomplete="current-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Remember Me -->
                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <div class="mt-4 d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-dark px-4"
                                    :class="{ 'opacity-50': loading }"
                                    :disabled="loading">
                                <span x-show="!loading">{{ __('Log in') }}</span>
                                <span x-show="loading">
                                    <i class="fas fa-spinner fa-spin"></i> Loading...
                                </span>
                            </button>
                            
                            @if (Route::has('password.request'))
                                <a class="text-sm text-muted hover:text-dark" 
                                   href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
