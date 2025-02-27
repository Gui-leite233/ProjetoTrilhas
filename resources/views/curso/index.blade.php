@extends('layouts.main')

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
                            <p class="description">
                                {{ $item->descricao }}
                            </p>
                            
                            <div class="button-row">
                                @if($item->link)
                                    <a href="{{ $item->link }}" class="btn btn-saiba-mais" target="_blank">
                                        <i class="fas fa-external-link-alt"></i> Saiba mais
                                    </a>
                                @endif

                                @auth
                                    @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
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

@section('scripts')
    <script src="{{ asset('js/curso/index.js') }}"></script>
@endsection