<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/telaPrincipal.css')}}">
    <title>@yield('title', 'Projeto Trilhas IFPR')</title>
    @yield('additional_css')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <header>
        <a href="{{ url('/') }}" style="text-decoration: none; color: inherit;"></a>
            <div id="title">
                <img src="{{asset('img/images.png')}}" alt="Logo">
                <h1>Trilhas de aprendizagem</h1>
            </div>
        </a>

        <ul>
            <a href="{{ route('register') }}">
                <li><i class="fas fa-info-circle"></i> Inicio</li>
            </a>
            <a href="{{ route('sobre') }}">
                <li><i class="fas fa-envelope"></i> Sobre</li>
            </a>
            <a href="{{ url('/contato') }}" id="inscreva-se-btn">
                <li><i class="fas fa-user"></i> Contato</li>
            </a>
        </ul>
    </header>   

    @hasSection('action_button')
        <div class="action-button-container">
            @yield('action_button')
        </div>
    @endif

    @yield('content')

    <footer>
        <div class="footer-container">
            <div class="footer-section"></div>
                <h4>Informações de Contato:</h4>
                <p>Endereço: Av. Antônio Carlos Rodrigues, 453 - Porto Seguro, Paranaguá - PR, 83215-750</p>
                <p>Telefone: (41) 3300-0134</p>
                <p>Email: sepae.paranagua@ifpr.edu.br</p>
            </div>
            <div class="footer-section">
                <h4>Acompanhe:</h4>
                <ul class="social-links">
                    <li><a href="https://www.instagram.com/trilhas.ifpr?igsh=ZXozejc1cmdra2Nm"><i
                                class="fab fa-instagram"></i> Instagram</a></li>
                    <li><a href="https://w.app/BDigQJ"><i class="fab fa-whatsapp"></i> WhatsApp</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 Projeto Trilhas IFPR. Todos os direitos reservados.</p>
        </div>
    </footer>
    @yield('scripts')
    @yield('additional_js')
</body>

</html>