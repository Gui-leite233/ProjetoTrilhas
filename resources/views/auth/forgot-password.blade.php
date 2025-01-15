@extends('templates.main', ['menu' => "Home", "submenu" => "Forgot Password"])

@section('titulo') Forgot Password @endsection

@section('conteudo')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 fade-in">
            <div class="card border-0 shadow-lg" x-data="{ loading: false }">
                <x-guest-layout>
                    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Email Password Reset Link') }}
                            </x-primary-button>
                        </div>
                    </form>
                </x-guest-layout>
            </div>
        </div>
    </div>
</div>
@endsection
