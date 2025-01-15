@extends('templates.main', ['menu' => "Home", "submenu" => "Register"])

@section('titulo') Register @endsection

@section('conteudo')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 fade-in">
            <div class="card border-0 shadow-lg" x-data="{ loading: false }">
                <div class="card-header text-white bg-dark py-3">
                    <h5 class="card-title mb-0 text-center">{{ __('Register') }}</h5>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}" 
                          @submit="loading = true">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-input-label for="nome" :value="__('Nome')" />
                            <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('nome')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Senha')" />

                            <x-text-input id="password" class="block mt-1 w-full"
                                            type="password"
                                            name="password"
                                            required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirmar Senha')" />

                            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                            type="password"
                                            name="password_confirmation" required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <!-- Role ID -->
                        <div class="mt-4">
                            <x-input-label for="role_id" :value="__('Role')" />
                            <select id="role_id" name="role_id" class="block mt-1 w-full" required>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
                        </div>

                        <div class="mt-4 d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-dark px-4"
                                    :class="{ 'opacity-50': loading }"
                                    :disabled="loading">
                                <span x-show="!loading">{{ __('Register') }}</span>
                                <span x-show="loading">
                                    <i class="fas fa-spinner fa-spin"></i> Processing...
                                </span>
                            </button>
                            
                            <a class="text-sm text-muted hover:text-dark" 
                               href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection