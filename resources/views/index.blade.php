<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Trilhas IFPR</title>
    <link rel="stylesheet" href="{{asset('css/telaPrincipal.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <header>
        <a href="{{ url('/') }}" class="title-link">
            <div id="title">
                <img src="{{asset('img/images.png')}}" alt="Logo">
                <h1>Trilhas de aprendizagem</h1>
            </div>
        </a>

        <ul class="nav-links">
            <a href="{{ url('/') }}"><li><i class="fas fa-home"></i> Inicio</li></a>
            <a href="{{ route('sobre') }}"><li><i class="fas fa-info-circle"></i> Sobre</li></a>
            <a href="{{ route('contato') }}"><li><i class="fas fa-envelope"></i> Contato</li></a>
            @if(Auth::check())
                <li class="logged-user">
                    <i class="fas fa-user-circle"></i>
                    <span>Olá, {{ Auth::user()->nome }}</span>
                </li>
                @if(Auth::user()->role_id === 1)
                    <a href="{{ route('admin.register') }}" class="admin-register-btn">
                        <li><i class="fas fa-user-plus"></i> Novo Usuário</li>
                    </a>
                @endif
                <a href="{{ route('dashboard') }}"><li><i class="fas fa-tachometer-alt"></i> Dashboard</li></a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="nav-button"><i class="fas fa-sign-out-alt"></i> Sair</button>
                </form>
            @else
                <a href="{{ route('login') }}"><li><i class="fas fa-sign-in-alt"></i> Login</li></a>
                <a href="{{ route('register') }}"><li><i class="fas fa-user-plus"></i> Registrar</li></a>
            @endif
        </ul>
    </header>

    <div class="video-container">
        <video src="{{asset('img/Conheça o Campus Paranaguá.mp4')}}" controls autoplay muted></video>
        <p>Mapa do Campus</p>
    </div>
    
    <!-- Título Informativo -->
    <section class="intro-section">
        <h2>Descubra Nossas Trilhas de Aprendizagem</h2>
        <p>Abaixo você encontrará diversas trilhas de aprendizagem que desenvolvemos para você. Clique em "Saiba mais" para explorar cada uma delas.</p>
    </section>
    
    <!-- Change the card-container class to include homepage-cards -->
    <div class="card-container homepage-cards">
        <div class="card">
            <div class="card-inner">
                <div class="card-header">
                    <div class="icon-wrapper">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                </div>
                <div class="card-content">
                    <div class="content-main">
                        <h3>CURSOS</h3>
                        <p class="description">
                            Invista no seu futuro com nossos cursos técnicos. Adquira habilidades e aumente suas oportunidades de carreira!🚀📚
                        </p>
                        <div class="button-row-center">
                            <a href="{{ route('curso.index') }}" class="btn btn-saiba-mais">
                                <i class="fas fa-external-link-alt"></i> Saiba mais
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-inner">
                <div class="card-header">
                    <div class="icon-wrapper">
                        <i class="fas fa-book-open"></i>
                    </div>
                </div>
                <div class="card-content">
                    <div class="content-main">
                        <h3>RESUMOS</h3>
                        <p class="description">
                            Publique seus resumos e ajude a comunidade a crescer. Vamos construir conhecimento juntos! 🌟📚
                        </p>
                        <div class="button-row-center">
                            <a href="{{ route('resumo.index') }}" class="btn btn-saiba-mais">
                                <i class="fas fa-external-link-alt"></i> Saiba mais
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-inner">
                <div class="card-header">
                    <div class="icon-wrapper">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                </div>
                <div class="card-content">
                    <div class="content-main">
                        <h3>PROJETOS</h3>
                        <p class="description">
                            Participe de nossos projetos acadêmicos e fortaleça sua experiência prática e aprendizado colaborativo! 🚀📚
                        </p>
                        <div class="button-row-center">
                            <a href="{{ route('projeto.index') }}" class="btn btn-saiba-mais">
                                <i class="fas fa-external-link-alt"></i> Saiba mais
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-inner">
                <div class="card-header">
                    <div class="icon-wrapper">
                        <i class="fas fa-file-alt"></i>
                    </div>
                </div>
                <div class="card-content">
                    <div class="content-main">
                        <h3>PROVAS</h3>
                        <p class="description">
                            Explore provas antigas e melhore sua preparação. Estude de maneira inteligente!📚📝
                        </p>
                        <div class="button-row-center">
                            <a href="{{ route('prova.index') }}" class="btn btn-saiba-mais">
                                <i class="fas fa-external-link-alt"></i> Saiba mais
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-inner">
                <div class="card-header">
                    <div class="icon-wrapper">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                </div>
                <div class="card-content">
                    <div class="content-main">
                        <h3>BOLSAS</h3>
                        <p class="description">
                            Aproveite nossas bolsas de estudo e impulsione seu futuro acadêmico. Garanta seu sucesso! 🌟🎓
                        </p>
                        <div class="button-row-center">
                            <a href="{{ route('bolsa.index') }}" class="btn btn-saiba-mais">
                                <i class="fas fa-external-link-alt"></i> Saiba mais
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-inner">
                <div class="card-header">
                    <div class="icon-wrapper">
                        <i class="fas fa-file-signature"></i>
                    </div>
                </div>
                <div class="card-content">
                    <div class="content-main">
                        <h3>TCC'S</h3>
                        <p class="description">
                            Explore os TCC's realizados e inspire-se para criar o seu próprio trabalho acadêmico! 🌟📚
                        </p>
                        <div class="button-row-center">
                            <a href="{{ route('tcc.index') }}" class="btn btn-saiba-mais">
                                <i class="fas fa-external-link-alt"></i> Saiba mais
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h4>Informações de Contato:</h4>
                <p>Endereço: Av. Antônio Carlos Rodrigues, 453 - Porto Seguro, Paranaguá - PR, 83215-750</p>
                <p>Telefone: (41) 3300-0134</p>
                <p>Email: sepae.paranagua@ifpr.edu.br</p>
            </div>
            <div class="footer-section">
                <h4>Acompanhe:</h4>
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
</body>
</html>
