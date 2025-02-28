<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Trilhas IFPR</title>
    <link rel="stylesheet" href="{{asset('css/telaPrincipal.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script defer src="{{asset('js/navbar.js')}}"></script>
</head>
<body>
    <header>
        <a href="{{ url('/') }}" class="title-link">
            <div id="title">
                <img src="{{asset('img/images.png')}}" alt="Logo IFPR" loading="lazy">
                <h1>Trilhas de <span class="highlight">Aprendizagem</span></h1>
            </div>
        </a>

        <nav class="nav-menu">
            <ul class="nav-links">
                
                
                <li class="nav-item-dropdown">
                    <a href="#" class="dropdown-trigger">
                        <i class="fas fa-info-circle"></i> Informações
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('sobre') }}"><i class="fas fa-info-circle"></i> Sobre</a></li>
                        <li><a href="{{ route('contato') }}"><i class="fas fa-envelope"></i> Contato</a></li>
                    </ul>
                </li>

                @if(Auth::check())
                    <li class="nav-item-dropdown">
                        <a href="#" class="dropdown-trigger">
                            <i class="fas fa-user-circle"></i> {{ Auth::user()->nome }}
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                            @if(Auth::user()->role_id === 1)
                                <li><a href="{{ route('coordinator.register') }}"><i class="fas fa-user-plus"></i> Novo Usuário</a></li>
                                <li><a href="/admin"><i class="fas fa-solar-panel"></i> Admin Dashboard</a></li>
                            @endif
                        </ul>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="logout-form">
                            @csrf
                            <button type="submit" class="nav-button logout-button">
                                <i class="fas fa-sign-out-alt"></i> Sair
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item-dropdown">
                        <a href="#" class="dropdown-trigger">
                            <i class="fas fa-user"></i> Conta
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                            <li><a href="{{ route('register') }}"><i class="fas fa-user-plus"></i> Registrar</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
    </header>

    <main>
        <div class="video-container">
            <video src="{{asset('img/Conheça o Campus Paranaguá.mp4')}}" controls autoplay muted></video>
            <p>Mapa do Campus</p>
        </div>
        
        <section class="intro-section">
            <h2>Descubra Nossas Trilhas de Aprendizagem</h2>
            <p>Abaixo você encontrará diversas trilhas de aprendizagem que desenvolvemos para você. Clique em "Saiba mais" para explorar cada uma delas.</p>
        </section>
        
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
    </main>

    @include('components.footer')
</body>
</html>