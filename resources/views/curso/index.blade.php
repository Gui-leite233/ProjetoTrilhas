@extends('layouts.site')

@section('title', 'Cursos - Projeto Trilhas')

@section('action_button')
    @auth
        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
            <a href="{{ route('curso.create') }}" class="add-button">
                <i class="fas fa-plus"></i> Novo Curso
            </a>
        @endif
    @endauth
@endsection

@section('content')
<div class="container">
    <section class="intro-section">
        <h2>Conheça Nossos Cursos</h2>
        <p>Explore os diversos cursos oferecidos pelo IFPR Paranaguá e descubra aquele que mais se adapta aos seus
            interesses e aspirações.</p>
    </section>

    <div class="card-container">
        @foreach ($cursos as $item)
            <div class="card">
                @if($item->imagem)
                    <div class="card-image">
                        <img src="{{ $item->imagem }}" alt="{{ $item->nome }}">
                    </div>
                @else
                    <div class="card-icon">
                        <i class="fas fa-graduation-cap fa-3x"></i>
                    </div>
                @endif
                <div class="card-content">
                    <h3>{{ $item->nome }}</h3>
                    <p>{{ Str::limit($item->descricao, 100) }}</p>
                    
                    <div class="card-actions">
                        @if($item->link)
                            <a href="{{ $item->link }}" class="btn btn-primary" target="_blank">
                                <i class="fas fa-external-link-alt"></i> Saiba mais
                            </a>
                        @endif

                        @auth
                            @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                <a href="{{ route('curso.edit', $item->id) }}" class="btn btn-edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('curso.destroy', $item->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete" onclick="return confirm('Tem certeza que deseja excluir este curso?')">
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

    @if($cursos->isEmpty())
        <div class="empty-state">
            <i class="fas fa-graduation-cap fa-4x"></i>
            <p>Nenhum curso disponível no momento.</p>
        </div>
    @endif
</div>
@endsection

@section('additional_css')
<style>
    .card-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
        padding: 2rem 0;
    }

    .card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    }

    .card-image {
        height: 200px;
        overflow: hidden;
    }

    .card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .card-icon {
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        background:rgb(11, 75, 50);
        color: #4a90e2;
    }

    .card-content {
        padding: 1.5rem;
    }

    .card-content h3 {
        color: #2d5faf;
        margin-bottom: 1rem;
        font-size: 1.25rem;
    }

    .card-content p {
        color: #666;
        margin-bottom: 1.5rem;
    }

    .card-actions {
        display: flex;
        gap: 0.5rem;
        justify-content: flex-start;
        align-items: center;
    }

    .btn {
        padding: 0.5rem 1rem;
        border-radius: 5px;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background-color: #2d5faf;
        color: white;
        text-decoration: none;
    }

    .btn-edit {
        background-color: #ffc107;
        color: white;
    }

    .btn-delete {
        background-color: #dc3545;
        color: white;
        border: none;
        cursor: pointer;
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        color: #666;
    }

    .empty-state i {
        margin-bottom: 1rem;
        color: #4a90e2;
    }
</style>
@endsection