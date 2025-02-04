@extends('templates.main', ['menu' => "admin", 'submenu' => "Cursos"])

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
        @foreach ($cursos as $item)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm hover-shadow">
                    <div class="card-header bg-dark text-white py-3">
                        <h5 class="card-title mb-0 text-truncate" title="{{ $item->nome }}">{{ $item->nome }}</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text" style="height: 4.5em; overflow: hidden;">
                            {{ Str::limit($item->descricao, 120) }}
                        </p>
                        <div class="mt-3">
                            <a href="{{ $item->link }}" class="btn btn-sm btn-outline-dark" target="_blank">
                                <i class="bi bi-link-45deg me-1"></i>Link do Curso
                            </a>
                        </div>
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

    @if($cursos->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-mortarboard-fill display-1 text-muted"></i>
            <p class="h4 text-muted mt-3">Nenhum Curso encontrado</p>
            <a href="{{ route('curso.create') }}" class="btn btn-dark mt-3">
                <i class="bi bi-plus-circle me-2"></i>Criar Primeiro Curso
            </a>
        </div>
    @endif
</div>

@push('styles')
<style>
    .hover-shadow {
        transition: transform 0.2s;
    }
    .hover-shadow:hover {
        transform: translateY(-5px);
    }
</style>
@endpush
@endsection