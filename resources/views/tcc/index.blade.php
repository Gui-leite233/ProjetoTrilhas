@extends('layouts.site')

@section('title', 'TCCs - Projeto Trilhas')

@section('action_button')
    <a href="{{ route('admin.tcc.create') }}" class="add-button">
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