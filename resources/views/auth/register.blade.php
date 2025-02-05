<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/styles/style.css" rel="stylesheet">
    <link href="/styles/fonts.css" rel="stylesheet">
    <link href="/styles/media.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Registre-se no Trilhas</title>
</head>
<body>
    <header>
    <div id="title">
            <img src="{{asset('img/images.png')}}" alt="Logo">
            <h1>Trilhas de aprendizagem</h1>
        </div>

        <ul>
            <a href="{{ route('sobre') }}"><li><i class="fas fa-info-circle"></i> Sobre</li></a>
            <a href="{{ route('login') }}" id="inscreva-se-btn"><li><i class="fas fa-user"></i> Já tem uma conta?</li></a>
        </ul>
    </header>

    <main>
        <aside>
            <h2><span>Inscreva-se agora</span></h2>
            <h2>no Trilhas</h2>
            <p>
                Venha fazer parte de nossa comunidade de aprendizado! Cadastre-se em nosso site e descubra trilhas de aprendizagem incríveis para desenvolver novas habilidades e avançar na sua carreira.
           </p>
            <form method="POST" action="{{ route('register') }}" 
                  x-data="{ 
                      loading: false, 
                      selectedRole: null, 
                      isAluno() { 
                          console.log('Selected role:', this.selectedRole);
                          return parseInt(this.selectedRole) === 3;
                      }
                  }" 
                  @submit="loading = true">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="input-group">
                    <i class="fas fa-user-tag"></i>
                    <select name="role_id" id="role_id" x-model.number="selectedRole" required>
                        <option value="" disabled selected>Selecione uma função</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="nome" placeholder="Nome" value="{{ old('nome') }}" required>
                </div>

                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="E-mail" value="{{ old('email') }}" required>
                </div>

                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Senha" required>
                </div>

                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password_confirmation" placeholder="Confirmar Senha" required>
                </div>

                <div class="input-group" x-cloak x-show="isAluno()">
                    <i class="fas fa-book"></i>
                    <select name="curso_id" x-bind:required="isAluno()">
                        <option value="" disabled selected>Selecione um curso</option>
                        @foreach($cursos as $curso)
                            <option value="{{ $curso->id }}" {{ old('curso_id') == $curso->id ? 'selected' : '' }}>
                                {{ $curso->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="input-group" x-cloak x-show="isAluno()">
                    <i class="fas fa-calendar-alt"></i>
                    <select name="ano" x-bind:required="isAluno()">
                        <option value="" disabled selected>Selecione o ano</option>
                        @for($i = 1; $i <= 4; $i++)
                            <option value="{{ $i }}" {{ old('ano') == $i ? 'selected' : '' }}>
                                {{ $i }}º Ano
                            </option>
                        @endfor
                    </select>
                </div>

                <button type="submit" :disabled="loading">
                    <span x-show="!loading">Enviar ></span>
                    <span x-show="loading">Processando...</span>
                </button>
            </form>
        </aside>

        <article>
            <img src="{{ asset('img/Design sem nome (2).png') }}" alt="trilhas-img">
        </article>
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
        [x-cloak] { display: none !important; }

        /* Fix animations and timing */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Ensure form elements are visible initially */
        .input-group {
            opacity: 1;
            animation: fadeInUp 0.3s ease-out;
        }

        /* Adjust animation delays */
        .input-group:nth-child(1) { animation-delay: 0s; }
        .input-group:nth-child(2) { animation-delay: 0.1s; }
        .input-group:nth-child(3) { animation-delay: 0.2s; }
        .input-group:nth-child(4) { animation-delay: 0.3s; }
        .input-group:nth-child(5) { animation-delay: 0.4s; }

        /* Fix button styles */
        button {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            color: white !important;
        }

        button span {
            color: white !important;
        }

        /* Smooth transition for conditional fields */
        [x-show="isAluno()"] {
            transition: all 0.3s ease-in-out;
        }

        /* Button hover effect */
        button:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        button:active:not(:disabled) {
            transform: translateY(0);
        }

        /* Input focus effect */
        .input-group input:focus,
        .input-group select:focus {
            transition: all 0.2s ease;
            transform: scale(1.01);
        }

        /* Error message animation */
        .alert {
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
    </style>
</body>
</html>