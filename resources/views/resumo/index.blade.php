@extends('layouts.main')

@section('title', 'Resumos - Projeto Trilhas')

@section('action_button')
    @auth
        <a href="{{ route('resumo.create') }}" class="add-button">
            <i class="fas fa-plus"></i> Novo Resumo
        </a>
    @endauth
@endsection

@section('content')
<div class="container">
    <section class="intro-section">
        <h2>Resumos</h2>
        <p>Explore os resumos compartilhados pela nossa comunidade acadêmica.</p>
        @auth
            <div class="my-resumes-counter">
                <i class="fas fa-star"></i>
                <span>Meus Resumos: {{ $data->filter(function($item) { 
                    return in_array(Auth::id(), $item->users->pluck('id')->toArray()); 
                })->count() }}</span>
            </div>
        @endauth
    </section>
    
    @if($data->count() > 0)
        <div class="card-container">
            @foreach ($data as $item)
                <div class="card {{ in_array(Auth::id(), $item->users->pluck('id')->toArray()) ? 'my-resume' : '' }}">
                    <div class="card-inner">
                        @if(in_array(Auth::id(), $item->users->pluck('id')->toArray()))
                            <div class="my-resume-badge">
                                <i class="fas fa-star"></i> Meu Resumo
                            </div>
                        @endif
                        
                        <div class="content-main">
                            <h3>{{ $item->titulo }}</h3>
                            
                            <div class="selected-users">
                                <i class="fas fa-users icon-group-small"></i>
                                <div class="users-list">
                                    @if($item->users->count() > 0)
                                        @foreach($item->users as $user)
                                            <span class="user-tag">
                                                <span class="user-name">{{ $user->nome }}</span>
                                                <span class="user-course">{{ $user->curso->nome ?? 'Sem curso' }}</span>
                                            </span>
                                        @endforeach
                                    @else
                                        <span class="no-users">Nenhum usuário selecionado</span>
                                    @endif
                                </div>
                            </div>

                            <p class="description">{{ Str::limit($item->descricao, 100) }}</p>
                            
                            @if ($item->documento)
                                <div class="documento-badge">
                                    <i class="fas fa-file-pdf"></i> PDF Disponível
                                </div>
                            @endif
                        </div>

                        <div class="button-row">
                            <div class="action-buttons">
                                @if ($item->documento)
                                    <a href="{{ route('site.resumo.viewPdf', $item->id) }}" class="btn">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('site.resumo.download', $item->id) }}" class="btn">
                                        <i class="fas fa-download"></i>
                                    </a>
                                @endif

                                @auth
                                    @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || in_array(Auth::id(), $item->users->pluck('id')->toArray()))
                                        <a href="{{ route('resumo.edit', $item->id) }}" class="btn btn-edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-delete" onclick="if(confirm('Tem certeza que deseja excluir este resumo?')) document.getElementById('delete-form-{{ $item->id }}').submit();">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <form id="delete-form-{{ $item->id }}" action="{{ route('resumo.destroy', $item->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-book-open fa-4x"></i>
            <p>Nenhum resumo disponível no momento.</p>
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