@extends('layouts.site')

@section('title', 'Projetos - Projeto Trilhas')

@section('action_button')
    @auth
        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
            <a href="{{ route('admin.projeto.create') }}" class="add-button">
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
                    <h3>{{ $item->titulo }}</h3>
                    <p>{{ Str::limit($item->descricao, 100) }}</p>
                    
                    @if($item->users->isNotEmpty())
                        <div class="documento-badge participants-badge">
                            <i class="fas fa-users"></i> {{ $item->users->count() }} participante(s)
                        </div>
                    @endif
                    @if($item->aluno)
                        <div class="documento-badge aluno-badge">
                            <i class="fas fa-user-graduate"></i> {{ $item->aluno->nome }}
                        </div>
                    @endif
                    @if($item->curso)
                        <div class="documento-badge curso-badge">
                            <i class="fas fa-graduation-cap"></i> {{ $item->curso->nome }}
                        </div>
                    @endif

                    <div class="card-actions">
                        @auth
                            @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                <a href="{{ route('admin.projeto.edit', $item->id) }}" class="btn btn-edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.projeto.destroy', $item->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete" onclick="return confirm('Tem certeza que deseja excluir este projeto?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if($data->isEmpty())
        <div class="empty-state">
            <i class="fas fa-project-diagram fa-4x"></i>
            <p>Nenhum projeto disponível no momento.</p>
        </div>
    @endif
</div>
@endsection

@section('additional_css')
<style>
    // ...existing card container and basic card styles...

    .participants-badge {
        background: linear-gradient(135deg, #4a90e2, #357abd);
    }

    .aluno-badge {
        background: linear-gradient(135deg, #50a050, #408040);
    }

    .curso-badge {
        background: linear-gradient(135deg, #f39c12, #d35400);
    }

    .documento-badge {
        display: inline-block;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        margin: 5px 0;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .intro-section {
        margin-bottom: 2rem;
        text-align: center;
        padding: 2rem 0;
    }

    .intro-section h2 {
        font-size: 2.5rem;
        color: #4a90e2;
        margin-bottom: 1rem;
    }

    .intro-section p {
        color: #666;
        font-size: 1.1rem;
    }

    .card-actions {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.25rem 0.5rem;
        font-size: 0.7rem;
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

    // ...existing animation styles...
</style>
@endsection