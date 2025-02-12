<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil - Trilhas IFPR</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/editProfile.css')}}">
</head>
<body>
    <header>
        <a href="{{ url('/') }}" style="text-decoration: none; color: inherit;">
            <div id="title">
                <img src="{{asset('img/images.png')}}" alt="Logo">
                <h1>Trilhas de aprendizagem</h1>
            </div>
        </a>
        <nav>
            <ul>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" id="botao">
                            <i class="fas fa-sign-out-alt"></i> Sair
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </header>

    <div class="profile-wrapper">
        <div class="container-fluid py-4">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <h2 class="text-white mb-4">
                        <i class="fas fa-user-circle me-2 text-success"></i>{{ __('Perfil') }}
                    </h2>

                    <div class="card bg-dark text-white mb-4 border-0 shadow">
                        <div class="card-header bg-dark border-bottom border-secondary py-3">
                            <i class="fas fa-user-edit me-2"></i>{{ __('Informações do Perfil') }}
                        </div>
                        <div class="card-body">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <div class="card bg-dark text-white mb-4 border-0 shadow">
                        <div class="card-header bg-dark border-bottom border-secondary py-3">
                            <i class="fas fa-lock me-2"></i>{{ __('Segurança') }}
                        </div>
                        <div class="card-body">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <div class="card bg-dark text-white mb-4 border-0 shadow">
                        <div class="card-header bg-dark border-bottom border-secondary py-3">
                            <i class="fas fa-exclamation-triangle me-2 text-danger"></i>{{ __('Zona de Perigo') }}
                        </div>
                        <div class="card-body">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            background-color: rgb(34, 34, 34) !important;
            min-height: 100vh;
        }

        .profile-wrapper {
            background-color: rgb(34, 34, 34);
            min-height: calc(100vh - 70px); /* Subtract header height */
            padding-bottom: 2rem;
        }

        .navbar {
            background-color: rgba(25, 135, 84, 0.95) !important;
        }

        .form-control, .form-select {
            background-color: #444;
            border: 1px solid #555;
            color: white;
        }

        .form-control:focus, .form-select:focus {
            background-color: #444;
            border-color: #50a050;
            color: white;
            box-shadow: 0 0 0 0.25rem rgba(80, 160, 80, 0.25);
        }

        .btn-primary {
            background-color: #50a050;
            border: none;
        }

        .btn-primary:hover {
            background-color: #408040;
            transform: translateY(-2px);
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-danger:hover {
            background-color: #bb2d3b;
            transform: translateY(-2px);
        }

        .text-muted {
            color: #aaa !important;
        }

        .alert {
            background-color: #444;
            border: 1px solid #555;
            color: white;
        }

        .alert-success {
            background-color: rgba(80, 160, 80, 0.2);
            border-color: #50a050;
            color: #50a050;
        }

        /* Header specific styles */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            background-color: #333;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #title {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        #title img {
            width: 50px;
            height: 50px;
            object-fit: contain;
        }

        #title h1 {
            color: white;
            margin: 0;
            font-size: 1.5rem;
        }

        nav ul {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 20px;
        }

        #botao {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        #botao:hover {
            color: #66bb66;
            background-color: rgba(102, 187, 102, 0.1);
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>