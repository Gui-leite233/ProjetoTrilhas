<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="{{ asset('css/site.css') }}" rel="stylesheet">
    @stack('styles')
    <title>ProjetoTrilhas</title>
    
    <style>
        :root {
            --primary-color: #198754;
            --secondary-color: #28a745;
            --transition-speed: 0.3s;
        }

        /* Smooth scrolling and better font rendering */
        html {
            scroll-behavior: smooth;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Navbar Styles */
        .navbar {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            background-color: rgba(25, 135, 84, 0.95) !important;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0,0,0,.1);
            position: relative;
            z-index: 9000;  /* Higher base z-index */
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 600;
            color: #fff !important;
            transition: transform 0.2s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .nav-link {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background: rgba(255,255,255,0.1);
            transform: translateY(-2px);
        }

        /* Center Section for Admin Gear Icon */
        .center-section {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            z-index: 9100;  /* Higher than navbar */
        }

        /* Admin Gear Button */
        .admin-gear-btn {
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            padding: 8px 16px !important;
            background: rgba(255,255,255,0.1);
            border-radius: 20px !important;
            transition: all 0.3s ease !important;
            white-space: nowrap;
            gap: 8px;
        }

        .admin-gear-btn i {
            font-size: 1.1em;
            width: 1.2em;
            height: 1.2em;
            margin: 0;
        }

        .admin-gear-btn span {
            line-height: 1;
        }

        /* Dropdown Menu */
        .center-section .dropdown-menu {
            position: absolute !important;
            left: 50% !important;
            transform: translateX(-50%) !important;
            margin-top: 8px;
            min-width: 220px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.1);
            background: rgba(33, 37, 41, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            z-index: 9200;  /* Higher than center-section */
        }

        .dropdown-item {
            color: rgba(255,255,255,0.8);
            border-radius: 8px;
            padding: 0.7rem 1rem;
            margin: 2px 0;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            transform: translateX(5px);
        }

        /* Mobile Adjustments */
        @media (max-width: 992px) {
            .center-section {
                position: static;
                transform: none;
                width: 100%;
                margin: 10px 0;
            }

            .admin-gear-btn {
                width: 100%;
                justify-content: center !important;
                border-radius: 8px !important;
            }

            .center-section .dropdown-menu {
                width: 100%;
                position: static !important;
                transform: none !important;
                margin-top: 5px !important;
            }
        }

        /* Update container z-index - Add this new style */
        .container {
            position: relative;
            z-index: 1;
        }

        /* Add/Update User Dropdown Styles */
        .navbar-nav.ms-auto {
            z-index: 9100;
            position: relative;
        }

        .navbar-nav.ms-auto .nav-item.dropdown > .nav-link {
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            padding: 8px 16px !important;
            background: rgba(255,255,255,0.1);
            border-radius: 20px !important;
            transition: all 0.3s ease !important;
            white-space: nowrap;
            gap: 8px;
        }

        .navbar-nav.ms-auto .dropdown-menu {
            position: absolute !important;
            right: 0 !important;
            left: auto !important;
            margin-top: 8px;
            min-width: 240px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.1);
            background: rgba(33, 37, 41, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            z-index: 9200;
            padding: 0.8rem;
        }

        .nav-link.btn-register-guest {
            background: rgba(255,255,255,0.2);
            color: white !important;
            border-radius: 20px;
            padding: 0.5rem 1.2rem;
            margin-left: 0.5rem;
            transition: all 0.3s ease;
        }

        .nav-link.btn-register-guest:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-2px);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="bi bi-mortarboard-fill me-2"></i>
                ProjetoTrilhas
            </a>

            <!-- Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Items -->
            <div class="collapse navbar-collapse" id="navbarNav">
                @auth
                    <!-- Left Side - Register Button -->
                    @if(Auth::user()->role_id === 1)
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a href="{{ route('admin.register') }}" class="nav-link btn-register">
                                    <i class="bi bi-person-plus-fill me-1"></i>
                                    Novo Usuário
                                </a>
                            </li>
                        </ul>
                    @else
                        <div class="navbar-nav me-auto"><!-- Empty space holder --></div>
                    @endif

                    <!-- Center - Admin Menu -->
                    <div class="center-section">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle admin-gear-btn" href="#" data-bs-toggle="dropdown">
                                    <i class="bi bi-gear-fill"></i>
                                    
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    {{-- Show Resumos for all users --}}
                                    <li>
                                        <a href="{{route('admin.resumo.index')}}" class="dropdown-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-text me-2" viewBox="0 0 16 16">
                                                <path d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                                                <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                                            </svg>
                                            <span>Resumos</span>
                                        </a>
                                    </li>
                                
                                    {{-- Show TCC and other items for Admin and Coordenador --}}
                                    @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    <li>
                                        <a href="{{route('admin.tcc.index')}}" class="dropdown-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-text me-2" viewBox="0 0 16 16">
                                                <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z"/>
                                                <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                                            </svg>
                                            <span>TCC's</span>
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a href="{{route('admin.curso.index')}}" class="dropdown-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book me-2" viewBox="0 0 16 16">
                                                <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                                            </svg>
                                            <span>Cursos</span>
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a href="{{route('admin.bolsa.index')}}" class="dropdown-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet2 me-2" viewBox="0 0 16 16">
                                                <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"/>
                                            </svg>
                                            <span>Bolsas</span>
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a href="{{route('admin.projeto.index')}}" class="dropdown-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-kanban me-2" viewBox="0 0 16 16">
                                                <path d="M13.5 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-11a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h11zm-11-1a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2h-11z"/>
                                                <path d="M6.5 3a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3zm-4 0a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3zm8 0a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3z"/>
                                            </svg>
                                            <span>Projetos</span>
                                        </a>
                                    </li>
                                    @endif
                                
                                    {{-- Show Provas only for Admin --}}
                                    @if(Auth::user()->role_id == 1)
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a href="{{route('admin.prova.index')}}" class="dropdown-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-check me-2" viewBox="0 0 16 16">
                                                <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                                <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                                            </svg>
                                            <span>Provas</span>
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <!-- Right Side - User Menu -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                                <li class="px-3 py-2 text-center">
                                    <small class="text-muted">Logado como</small>
                                    <div class="fw-500">{{ Auth::user()->email }}</div>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('password.request') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-key me-2" viewBox="0 0 16 16">
                                            <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
                                            <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                        </svg>
                                        <div>
                                            <span class="fw-500">Alterar Senha</span>
                                            <small class="d-block text-muted">Atualize sua senha</small>
                                        </div>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item d-flex align-items-center text-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-box-arrow-right me-2" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                                                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                            </svg>
                                            <div>
                                                <span class="fw-500">Sair</span>
                                                <small class="d-block text-muted">Encerrar sessão</small>
                                            </div>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                @endauth
                
                @guest
                    <div class="navbar-nav me-auto"></div>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-register-guest" href="{{ route('register') }}">
                                <i class="bi bi-person-plus-fill me-1"></i> Cadastre-se
                            </a>
                        </li>
                    </ul>
                @endguest
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('header')
        @yield('conteudo')
    </div>

    <!-- Debug info - can be removed later -->
    

    <div class="modal fade" tabindex="-1" id="removeModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Operação de Remoção</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="removeModal" onclick="closeRemoveModal()"
                        aria-label="Close"></button>
                </div>
                <input type="hidden" id="id_remove">
                <div class="modal-body text-secondary">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-block align-content-center"
                        onclick="closeRemoveModal()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                            <path
                                d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z" />
                        </svg>
                        &nbsp; Não
                    </button>
                    <button type="button" class="btn btn-danger" onclick="remove()">
                        Sim &nbsp;
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" defer></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.4.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js" defer></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
    </script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <script type="text/javascript">
        function showRemoveModal(id, nome) {
            $('#id_remove').val(id);
            $('#removeModal').modal().show();
            $('.modal-body').html("Deseja remover o curso '" + nome + "'?");
        }

        function remove() {
            let id = $('#id_remove').val();
            let form = "form_" + id;
            document.getElementById(form).submit();
        }

        function closeRemoveModal() {
            $('#removeModal').modal('hide');
        }

        // Smooth navbar background change on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.background = 'rgb(33, 37, 41)';
                navbar.style.boxShadow = '0 2px 10px rgba(0,0,0,0.3)';
            } else {
                navbar.style.background = 'rgba(33, 37, 41, 0.95)';
                navbar.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
            }
        });
    </script>
</body>

</html>