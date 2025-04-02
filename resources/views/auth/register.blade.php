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
    <style>
        .role-indicator {
            color: #4a90e2;
            font-size: 1.2em;
            margin-bottom: 20px;
            font-style: italic;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <div id="title">
            <a href="{{ route('home') }}" class="title-link">
                <h1>Trilhas de aprendizagem</h1>
            </a>
        </div>

        <nav>
            <ul class="nav-links">
                <li><a href="{{ route('sobre') }}"><i class="fas fa-info-circle"></i> Sobre</a></li>
                <li><a href="{{ route('login') }}" class="login-btn"><i class="fas fa-user"></i> Já tem uma conta?</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <aside>
            <h2><span>Inscreva-se agora</span></h2>
            <h2>no Trilhas</h2>
            <div class="role-indicator" x-data="{ 
                getRoleName() {
                    const roleId = {{ auth()->check() && auth()->user()->role_id === 1 ? 'this.selectedRole' : '3' }};
                    switch(parseInt(roleId)) {
                        case 1: return 'Administrador';
                        case 2: return 'Professor';
                        case 3: return 'Aluno';
                        default: return 'Usuário';
                    }
                }
            }" x-text="'Registrando como: ' + getRoleName()">
            </div>
            <p>
                Venha fazer parte de nossa comunidade de aprendizado! Cadastre-se em nosso site e descubra trilhas de aprendizagem incríveis para desenvolver novas habilidades e avançar na sua carreira.
           </p>
            <form method="POST" action="{{ route('register') }}" x-data="{ 
                selectedRole: {{ auth()->check() && auth()->user()->role_id === 1 ? 'null' : '3' }}, 
                isAluno() { return parseInt(this.selectedRole) === 3; }
            }">
                @csrf <!-- Make sure this line is present and immediately after form opening -->
                
                <!-- Add error messages display -->
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Role Selection (Only for admin) -->
                @if(auth()->check() && auth()->user()->role_id === 1)
                    <div class="input-group">
                        <select name="role_id" x-model="selectedRole" required>
                            <option value="" disabled selected>Selecione o tipo de usuário</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @else
                    <input type="hidden" name="role_id" value="3">
                @endif

                <!-- Nome -->
                <div class="input-group">
                    <input type="text" name="nome" value="{{ old('nome') }}" required placeholder="Nome completo">
                </div>

                <!-- Email -->
                <div class="input-group">
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="Email">
                </div>

                <!-- Password -->
                <div class="input-group">
                    <input type="password" name="password" required placeholder="Senha">
                </div>

                <!-- Confirm Password -->
                <div class="input-group">
                    <input type="password" name="password_confirmation" required placeholder="Confirmar senha">
                </div>

                <!-- Course and Year (Only for students) -->
                <div x-show="isAluno()">
                    <div class="input-group">
                        <select name="curso_id" x-bind:required="isAluno()">
                            <option value="" disabled selected>Selecione um curso</option>
                            @foreach($cursos as $curso)
                                <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group">
                        <select name="ano" x-bind:required="isAluno()">
                            <option value="" disabled selected>Selecione o ano</option>
                            @for($i = 1; $i <= 4; $i++)
                                <option value="{{ $i }}">{{ $i }}º Ano</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <button type="submit">Registrar</button>
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
</body>
</html>