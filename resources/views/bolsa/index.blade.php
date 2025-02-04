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
                <i class="fas fa-hand-holding-usd fa-3x"></i>
                <div class="card-content">
                    <div class="content-main">
                        <h3>{{ $item->titulo }}</h3>
                        <p>{{ Str::limit($item->descricao, 100) }}</p>
                    </div>

                    <div class="content-footer">
                        <div class="badges-row">
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

                        <div class="buttons-row">
                            @auth
                                @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    <div class="action-buttons">
                                        <a href="{{ route('bolsa.edit', $item->id) }}" class="btn btn-edit" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('bolsa.destroy', $item->id) }}" method="POST">
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
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }

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

    .badges-container {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin: 12px 0;
    }

    .buttons-container {
        margin-top: 15px;
        border-top: 1px solid #eee;
        padding-top: 15px;
    }

    .action-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 8px;
    }

    .btn {
        padding: 6px 12px;
        border-radius: 4px;
        color: white;
        text-decoration: none;
        transition: all 0.2s ease;
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
    }

    .content-main {
        flex: 1;
        margin-bottom: 15px;
    }

    .content-footer {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-top: 1px solid #eee;
    }

    .badges-row {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        flex: 1;
    }

    .buttons-row {
        display: flex;
        justify-content: flex-end;
        margin-left: 15px;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }
</style>
@endsection
