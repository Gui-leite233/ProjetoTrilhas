<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Trilhas IFPR</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/cursos.css')}}">
</head>

<body>
    <header>
        <div id="title">
            <img src="{{asset('img/images.png')}}" alt="Logo">
            <h1>Trilhas de aprendizagem</h1>
        </div>

        <ul>
            <a href="./index.html">
                <li><i class="fas fa-info-circle"></i> Início</li>
            </a>
            <a href="./sobre.html">
                <li><i class="fas fa-envelope"></i> Sobre</li>
            </a>
            <a href="./contato.html" id="cadastre-se-btn">
                <li><i class="fas fa-user"></i> Contato</li>
            </a>
        </ul>
    </header>

    <!-- Título Informativo -->
    <section class="intro-section">
        <h2>Conheça Nossos Cursos</h2>
        <p>Explore os diversos cursos oferecidos pelo IFPR Paranaguá e descubra aquele que mais se adapta aos seus
            interesses e aspirações. Clique em "Saiba mais" para obter mais informações sobre cada curso.</p>
    </section>

    <div class="card-container">
        @foreach ($cursos as $item)
            <div class="card">
                <img src="{{ $item->imagem ?? '' }}" alt="{{ $item->nome }}">
                <div class="card-content">
                    <h3>{{ $item->nome }}</h3>
                    <p>{{ Str::limit($item->descricao, 100) }}</p>
                    <div class="button-group">
                        <a href="{{ $item->link }}" class="btn" target="_blank">Saiba mais</a>
                        @auth
                            <a href="{{ route('curso.edit', $item->id) }}" class="btn btn-edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('curso.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete"
                                    onclick="return confirm('Tem certeza que deseja excluir este curso?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if($cursos->isEmpty())
        @section('action_button')
        @auth

        @endauth
        @endsection
    @endif

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
                    <li><a href="https://www.instagram.com/trilhas.ifpr?igsh=ZXozejc1cmdra2Nm"><i
                                class="bx bxl-instagram"></i> Instagram</a></li>
                    <li><a href="https://w.app/BDigQJ"><i class="bx bxl-whatsapp"></i> WhatsApp</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 Projeto Trilhas IFPR. Todos os direitos reservados.</p>
        </div>
    </footer>

    @auth
        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
            <a href="{{ route('curso.create') }}" class="add-button">
                <i class="fas fa-plus"></i> Novo Curso
            </a>
        @endif
    @endauth
</body>

</html>