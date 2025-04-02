<a href="{{ url('/') }}" class="title-link">
    <div id="title">
        <img src="{{asset('img/images.png')}}" alt="Logo IFPR" loading="lazy">
        <h1>Trilhas de <span class="highlight">Aprendizagem</span></h1>
    </div>
</a>

<nav class="nav-menu">
    <nav class="nav-menu">
        <ul class="nav-links">

            <li class="nav-item-dropdown">
                <a href="#" class="dropdown-trigger">
                    <i class="fas fa-info-circle"></i> Informações
                    <i class="fas fa-chevron-down"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('sobre') }}"><i class="fas fa-info-circle"></i> Sobre</a></li>
                    <li><a href="{{ route('contato') }}"><i class="fas fa-envelope"></i> Contato</a></li>
                </ul>
            </li>

            @if(Auth::check())
                <li class="nav-item-dropdown">
                    <a href="#" class="dropdown-trigger">
                        <i class="fas fa-user-circle"></i> {{ Auth::user()->nome }}
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                        @if(Auth::user()->role_id === 1)
                            <li><a href="{{ route('coordinator.register') }}"><i class="fas fa-user-plus"></i> Novo Usuário</a>
                            </li>
                            <li><a href="/admin"><i class="fas fa-solar-panel"></i> Admin Dashboard</a></li>
                        @endif
                    </ul>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="logout-form">
                        @csrf
                        <button type="submit" class="nav-button logout-button">
                            <i class="fas fa-sign-out-alt"></i> Sair
                        </button>
                    </form>
                </li>
            @else
                <li class="nav-item-dropdown">
                    <a href="#" class="dropdown-trigger">
                        <i class="fas fa-user"></i> Conta
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                        <li><a href="{{ route('register') }}"><i class="fas fa-user-plus"></i> Registrar</a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </nav>
</nav>