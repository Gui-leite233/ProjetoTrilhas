<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conta</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./styles/conta.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header> 
        <img src="./components/images/ifpr.jpg" alt="Imagem do Cabeçalho">
        <ul>
            <li><a href="./index.html"><i class="fas fa-envelope"></i> SEJA BEM VINDO</a></li>
            <li><a href="./sobre.html"><i class="fas fa-info-circle"></i> SOBRE</a></li>
            <li><a href="./contato.html"><i class="fas fa-envelope"></i> CONTATO</a></li>
        </ul>
    </header>
    <div class="wrapper">
        <form method="POST" action="{{ route('login') }}" x-data="{ loading: false }" @submit="loading = true">
            @csrf
            <h1>Conecte-se</h1>
            <x-auth-session-status class="mb-4" :status="session('status')" />
            
            <div class="input-box">
                <input type="email" name="email" placeholder="Email" required autofocus>
                <i class='bx bx-user'></i>
            </div>
            <x-input-error :messages="$errors->get('email')" class="error-message" />

            <div class="input-box">
                <input type="password" name="password" placeholder="Senha" required>
                <i class='bx bx-lock-alt'></i>
            </div>
            <x-input-error :messages="$errors->get('password')" class="error-message" />

            <div class="remember-forgot">
                <label><input type="checkbox" name="remember">Lembrar de mim</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Esqueceu a senha?</a>
                @endif
            </div>

            <button type="submit" class="btn" :class="{ 'opacity-75': loading }" :disabled="loading">
                <span x-show="!loading">Entrar</span>
                <div x-show="loading" class="spinner">Carregando...</div>
            </button>

            <div class="register-link">
                <p>Não tem uma conta? <a href="{{ route('register') }}">Registrar</a></p>
            </div>
        </form>
    </div>
    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h4>Informações de Contato</h4>
                <p>Endereço: Av. Antônio Carlos Rodrigues, 453 - Porto Seguro, Paranaguá - PR, 83215-750</p>
                <p>Telefone: (41) 3300-0134</p>
                <p>Email: sepae.paranagua@ifpr.edu.br</p>
            </div>
            <div class="footer-section">
                <h4>Acompanhe</h4>
                <ul class="social-links">
                    <li><a href="https://www.instagram.com/trilhas.ifpr?igsh=ZXozejc1cmdra2Nm"><i class="fab fa-instagram"></i> Instagram</a></li>
                    <li><a href="https://w.app/BDigQJ"><i class="fab fa-whatsapp"></i> WhatsApp</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 Projeto Trilhas IFPR. Todos os direitos reservados.</p>
        </div>
    </footer>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .error-message {
            color: red;
            font-size: 0.8em;
            margin-top: 5px;
        }
        .spinner {
            font-size: 0.8em;
            opacity: 0.7;
        }
    </style>
</body>
</html>
