@extends('templates.main', ['menu' => "admin", 'submenu' => "Resumos"])

@section('titulo') Resumos @endsection

@section('conteudo')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h4 mb-0">Resumos</h2>
            @can('viewCount', App\Models\Resumo::class)
                @if($userResumoCount && $userResumoCount->resumos_count > 0)
                    <div class="mt-2">
                        <span class="badge bg-primary">
                            <i class="bi bi-file-text me-1"></i>
                            Meus Resumos: {{ $userResumoCount->resumos_count }}
                        </span>
                    </div>
                @endif
            @endcan
        </div>
        <a href="{{ route('admin.resumo.create') }}" class="btn btn-dark">
            <i class="bi bi-plus-circle me-2"></i>Novo Resumo
        </a>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
        @foreach ($data as $item)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm hover-shadow {{ $item->users->contains(Auth::id()) ? 'border-primary border-2' : '' }}">
                    <div class="card-header {{ $item->users->contains(Auth::id()) ? 'bg-primary text-white' : 'bg-dark text-white' }} py-3 d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 text-truncate" title="{{ $item->titulo }}">{{ $item->titulo }}</h5>
                        @if($item->users->contains(Auth::id()))
                            <span class="badge bg-white text-primary">Meu Resumo</span>
                        @endif
                    </div>
                    <div class="card-body d-flex flex-column">
                        @if($item->users->isNotEmpty())
                            <div class="mb-3">
                                <h6 class="text-muted mb-2">
                                    <i class="bi bi-people-fill me-2"></i>Alunos
                                </h6>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($item->users as $user)
                                        <div class="card bg-light border-0">
                                            <div class="card-body p-2">
                                                <small class="text-dark">
                                                    <i class="bi bi-person me-1"></i>
                                                    {{ $user->nome }}
                                                    @if($user->curso)
                                                        <span class="text-muted">
                                                            ({{ $user->curso->nome }})
                                                        </span>
                                                    @endif
                                                </small>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        
                        <div class="flex-grow-1">
                            <p class="card-text" style="height: 4.5em; overflow: hidden;">
                                {{ Str::limit($item->descricao, 120) }}
                            </p>
                        </div>
                        
                        <div class="mt-auto">
                            @if ($item->documento)
                                <span class="badge bg-success">
                                    <i class="bi bi-file-pdf me-1"></i>
                                    PDF Disponível
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer bg-light border-0">
                        <div class="d-flex justify-content-end gap-2">
                            @if ($item->documento)
                                <a href="{{ route('admin.resumo.viewPdf', $item->id) }}" class="btn btn-dark btn-sm" target="_blank">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.resumo.download', $item->id) }}" class="btn btn-dark btn-sm">
                                    <i class="bi bi-download"></i>
                                </a>
                            @endif
                            
                            @can('manage', $item)
                                <a href="{{ route('admin.resumo.edit', $item->id) }}" class="btn btn-dark btn-sm">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.resumo.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" 
                                        onclick="return confirm('Tem certeza que deseja excluir este resumo?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if($data->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-folder-x display-1 text-muted"></i>
            <p class="h4 text-muted mt-3">Nenhum Resumo encontrado</p>
            <a href="{{ route('admin.resumo.create') }}" class="btn btn-dark mt-3">
                <i class="bi bi-plus-circle me-2"></i>Criar Primeiro Resumo
            </a>
        </div>
    @endif
</div>

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
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .text-center.py-5 .bi {
            animation: emptyStatePulse 2s infinite;
        }

        /* Enhance the owner indicator styles */
        .card.border-primary {
            position: relative;
            overflow: hidden;
        }

        .card.border-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #0d6efd, #0dcaf0);
        }

        .badge {
            font-size: 0.75rem;
            padding: 0.35em 0.65em;
            transition: all 0.3s ease;
        }

        .card:hover .badge {
            transform: scale(1.05);
        }
    </style>
@endpush
@endsection
