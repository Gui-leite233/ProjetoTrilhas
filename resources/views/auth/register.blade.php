@extends('templates.main', ['menu' => "Home", "submenu" => "Register"])

@section('titulo') Register @endsection

@section('conteudo')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-5">
            <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
                <div class="card-header text-white bg-dark py-4 border-0">
                    <div class="text-center">
                        <h4 class="card-title mb-0">Criar nova conta</h4>
                        <small class="text-white-50">Preencha os dados para se registrar</small>
                    </div>
                </div>
                <div class="card-body p-4">
                    <x-guest-layout>
                        <form method="POST" action="{{ route('register') }}" 
                              x-data="{ 
                                  loading: false, 
                                  selectedRole: '{{ old('role_id', '') }}',
                                  isAluno() { return this.selectedRole === '3' }
                              }" 
                              @submit="loading = true">
                            @csrf

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Name field with icon -->
                            <div class="mb-4">
                                <label class="form-label small fw-500">Nome</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
                                        </svg>
                                    </span>
                                    <input id="name" type="text" 
                                           class="form-control @error('nome') is-invalid @enderror" 
                                           name="nome" 
                                           value="{{ old('nome') }}" 
                                           required autocomplete="name" autofocus>
                                </div>
                                <x-input-error :messages="$errors->get('name')" class="mt-2 small text-danger" />
                            </div>

                            <!-- Email Address -->
                            <div class="mb-4">
                                <label class="form-label small fw-500">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.708 2.825L15 11.383V5.383zM1 5.383v6l4.708-2.825L1 5.383z"/>
                                        </svg>
                                    </span>
                                    <input type="email" class="form-control border-start-0" id="email" name="email" required>
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="mt-2 small text-danger" />
                            </div>

                            <!-- Password -->
                            <div class="mb-4">
                                <label class="form-label small fw-500">Senha</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                            <path d="M8 1a3 3 0 0 0-3 3v3H4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-5a2 2 0 0 0-2-2h-1V4a3 3 0 0 0-3-3zm-2 6V4a2 2 0 1 1 4 0v3H6zm-1 1h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-5a1 1 0 0 1 1-1z"/>
                                        </svg>
                                    </span>
                                    <input type="password" class="form-control border-start-0" id="password" name="password" required>
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-2 small text-danger" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <label class="form-label small fw-500">Confirmar Senha</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                                            <path d="M8 1a3 3 0 0 0-3 3v3H4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-5a2 2 0 0 0-2-2h-1V4a3 3 0 0 0-3-3zm-2 6V4a2 2 0 1 1 4 0v3H6zm-1 1h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-5a1 1 0 0 1 1-1z"/>
                                        </svg>
                                    </span>
                                    <input type="password" class="form-control border-start-0" id="password_confirmation" name="password_confirmation" required>
                                </div>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 small text-danger" />
                            </div>

                            <!-- Role selection -->
                            <div class="mb-4">
                                <label class="form-label text-muted small fw-bold">FUNÇÃO</label>
                                <select name="role_id" id="role_id" 
                                        x-model="selectedRole"
                                        class="form-select @error('role_id') is-invalid @enderror" 
                                        required>
                                    <option value="" disabled selected>Selecione uma função</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            
                            <div class="mb-4" 
                                 x-show="isAluno()" 
                                 x-transition>
                                <label class="form-label text-muted small fw-bold">CURSO</label>
                                <select name="curso_id" id="curso_id" 
                                        class="form-select @error('curso_id') is-invalid @enderror"
                                        x-bind:required="isAluno()">
                                    <option value="">Selecione um curso</option>
                                    @foreach($cursos as $curso)
                                        <option value="{{ $curso->id }}" {{ old('curso_id') == $curso->id ? 'selected' : '' }}>
                                            {{ $curso->nome }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('curso_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4" 
                                 x-show="isAluno()" 
                                 x-transition>
                                <label class="form-label text-muted small fw-bold">ANO</label>
                                <select name="ano" id="ano" 
                                        class="form-select @error('ano') is-invalid @enderror"
                                        x-bind:required="isAluno()">
                                    <option value="">Selecione o ano</option>
                                    @for($i = 1; $i <= 4; $i++)
                                        <option value="{{ $i }}" {{ old('ano') == $i ? 'selected' : '' }}>
                                            {{ $i }}º Ano
                                        </option>
                                    @endfor
                                </select>
                                @error('ano')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-dark w-100 py-2 mb-3" :disabled="loading">
                                <span x-show="!loading">Criar Conta</span>
                                <span x-show="loading">
                                    <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                                    Processando...
                                </span>
                            </button>

                            <p class="text-center mb-0 small">
                                Já tem uma conta? 
                                <a href="{{ route('login') }}" class="text-decoration-none">Faça login</a>
                            </p>
                        </form>
                    </x-guest-layout>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<!-- Remove previous JavaScript code since we're now using Alpine.js -->
@endpush

<style>
// ...same styles as login page...
</style>
@endsection