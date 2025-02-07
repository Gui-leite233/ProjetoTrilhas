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
            <a href="{{ route('home') }}">
                <h1>Trilhas de aprendizagem</h1>
                
            </a>
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
                      selectedRole: {{ auth()->check() && auth()->user()->role_id === 1 ? 'null' : '3' }}, 
                      isAluno() { 
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

                <div class="input-group role-selection">
                    <div class="radio-group">
                        @if(auth()->check() && auth()->user()->role_id === 1)
                            @foreach($roles as $role)
                                <label>
                                    <input type="radio" 
                                           name="role_id" 
                                           value="{{ $role->id }}" 
                                           x-model.number="selectedRole" 
                                           {{ old('role_id') == $role->id ? 'checked' : '' }}
                                           required>
                                    {{ $role->name }}
                                </label>
                            @endforeach
                        @else
                            <label>
                                <input type="radio" 
                                       name="role_id" 
                                       value="3" 
                                       x-model.number="selectedRole" 
                                       checked
                                       required>
                                Aluno
                            </label>
                        @endif
                    </div>
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
        /* Updated header styles */
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 30px;
            background-color: #333;
            box-shadow: 0 2px 4px rgba(0,0,0,0.08);
        }

        header ul {
            display: flex;
            gap: 20px;
            align-items: center;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        header ul a {
            text-decoration: none;
            color: white;
        }

        header ul a li {
            padding: 8px 16px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        header ul a:not(#inscreva-se-btn):hover li {
            background: rgba(255, 255, 255, 0.1);
        }

        #inscreva-se-btn li {
            background: #007bff;
            transition: background 0.2s ease;
        }

        #inscreva-se-btn:hover li {
            background: #0056b3;
        }

        /* Existing styles */
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

        /* Add these new styles */
        .role-selection {
            margin-bottom: 20px;
        }

        .radio-group {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .radio-label {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 10px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .radio-label:hover {
            border-color: #007bff;
            background: #f8f9fa;
        }

        .radio-label input[type="radio"] {
            position: absolute;
            opacity: 0;
        }

        .radio-label input[type="radio"]:checked + .radio-text {
            color: #007bff;
        }

        .radio-label input[type="radio"]:checked + .radio-text i {
            color: #007bff;
        }

        .radio-label:has(input[type="radio"]:checked) {
            border-color: #007bff;
            background: #f0f7ff;
        }

        .radio-text {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #495057;
            font-weight: 500;
        }

        .radio-text i {
            font-size: 1.1rem;
            color: #6c757d;
        }

        /* Role Selection Styles */
        .role-selection {
            margin: 20px 0;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .role-group-label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: #2b2b2b;
            text-align: center;
        }

        .radio-group {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 10px;
        }

        .radio-label {
            position: relative;
            display: flex;
            align-items: center;
            padding: 12px 25px;
            background: white;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            min-width: 140px;
            justify-content: center;
        }

        .radio-label:hover {
            border-color: #007bff;
        }

        .radio-label input[type="radio"] {
            position: absolute;
            opacity: 0;
        }

        .radio-custom {
            position: absolute;
            left: 10px;
            width: 20px;
            height: 20px;
            border: 2px solid #dee2e6;
            border-radius: 50%;
            transition: all 0.2s ease;
        }

        .radio-label input[type="radio"]:checked ~ .radio-custom {
            border-color: #007bff;
            background: #007bff;
            box-shadow: inset 0 0 0 4px white;
        }

        .radio-label input[type="radio"]:checked ~ .radio-text {
            color: #007bff;
        }

        .radio-text {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #495057;
            font-weight: 500;
            font-size: 1rem;
        }

        .radio-text i {
            font-size: 1.2rem;
        }

        .radio-label input[type="radio"]:checked + .radio-label {
            border-color: #007bff;
            background: #f0f7ff;
        }

        /* Make sure these styles don't conflict with other elements */
        .input-group.role-selection {
            background: transparent;
            border: none;
            box-shadow: none;
        }

        /* Simplified Radio Button Styles */
        .role-selection {
            margin: 20px 0;
            text-align: center;
        }

        .radio-group {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin: 10px 0;
        }

        .radio-group label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            padding: 10px 20px;
            border-radius: 5px;
            transition: all 0.2s ease;
            color: #495057;
        }

        .radio-group label:hover {
            background-color: #f8f9fa;
            color: #007bff;
        }

        .radio-group input[type="radio"] {
            margin-right: 5px;
        }

        .radio-group input[type="radio"]:checked + i {
            color: #007bff;
        }

        .radio-group label:has(input[type="radio"]:checked) {
            color: #007bff;
            background-color: #e7f1ff;
        }

        .radio-group i {
            font-size: 1.1rem;
            color: #6c757d;
            transition: color 0.2s ease;
        }

        /* Remove any conflicting styles */
        .role-selection {
            background: transparent;
            padding: 0;
        }
    </style>
</body>
</html>