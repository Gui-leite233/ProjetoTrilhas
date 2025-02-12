<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/styles/style.css" rel="stylesheet">
    <link href="/styles/fonts.css" rel="stylesheet">
    <link href="/styles/media.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Dashboard - Trilhas</title>
</head>
<body>
    <header>
        <div id="title">
            <a href="{{ url('/') }}" class="title-link">
                <img src="{{asset('img/images.png')}}" alt="Logo">
                <h1>Trilhas de aprendizagem</h1>
            </a>
        </div>
        <nav>
            <ul class="nav-links">
                <form method="POST" action="{{ route('logout') }}" class="nav-link">
                    @csrf
                    <button type="submit" class="nav-button">
                        <li>
                            <i class="fas fa-sign-out-alt"></i>
                            Sair
                        </li>
                    </button>
                </form>
            </ul>
        </nav>
    </header>

    <main>
        <aside>
            <h2><span>Dashboard</span></h2>
            <div class="dashboard-cards">
                <a href="{{ route('profile.edit') }}" class="card" x-data="{ hover: false }" 
                     @mouseenter="hover = true" 
                     @mouseleave="hover = false">
                    <div class="card-content">
                        <i class="fas fa-user-circle fa-3x"></i>
                        <h3>Perfil</h3>
                        <p>Edite suas informações pessoais</p>
                    </div>
                </a>

                <a href="#" class="card" x-data="{ hover: false }"
                     @mouseenter="hover = true" 
                     @mouseleave="hover = false"
                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div class="card-content">
                        <i class="fas fa-sign-out-alt fa-3x"></i>
                        <h3>Sair</h3>
                        <p>Encerrar sessão</p>
                    </div>
                </a>
                <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                    @csrf
                </form>
            </div>
        </aside>
    </main>

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

    <style>
        .dashboard-cards {
            display: flex;
            gap: 2rem;
            margin-top: 2rem;
            perspective: 1000px;
        }

        .card {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            flex: 1;
            text-align: center;
            cursor: pointer;
            transform-style: preserve-3d;
            animation: fadeInUp 0.6s ease-out forwards;
            opacity: 0;
            position: relative;
            text-decoration: none; /* Add this */
            display: block; /* Add this */
        }

        .card:hover {
            transform: translateY(-10px) rotateX(5deg);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .card:hover i {
            transform: translateY(-5px) scale(1.1);
            color: #007bff;
        }

        .card-content {
            text-decoration: none;
            color: inherit;
            display: block;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .card i {
            color: #333;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .card h3 {
            margin: 1rem 0;
            color: #333;
            transform: translateZ(20px);
            transition: all 0.3s ease;
        }

        .card p {
            color: #666;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            opacity: 0.8;
        }

        .card:hover p {
            opacity: 1;
            transform: translateY(-2px);
        }

        .card button {
            background: none;
            border: none;
            width: 100%;
            height: 100%;
            cursor: pointer;
            padding: 0;
            transition: all 0.3s ease;
            color: inherit;
            font-family: inherit;
        }

        .card button h3 {
            margin: 1rem 0;
            color: #333;
        }

        .card button p {
            color: #666;
            font-size: 0.9rem;
        }

        /* Enhanced animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .card:nth-child(1) { animation-delay: 0.2s; }
        .card:nth-child(2) { animation-delay: 0.4s; }

        /* Pulse animation on hover */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .card:hover i {
            animation: pulse 1s infinite;
        }

        /* Add ripple effect on click */
        .card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 10px;
            background: radial-gradient(circle, rgba(255,255,255,0.7) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .card:active::after {
            opacity: 1;
        }
    </style>
</body>
</html>

