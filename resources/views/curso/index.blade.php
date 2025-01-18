@extends('templates.main', ['menu' => "admin", 'submenu' => "Cursos", 'rota' => "curso.create"])

@section('titulo') Cursos @endsection

@section('conteudo')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 mb-0">Cursos</h2>
        <a href="{{ route('curso.create') }}" class="btn btn-dark">
            <i class="bi bi-plus-circle me-2"></i>Novo Curso
        </a>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
        @foreach ($data as $item)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm hover-shadow">
                    <div class="card-header bg-dark text-white py-3">
                        <h5 class="card-title mb-0 text-truncate" title="{{ $item->nome }}">{{ $item->nome }}</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text" style="height: 4.5em; overflow: hidden;">
                            {{ Str::limit($item->descricao, 120) }}
                        </p>
                        @if($item->link)
                            <a href="{{ $item->link }}" target="_blank" class="btn btn-outline-dark btn-sm mt-3">
                                <i class="bi bi-box-arrow-up-right me-1"></i>
                                Acessar Curso
                            </a>
                        @endif
                    </div>
                    <div class="card-footer bg-light border-0">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('curso.edit', $item->id) }}" class="btn btn-dark btn-sm">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('curso.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" 
                                    onclick="return confirm('Tem certeza que deseja excluir este curso?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if($data->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-journal-x display-1 text-muted"></i>
            <p class="h4 text-muted mt-3">Nenhum curso encontrado</p>
            <a href="{{ route('curso.create') }}" class="btn btn-dark mt-3">
                <i class="bi bi-plus-circle me-2"></i>Criar Primeiro Curso
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
        box-shadow: 0 12px 20px rgba(0,0,0,0.15) !important;
    }

    .card-header {
        border: none;
        background: linear-gradient(45deg, #212529, #343a40);
        padding: 1.2rem;
    }

    .card-title {
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    /* Link Button Style */
    .btn-outline-dark {
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    .btn-outline-dark::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #212529;
        transform: scaleY(0);
        transform-origin: bottom;
        transition: transform 0.3s ease;
        z-index: -1;
    }

    .btn-outline-dark:hover {
        color: white;
    }

    .btn-outline-dark:hover::after {
        transform: scaleY(1);
    }

    /* Action Buttons */
    .btn-group .btn {
        border-radius: 6px;
        margin: 0 2px;
        padding: 0.5rem 0.8rem;
    }

    .btn-group .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    /* Empty State Enhancement */
    .text-center.py-5 {
        background: linear-gradient(to bottom, rgba(33,37,41,0.03), rgba(33,37,41,0.02));
        border-radius: 16px;
        padding: 4rem 2rem !important;
        margin: 2rem 0;
    }

    .text-center.py-5 .bi {
        transition: all 0.5s ease;
    }

    .text-center.py-5:hover .bi {
        transform: scale(1.1) rotate(10deg);
    }
</style>
@endpush