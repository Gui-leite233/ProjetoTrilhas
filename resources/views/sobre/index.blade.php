<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre o Projeto Trilhas</title>
    <link rel="stylesheet" href="{{asset('css/sobre.css')}}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header>
        <div class="header-content">
            <img src="{{asset('img/images.png')}}" alt="Logo IFPR" style="height: 50px;">
            <h1>Trilhas de Aprendizagem</h1>
            <nav>
                <ul>
                    <li><a href="#objetivos"><i class='bx bx-target-lock'></i> Objetivo</a></li>
                    <li><a href="#metodologia"><i class='bx bx-book'></i> Metodologia</a></li>
                    <li><a href="#resultados"><i class='bx bx-line-chart'></i> Resultados</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="container">
        <section id="sobre">
            <h2>Sobre</h2>
            <p>O projeto Trilhas foi desenvolvido de setembro a dezembro de 2022, em resposta a uma demanda apresentada pela seção pedagógica e de assuntos estudantis do IFPR do Campus Paranaguá. O objetivo do projeto é apoiar os estudantes em suas diversas questões, especialmente no desenvolvimento escolar.</p>
        </section>
        <section id="objetivos">
            <h2>Objetivos do Projeto</h2>
            <p>O projeto de ensino multidisciplinar visa:</p>
            <ul>
                <li>Produzir mapas conceituais a partir das ementas dos componentes dos cursos técnicos integrados ao ensino médio.</li>
                <li>Apoiar-se na teoria da Aprendizagem Significativa de David Ausubel e na técnica cognitiva denominada Mapa Conceitual de Joseph Novak.</li>
                <li>Estimular a aprendizagem entre pares, metodologia difundida por Eric Mazur da Universidade de Harvard.</li>
            </ul>
        </section>
        <section id="metodologia">
            <h2>Metodologia</h2>
            <p>A estratégia do projeto permite que os próprios estudantes, remunerados com bolsas de estudo ou com horas complementares, possam:</p>
            <ul>
                <li>Entender melhor a dinâmica do IFPR.</li>
                <li>Ajudar os novos alunos a se adaptar acessando materiais produzidos por seus pares.</li>
            </ul>
        </section>
        <section id="resultados">
            <h2>Resultados Esperados</h2>
            <p>Os resultados esperados são:</p>
            <ul>
                <li>Criação de um repositório digital, caracterizado como uma trilha de aprendizagem.</li>
                <li>Utilização de mapas conceituais com hiperlinks que levem os estudantes para materiais já consultados por alunos de anos anteriores.</li>
                <li>Facilitar o processo de ensino-aprendizagem e reduzir os impactos da dificuldade de adaptação dos novos alunos.</li>
            </ul>
            <div class="docs-section">
                <h3>Documentos Trilhas</h3>
                <div class="pdf-embed">
                    <h4>Trilhas 2022</h4>
                    <embed src="{{asset('pdf/Relatório Trilhas.pdf')}}" type="application/pdf" width="600" height="500" title="Relatório Trilhas">
                </div>
                <div class="pdf-embed">
                    <h4>Trilhas 2023</h4>
                    <embed src="{{asset('pdf/Relatório Trilhas 2023.pdf')}}" type="application/pdf" width="600" height="500" title="Relatório Trilhas 2023">
                </div>
                <div class="pdf-embed">
                    <h4>Proposta de Projeto</h4>
                    <embed src="{{asset('pdf/Trilhas - Abrindo caminho para quem chega aos cursos técnicos integrados ao ensino médio do IFPR Campus Paranaguá.pdf')}}" type="application/pdf" width="600" height="500" title="Relatório Trilhas 2023">></embed>
                </div>
            </div>
            
            
            
               
        </section>
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
                    <li><a href="https://www.instagram.com/trilhas.ifpr?igsh=ZXozejc1cmdra2Nm"><i class="bx bxl-instagram"></i> Instagram</a></li>
                    <li><a href="https://w.app/BDigQJ"><i class="bx bxl-whatsapp"></i> WhatsApp</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 Projeto Trilhas IFPR. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>
