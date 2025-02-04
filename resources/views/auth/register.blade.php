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
    <title>Landing Page</title>
</head>
<body>
    <header>
        <div id="title">
            <h1>Trilhas de</h1>
            <h1>aprendizagem</h1>
        </div>

        <ul>
            <a href="#"><li><i class="fas fa-info-circle"></i> Sobre</li></a>
            <a href="#" id="inscreva-se-btn"><li><i class="fas fa-user"></i> Já tem uma conta?</li></a>
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
                      selectedRole: '{{ old('role_id', '') }}',
                      isAluno() { return this.selectedRole === '3' }
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

                <div class="radio-group">
                    <select name="role_id" id="role_id" x-model="selectedRole" required>
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

                <div class="input-group" x-show="isAluno()">
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

                <div class="input-group" x-show="isAluno()">
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
            <img src="./components/images/Design sem nome (2).png" alt="trilhas-img">
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