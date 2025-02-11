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
    <link rel="stylesheet" href="{{asset('css/telaPrincipal.css')}}">
    <title>Bolsas - Projeto Trilhas</title>
</head>
<body>
    

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
                    <div class="card-content">
                        <div>
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

    
</body>
</html>