@extends('layouts.site')

@section('title', 'Bolsas - Projeto Trilhas')

@section('action_button')
    <a href="{{ route('admin.bolsa.create') }}" class="add-button">
        <i class="fas fa-plus"></i> Nova Bolsa
    </a>
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
                <i class="fas fa-hand-holding-usd fa-3x"></i>
                <div class="card-content">
                    <h3>{{ $item->titulo }}</h3>
                    <p>{{ Str::limit($item->descricao, 100) }}</p>
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
    // ...existing style from resumo/index.blade.php...
    .curso-badge {
        background-color: #4a90e2;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        margin: 5px 0;
        display: inline-block;
    }
    .status-badge.active {
        background-color: #50a050;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        margin: 5px 0;
        display: inline-block;
    }
</style>
@endsection
