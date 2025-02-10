<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos - Projeto Trilhas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/cursos.css') }}">
</head>
<body>
    <header>
        <a href="{{ url('/') }}">
            <div id="title">
                <img src="{{asset('img/images.png')}}" alt="Logo">
                <h1>Trilhas de aprendizagem</h1>
            </div>
        </a>

        <ul>
            <a href="{{ route('register') }}"><li><i class="fas fa-info-circle"></i> Inicio</li></a>
            <a href="{{ route('sobre') }}"><li><i class="fas fa-envelope"></i> Sobre</li></a>
            <a href="{{ url('/contato') }}"><li><i class="fas fa-user"></i> Contato</li></a>
        </ul>
    </header>

    <div class="container">
        <section class="intro-section">
            <h2>Conheça Nossos Cursos</h2>
            <p>Explore os diversos cursos oferecidos pelo IFPR Paranaguá e descubra aquele que mais se adapta aos seus
                interesses e aspirações.</p>
        </section>

        @auth
            @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                <div class="action-button">
                    <a href="{{ route('curso.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Novo Curso
                    </a>
                </div>
            @endif
        @endauth

        <div class="card-container">
            @foreach ($cursos as $item)
                <div class="card">
                    @if($item->imagem)
                        <img src="{{ $item->imagem }}" alt="{{ $item->nome }}">
                    @else
                        <div class="card-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                    @endif
                    <div class="card-content">
                        <h3>{{ $item->nome }}</h3>
                        <p>{{ Str::limit($item->descricao, 100) }}</p>
                        
                        <div class="card-actions">
                            @if($item->link)
                                <a href="{{ $item->link }}" class="btn btn-primary" target="_blank">
                                    <i class="fas fa-external-link-alt"></i> Saiba mais
                                </a>
                            @endif

                            @auth
                                @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    <a href="{{ route('curso.edit', $item->id) }}" class="btn btn-edit">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form action="{{ route('curso.destroy', $item->id) }}" method="POST" class="inline-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete" onclick="return confirm('Tem certeza que deseja excluir este curso?')">
                                            <i class="fas fa-trash"></i> Excluir
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($cursos->isEmpty())
            <div class="empty-state">
                <i class="fas fa-graduation-cap"></i>
                <p>Nenhum curso disponível no momento.</p>
            </div>
        @endif
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