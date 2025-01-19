@extends('templates.main', ['menu' => "admin", 'submenu' => "projetos", 'rota' => "projeto.create"])

@section('titulo') Projetos @endsection

@section('conteudo')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 mb-0">Projetos</h2>
        <a href="{{ route('projeto.create') }}" class="btn btn-dark">
            <i class="bi bi-plus-circle me-2"></i>Novo Projeto
        </a>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
        @foreach ($projeto as $item)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm hover-shadow">
                        <div class="card-header bg-dark text-white py-3">
                            <h5 class="card-title mb-0 text-truncate" title="{{ $item->titulo }}">{{ $item->titulo }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text text-muted small mb-3">
                                <i class="bi bi-people-fill me-2"></i>
                                @if($item->users->isNotEmpty())
                                <strong>Alunos por Curso:</strong><br>
                                @php
                                    $usersByCurso = $item->users->groupBy(function($user) {
                                        return $user->curso->nome ?? $user->aluno->curso->nome ?? 'Sem curso';
                                    });
                                @endphp
                                
                                @foreach($usersByCurso as $curso => $users)
                                    <div class="ms-4 mt-2">
                                        <span class="fw-bold text-primary">{{ $curso }}:</span>
                                        <div class="ms-2">
                                            {{ $users->pluck('nome')->join(', ') }}
                                        </div>
                                    </div>
                                @endforeach
                                @else
                                Nenhum aluno associado
                            @endif
                            </p>
                            <p class="card-text" style="height: 4.5em; overflow: hidden;">
                                {{ Str::limit($item->descricao, 120) }}
                            </p>
                        </div>
                        <div class="card-footer bg-light border-0">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('projeto.edit', $item->id) }}" class="btn btn-dark btn-sm">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('projeto.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm"
                                        onclick="return confirm('Tem certeza que deseja excluir este projeto?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        @endforeach
    </div>

    @if($projeto->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-folder-x display-1 text-muted"></i>
            <p class="h4 text-muted mt-3">Nenhum projeto encontrado</p>
            <a href="{{ route('projeto.create') }}" class="btn btn-dark mt-3">
                <i class="bi bi-plus-circle me-2"></i>Criar Primeiro Projeto
            </a>
        </div>
    @endif
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .hover-shadow {
            transition: transform 0.2s;
        }

        .hover-shadow:hover {
            transform: translateY(-5px);
        }

        /* Enhanced Card Styles */
        .card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 12px;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15) !important;
        }

        .card-header {
            border: none;
            background: linear-gradient(45deg, #212529, #343a40);
            padding: 1.2rem;
        }

        /* User List Styling */
        .text-muted.small {
            background: rgba(33, 37, 41, 0.03);
            border-radius: 8px;
            padding: 1rem;
        }

        .ms-4 {
            position: relative;
        }

        .ms-4::before {
            content: '';
            position: absolute;
            left: -1rem;
            top: 0;
            height: 100%;
            width: 2px;
            background: linear-gradient(to bottom, #0d6efd, transparent);
            border-radius: 2px;
        }

        /* Button Enhancements */
        .btn {
            transition: all 0.3s ease;
            border-radius: 8px;
            padding: 0.6rem 1rem;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-dark {
            background: linear-gradient(45deg, #212529, #343a40);
        }

        /* Empty State Animation */
        @keyframes emptyStatePulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .text-center.py-5 .bi {
            animation: emptyStatePulse 2s infinite;
        }
    </style>
@endpush