@extends('layouts.site')

@section('title', 'Projetos - Projeto Trilhas')

@section('action_button')
    @auth
        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
            <a href="{{ route('projeto.create') }}" class="add-button">
                <i class="fas fa-plus"></i> Novo Projeto
            </a>
        @endif
    @endauth
@endsection

@section('content')
<div class="container">
    <section class="intro-section">
        <h2>Projetos</h2>
        <p>Conheça os projetos desenvolvidos em nossa instituição.</p>
    </section>

    <div class="card-container">
        @foreach ($data as $item)
            <div class="card">
                <i class="fas fa-project-diagram fa-3x"></i>
                <div class="card-content">
                    <div class="content-wrapper">
                        <div class="content-main">
                            <h3>{{ $item->titulo }}</h3>
                            <p>{{ Str::limit($item->descricao, 100) }}</p>
                        </div>

                        <div class="action-bar">
                            <div class="buttons-row">
                                @auth
                                    @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        <div class="admin-buttons">
                                            <a href="{{ route('projeto.edit', $item->id) }}" class="btn btn-edit" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('projeto.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-delete" title="Excluir" 
                                                        onclick="return confirm('Tem certeza que deseja excluir este projeto?')">
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
                        @if($item->users->isNotEmpty())
                            <div class="documento-badge">
                                <i class="fas fa-users"></i> {{ $item->users->count() }} participante(s)
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

    @if($data->isEmpty())
        <div class="empty-state">
            <div class="empty-state-icon">
                <i class="fas fa-project-diagram"></i>
            </div>
            <p>Nenhum projeto disponível no momento.</p>
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

    .card-content {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .content-wrapper {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .content-main {
        flex: 1;
        margin-bottom: 15px;
    }

    .action-bar {
        padding: 15px 0;
        border-top: 1px solid #eee;
    }

    .badge-bar {
        padding-top: 15px;
        border-top: 1px solid #eee;
        margin-top: auto;
    }

    .buttons-row {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
    }

    .admin-buttons {
        display: flex;
        gap: 8px;
    }

    .documento-badge {
        background-color: #50a050;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        margin-right: 8px;
    }

    .empty-state {
        text-align: center;
        padding: 50px 0;
        color: #666;
    }

    .empty-state-icon {
        font-size: 4em;
        color:rgb(58, 181, 60);
        margin-bottom: 20px;
    }

    .btn {
        padding: 6px 12px;
        border-radius: 4px;
        color: white;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .btn-edit {
        background-color: #ffc107;
    }

    .btn-delete {
        background-color: #dc3545;
        border: none;
        cursor: pointer;
    }
</style>
@endsection