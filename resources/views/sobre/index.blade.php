<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre o Projeto Trilhas</title>
    <link rel="stylesheet" href="{{asset('css/sobre.css')}}">
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
            <a href="{{ route('sobre') }}" class="active"><li><i class="fas fa-info-circle"></i> Sobre</li></a>
            <a href="{{ route('contato') }}"><li><i class="fas fa-envelope"></i> Contato</li></a>
            @if(Auth::check())
                <li class="logged-user">
                    <i class="fas fa-user-circle"></i>
                    <span>Olá, {{ Auth::user()->nome }}</span>
                </li>
                @if(Auth::user()->role_id === 1)
                    <a href="{{ route('coordinator.register') }}" class="admin-register-btn">
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

    <div class="container">
        <div class="content-grid">
            <section id="sobre" class="content-card">
                <i class='bx bx-info-circle section-icon'></i>
                <h2>Sobre</h2>
                <p>
                    O projeto Trilhas foi desenvolvido entre setembro e dezembro de 2022, em resposta a uma necessidade
                    identificada pela seção pedagógica e de assuntos estudantis do IFPR – Campus Paranaguá. Seu objetivo
                    principal é apoiar os estudantes em sua jornada acadêmica, com foco na integração dos ingressantes e
                    no desenvolvimento escolar. A iniciativa busca promover a aprendizagem colaborativa e facilitar o
                    acesso a recursos educacionais, por meio de uma plataforma digital que organiza e disponibiliza
                    materiais acadêmicos, como resumos, pesquisas e trabalhos. Além disso, o sistema incentiva a troca
                    de conhecimento e a participação em atividades solidárias, contribuindo para a construção de um
                    ambiente educacional acolhedor e colaborativo.

                    O desenvolvimento do projeto foi realizado pelos estudantes Isabelle Alves da Silva e Guilherme
                    Leite da Silva Chagas, do curso Técnico em Informática do IFPR – Campus Paranaguá. Eles contaram com
                    a orientação do professor Gil Eduardo Andrade e a coorientação da professora Thaise Liara Silva. A
                    equipe trabalhou de forma integrada, unindo conhecimentos técnicos e pedagógicos para garantir que a
                    plataforma atendesse às necessidades dos estudantes, proporcionando uma solução inovadora e alinhada
                    aos valores de cooperação e inclusão social promovidos pela instituição.</p>
            </section>

            <section id="objetivos" class="content-card">
                <i class='bx bx-target-lock section-icon'></i>
                <h2>Objetivos do Projeto</h2>
                <div class="list-content">
                    <p>O projeto de ensino multidisciplinar visa:</p>
                    <ul>
                        <li><i class='bx bx-check'></i> Produzir mapas conceituais a partir das ementas dos componentes
                            dos cursos técnicos integrados ao ensino médio.</li>
                        <li><i class='bx bx-check'></i> Apoiar-se na teoria da Aprendizagem Significativa de David
                            Ausubel e na técnica cognitiva denominada Mapa Conceitual de Joseph Novak.</li>
                        <li><i class='bx bx-check'></i> Estimular a aprendizagem entre pares, metodologia difundida por
                            Eric Mazur da Universidade de Harvard.</li>
                    </ul>
                </div>
            </section>

            <section id="metodologia" class="content-card">
                <i class='bx bx-book section-icon'></i>
                <h2>Metodologia</h2>
                <div class="list-content">
                    <p>A estratégia do projeto permite que os próprios estudantes, remunerados com bolsas de estudo ou
                        com horas complementares, possam:</p>
                    <ul>
                        <li><i class='bx bx-check'></i> Entender melhor a dinâmica do IFPR.</li>
                        <li><i class='bx bx-check'></i> Ajudar os novos alunos a se adaptar acessando materiais
                            produzidos por seus pares.</li>
                    </ul>
                </div>
            </section>

            <section id="resultados" class="content-card">
                <i class='bx bx-line-chart section-icon'></i>
                <h2>Resultados Esperados</h2>
                <div class="list-content">
                    <ul>
                        <li><i class='bx bx-check'></i> Criação de um repositório digital, caracterizado como uma trilha
                            de aprendizagem.</li>
                        <li><i class='bx bx-check'></i> Utilização de mapas conceituais com hiperlinks que levem os
                            estudantes para materiais já consultados por alunos de anos anteriores.</li>
                        <li><i class='bx bx-check'></i> Facilitar o processo de ensino-aprendizagem e reduzir os
                            impactos da dificuldade de adaptação dos novos alunos.</li>
                    </ul>
                </div>
            </section>

            <section class="docs-section content-card">
                <i class='bx bx-file section-icon'></i>
                <h2>Documentos Trilhas</h2>
                <div class="docs-grid">
                    <div class="pdf-card">
                        <i class='bx bxs-file-pdf'></i>
                        <h4>Trilhas 2022</h4>
                        <embed src="{{asset('pdf/Relatório Trilhas.pdf')}}" type="application/pdf" width="100%"
                            height="400">
                    </div>
                    <div class="pdf-card">
                        <i class='bx bxs-file-pdf'></i>
                        <h4>Trilhas 2023</h4>
                        <embed src="{{asset('pdf/Relatório Trilhas 2023.pdf')}}" type="application/pdf" width="100%"
                            height="400">
                    </div>
                    <div class="pdf-card">
                        <i class='bx bxs-file-pdf'></i>
                        <h4>Proposta de Projeto</h4>
                        <embed
                            src="{{asset('pdf/Trilhas - Abrindo caminho para quem chega aos cursos técnicos integrados ao ensino médio do IFPR Campus Paranaguá.pdf')}}"
                            type="application/pdf" width="100%" height="400">
                    </div>
                </div>
            </section>
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