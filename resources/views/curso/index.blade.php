@extends('layouts.site')

@section('title', 'Cursos - Projeto Trilhas')

@section('action_button')
    @auth
        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 3)
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
                <div class="card-inner">
                    <div class="card-header">
                        <div class="icon-wrapper">
                            @if($item->imagem)
                                <div class="card-image">
                                    <img src="{{ $item->imagem }}" alt="{{ $item->nome }}">
                                </div>
                            @else
                                <i class="fas fa-graduation-cap"></i>
                            @endif
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="content-main">
                            <h3>{{ $item->nome }}</h3>
                            <p class="description" data-full-text="{{ $item->descricao }}">
                                {{ Str::limit($item->descricao, 100) }}
                                @if (strlen($item->descricao) > 100)
                                    <button class="ver-mais-btn">Ver mais...</button>
                                @endif
                            </p>
                            
                            <div class="button-row">
                                @if($item->link)
                                    <a href="{{ $item->link }}" class="btn" target="_blank">
                                        <i class="fas fa-external-link-alt"></i> Saiba mais
                                    </a>
                                @endif

                                @auth
                                    @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 3)
                                        <div class="admin-buttons">
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
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        </div>
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
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        padding: 1.5rem;
    }

    .card {
        position: relative;
        background-color: #444;
        border-radius: 6px;
        padding: 1.5rem;
        transition: transform 0.2s ease;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.1);
        height: 350px; /* Set fixed height */
        display: flex;
        flex-direction: column;
    }

    .card-inner {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .card-header {
        text-align: center;
        margin-bottom: 1rem;
    }

    .icon-wrapper {
        color: #50a050;
        font-size: 2rem;
    }

    .card-image img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 4px;
    }

    .card-content {
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .content-main {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .description {
        flex: 1;
        margin-bottom: 1rem;
    }

    .card-content h3 {
        color: #e0e0e0;
        font-size: 1.2rem;
        margin-bottom: 1rem;
    }

    .card-content p {
        color: #bbb;
        font-size: 0.9rem;
        line-height: 1.5;
    }

    .content-footer {
        margin-top: auto;
    }

    .action-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 0.5rem;
    }

    .view-buttons, .admin-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn {
        padding: 0.35rem 0.75rem;
        border-radius: 4px;
        font-size: 0.8rem;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        transition: all 0.2s ease;
        background-color: #50a050;
        color: white;
        border: none;
        cursor: pointer;
    }

    .btn-edit {
        background-color: #ffc107;
    }

    .btn-delete {
        background-color: #dc3545;
    }

    .ver-mais-btn {
        background: none;
        border: none;
        color: #50a050;
        cursor: pointer;
        padding: 0;
        font-size: 0.8rem;
        margin-left: 0.5rem;
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        color: #e0e0e0;
    }

    .empty-state i {
        color: #50a050;
        margin-bottom: 1rem;
    }

    .button-row {
        margin-top: auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 0.5rem;
    }

    .admin-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn-edit {
        background-color: #ffc107;
        padding: 0.35rem 0.5rem;
    }

    .btn-delete {
        background-color: #dc3545;
        padding: 0.35rem 0.5rem;
    }

    @media (max-width: 768px) {
        .card-container {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('additional_js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.ver-mais-btn').forEach(button => {
            button.addEventListener('click', function (e) {
                const descriptionElement = this.parentElement;
                const fullText = descriptionElement.dataset.fullText;

                if (descriptionElement.classList.contains('expanded')) {
                    descriptionElement.textContent = fullText.substring(0, 100) + '...';
                    descriptionElement.classList.remove('expanded');
                    const newButton = document.createElement('button');
                    newButton.className = 'ver-mais-btn';
                    newButton.textContent = 'Ver mais...';
                    descriptionElement.appendChild(newButton);
                } else {
                    descriptionElement.textContent = fullText;
                    descriptionElement.classList.add('expanded');
                    const newButton = document.createElement('button');
                    newButton.className = 'ver-mais-btn';
                    newButton.textContent = 'Ver menos';
                    descriptionElement.appendChild(newButton);
                }
            });
        });
    });
</script>
@endsection