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
    <title>TCCs - Projeto Trilhas</title>
</head>
<body>
    

    @extends('layouts.site')

    @section('title', 'TCCs - Projeto Trilhas')

    @section('action_button')
        @auth
            @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                <a href="{{ route('tcc.create') }}" class="add-button">
                    <i class="fas fa-plus"></i> Novo TCC
                </a>
            @endif
        @endauth
    @endsection

    @section('content')
    <div class="container">
        <section class="intro-section">
            <h2>Trabalhos de Conclusão de Curso</h2>
            <p>Explore os TCCs desenvolvidos pelos alunos do IFPR Campus Paranaguá.</p>
        </section>

        <div class="card-container">
            @foreach ($tcc as $item)
                <div class="card">
                    <div class="icon-wrapper">
                        <i class="fas fa-file-signature fa-3x"></i>
                    </div>
                    <div class="card-content">
                        <div class="content-wrapper">
                            <div class="content-main">
                                <h3>{{ $item->titulo }}</h3>
                                <p>{{ Str::limit($item->descricao, 100) }}</p>
                            </div>

                            <div class="action-bar">
                                <div class="buttons-row">
                                    @if ($item->documento)
                                        <div class="view-buttons">
                                            <a href="{{ route('site.tcc.viewPdf', $item->id) }}" class="btn" target="_blank">
                                                <i class="fas fa-eye"></i> Visualizar
                                            </a>
                                            <a href="{{ route('site.tcc.download', $item->id) }}" class="btn">
                                                <i class="fas fa-download"></i> Download
                                            </a>
                                        </div>
                                    @endif

                                    @auth
                                        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                            <div class="admin-buttons">
                                                <a href="{{ route('tcc.edit', $item->id) }}" class="btn btn-edit" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('tcc.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-delete" title="Excluir" 
                                                            onclick="return confirm('Tem certeza que deseja excluir este TCC?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>

                        <div class="badge-bar">
                            @if($item->documento)
                                <div class="documento-badge">
                                    <i class="fas fa-file-pdf"></i> PDF Disponível
                                </div>
                            @endif
                            @if($item->aluno)
                                <div class="documento-badge">
                                    <i class="fas fa-user-graduate"></i> {{ $item->aluno->nome }}
                                </div>
                            @endif
                            @if($item->curso)
                                <div class="documento-badge">
                                    <i class="fas fa-graduation-cap"></i> {{ $item->curso->nome }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($tcc->isEmpty())
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-file-signature"></i>
                </div>
                <p>Nenhum TCC disponível no momento.</p>
            </div>
        @endif
    </div>
    @endsection

    @section('additional_css')
    <style>
        .card {
            position: relative;
            padding-top: 40px;
        }

        .icon-wrapper {
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 60px;
            background-color: #444;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 4px solid #333;
        }

        .icon-wrapper i.fa-file-signature {
            color: #50a050;
        }

        .card i.fa-file-signature {
            color: #50a050;
            margin-bottom: 20px;
        }

        .content-main {
            text-align: center;
            padding: 20px 0;
        }

        .view-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-bottom: 15px;
        }

        .view-buttons .btn {
            background-color: #50a050;
            min-width: 120px;
        }

        .view-buttons .btn:hover {
            background-color: #408040;
        }

        .badge-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            justify-content: center;
            margin-top: 15px;
        }

        .documento-badge {
            background: linear-gradient(135deg, #50a050, #408040);
            font-size: 0.85em;
            padding: 6px 12px;
        }

        .empty-state {
            padding: 40px 0;
        }

        .empty-state-icon {
            color: #50a050;
            margin-bottom: 15px;
        }

        .empty-state-icon i {
            font-size: 3.5em;
        }

        .action-bar {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 15px;
            padding-top: 15px;
        }

        .buttons-row {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .admin-buttons {
            display: flex;
            gap: 8px;
        }

        .btn-edit, .btn-delete {
            width: 40px;
            height: 40px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
    @endsection
</body>
</html>