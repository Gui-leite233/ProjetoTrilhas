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
        <a href="{{ url('/') }}" style="text-decoration: none; color: inherit;">
            <div id="title">
                <img src="{{asset('img/images.png')}}" alt="Logo">
                <h1>Trilhas de aprendizagem</h1>
            </div>
        </a>

        <ul>
            <a href="{{ route('register') }}"><li><i class="fas fa-info-circle"></i> Inicio</li></a>
            <a href="{{ route('sobre') }}"><li><i class="fas fa-envelope"></i> Sobre</li></a>
            <a href="{{ url('/contato') }}" id="cadastre-se-btn"><li><i class="fas fa-user"></i> Contato</li></a>
            @auth
                
                {{-- Check for admin role using role_id --}}
                @if(Auth::user()->role_id === 1)
                    <a href="{{ route('admin.register') }}" class="admin-register-btn">
                        <li><i class="fas fa-user-plus"></i> Novo Usuário</li>
                    </a>
                @endif
            @endauth
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
    
    <!-- Change the card-container class to index-cards -->
    <div class="index-cards">
        <div class="card">
            <i class="fas fa-graduation-cap fa-5x"></i> <!-- Ícone de Cursos -->
            <div class="card-content">
                <h3>CURSOS</h3>
                <p>Invista no seu futuro com nossos cursos técnicos. Adquira habilidades e aumente suas oportunidades de carreira!🚀📚</p>
                <a href="{{ route('curso.index') }}" class="btn">Saiba mais</a>
            </div>
        </div>
        <div class="card">
            <i class="fas fa-book-open fa-5x"></i> <!-- Ícone de Resumos -->
            <div class="card-content">
                <h3>RESUMOS</h3>
                <p>Publique seus resumos e ajude a comunidade a crescer. Vamos construir conhecimento juntos! 🌟📚</p>
                <a href="{{ route('resumo.index') }}" class="btn">Saiba mais</a>
            </div>
        </div>
        <div class="card">
            <i class="fas fa-project-diagram fa-5x"></i> <!-- Ícone de Projetos -->
            <div class="card-content">
                <h3>PROJETOS</h3>
                <p>Participe de nossos projetos acadêmicos e fortaleça sua experiência prática e aprendizado colaborativo! 🚀📚</p>
                <a href="{{ route('projeto.index') }}" class="btn">Saiba mais</a>
            </div>
        </div>
        <div class="card">
            <i class="fas fa-file-alt fa-5x"></i> <!-- Ícone de Provas -->
            <div class="card-content">
                <h3>PROVAS</h3>
                <p>Explore provas antigas e melhore sua preparação. Estude de maneira inteligente!📚📝</p>
                <a href="{{ route('prova.index') }}" class="btn">Saiba mais</a>
            </div>
        </div>
        <div class="card">
            <i class="fas fa-hand-holding-usd fa-5x"></i> <!-- Ícone de Bolsas -->
            <div class="card-content">
                <h3>BOLSAS</h3>
                <p>Aproveite nossas bolsas de estudo e impulsione seu futuro acadêmico. Garanta seu sucesso! 🌟🎓</p>
                <a href="{{ route('bolsa.index') }}" class="btn">Saiba mais</a>
            </div>
        </div>
        
        <div class="card">
            <i class="fas fa-file-signature fa-5x"></i> <!-- Ícone de TCC'S -->
            <div class="card-content">
                <h3>TCC'S</h3>
                <p>Explore os TCC's realizados e inspire-se para criar o seu próprio trabalho acadêmico! 🌟📚</p>
                <a href="{{ route('tcc.index') }}" class="btn">Saiba mais</a>
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
