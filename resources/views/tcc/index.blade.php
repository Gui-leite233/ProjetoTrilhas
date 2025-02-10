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

    @section('title', 'TCCs - Projeto Trilhas')

    @section('action_button')
        <a href="{{ route('tcc.create') }}" class="add-button">
            <i class="fas fa-plus"></i> Novo TCC
        </a>
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
                    <i class="fas fa-file-signature fa-3x"></i>
                    <div class="card-content">
                        <h3>{{ $item->titulo }}</h3>
                        <p>{{ Str::limit($item->descricao, 100) }}</p>
                        @if ($item->documento)
                            <div class="documento-badge">
                                <i class="fas fa-file-pdf"></i> PDF Disponível
                            </div>
                        @endif
                        <div class="card-actions">
                            @if ($item->documento)
                                <a href="{{ route('site.tcc.viewPdf', $item->id) }}" class="btn" target="_blank">
                                    <i class="fas fa-eye"></i> Visualizar
                                </a>
                                <a href="{{ route('site.tcc.download', $item->id) }}" class="btn">
                                    <i class="fas fa-download"></i> Download
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($tcc->isEmpty())
            <div class="empty-state">
                <i class="fas fa-file-signature fa-4x"></i>
                <p>Nenhum TCC disponível no momento.</p>
            </div>
        @endif
    </div>
    @endsection

    @section('additional_css')
    <style>
        // ...existing style from resumo/index.blade.php...
    </style>
    @endsection
</body>
</html>