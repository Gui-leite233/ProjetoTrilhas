<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Coordenador - Trilhas IFPR</title>
    <link rel="stylesheet" href="{{ asset('css/coordinator-register.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="coordinator-register-container">
        <div class="register-card">
            <div class="register-header">
                <i class="fas fa-user-tie"></i>
                <h2>Cadastro de Coordenador</h2>
                <p>Preencha os dados para registrar um novo coordenador no sistema</p>
            </div>

            <form method="POST" action="{{ route('coordinator.store') }}">
                @csrf
                
                <div class="form-group">
                    <label for="nome">Nome Completo</label>
                    <i class="fas fa-user"></i>
                    <input type="text" 
                           id="nome" 
                           name="nome" 
                           value="{{ old('nome') }}" 
                           required 
                           autofocus 
                           placeholder="Digite o nome completo">
                    @error('nome')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email Institucional</label>
                    <i class="fas fa-envelope"></i>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           placeholder="nome@ifpr.edu.br">
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Senha</label>
                    <i class="fas fa-lock"></i>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           required 
                           placeholder="Digite a senha">
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmar Senha</label>
                    <i class="fas fa-lock"></i>
                    <input type="password" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           required 
                           placeholder="Confirme a senha">
                </div>

                <div class="button-group">
                    <a href="{{ route('home') }}" class="btn btn-back">
                        <i class="fas fa-arrow-left"></i>
                        Voltar
                    </a>
                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-user-plus"></i>
                        Registrar Coordenador
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
