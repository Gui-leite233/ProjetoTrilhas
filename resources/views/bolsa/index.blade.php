<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/styles/style.css" rel="stylesheet">
    <link href="/styles/fonts.css" rel="stylesheet">
    <link href="/styles/media.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>Bolsas - Projeto Trilhas</title>
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
            <a href="{{ route('login') }}" id="inscreva-se-btn"><li><i class="fas fa-user"></i> Entrar</li></a>
        </ul>
    </header>

    @extends('layouts.site')

    @section('title', 'Bolsas - Projeto Trilhas')

    @section('action_button')
        @auth
            @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                <a href="{{ route('bolsa.create') }}" class="add-button">
                    <i class="fas fa-plus"></i> Nova Bolsa
                </a>
            @endif
        @endauth
    @endsection

    @section('content')
    <div class="container">
        <section class="intro-section">
            <h2>Bolsas de Estudo</h2>
            <p>Encontre oportunidades de bolsas disponíveis no IFPR Campus Paranaguá.</p>
        </section>

        <div class="card-container">
            @foreach ($data as $item)
                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-hand-holding-usd fa-3x"></i>
                    </div>
                    <div class="card-content">
                        <div class="content-main">
                            <h3>{{ $item->titulo }}</h3>
                            <p>{{ Str::limit($item->descricao, 100) }}</p>
                        </div>

                        <div class="badges-section">
                            @if($item->curso)
                                <div class="curso-badge">
                                    <i class="fas fa-graduation-cap"></i> {{ $item->curso->nome }}
                                </div>
                            @endif
                            @if($item->ativo)
                                <div class="status-badge active">
                                    <i class="fas fa-check-circle"></i> Ativo
                                </div>
                            @endif
                        </div>

                        @auth
                            @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                <div class="actions-section">
                                    <a href="{{ route('bolsa.edit', $item->id) }}" class="btn btn-edit" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('bolsa.destroy', $item->id) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete" title="Excluir" 
                                                onclick="return confirm('Tem certeza que deseja excluir esta bolsa?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>

        @if($data->isEmpty())
            <div class="empty-state">
                <i class="fas fa-hand-holding-usd fa-4x"></i>
                <p>Nenhuma bolsa disponível no momento.</p>
            </div>
        @endif
    </div>
    @endsection

    @section('additional_css')
    <style>
        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            display: flex;
            gap: 20px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }

        .card-icon {
            color: #4a90e2;
            flex-shrink: 0;
        }

        .card-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .content-main h3 {
            margin: 0 0 10px 0;
            color: #333;
        }

        .content-main p {
            color: #666;
            margin: 0;
        }

        .badges-section {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            padding: 10px 0;
            border-top: 1px solid #eee;
        }

        .curso-badge {
            background-color: #4a90e2;
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.9em;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .status-badge.active {
            background-color: #50a050;
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.9em;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .actions-section {
            display: flex;
            gap: 8px;
            padding-top: 10px;
            border-top: 1px solid #eee;
            justify-content: flex-end;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 6px;
            color: white;
            text-decoration: none;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
        }

        .btn-edit {
            background-color: #ffc107;
        }

        .btn-delete {
            background-color: #dc3545;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            opacity: 0.9;
        }

        .delete-form {
            margin: 0;
            padding: 0;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #666;
        }

        .empty-state i {
            margin-bottom: 20px;
            color: #4a90e2;
        }
    </style>
    @endsection
</body>
</html>