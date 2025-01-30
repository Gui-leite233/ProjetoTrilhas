@extends('templates.main', ['menu' => "admin", 'submenu' => "Provas", 'rota' => "admin.prova.create"])

@section('titulo') Provas @endsection

@section('conteudo')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 mb-0">Provas</h2>
        <a href="{{ route('admin.prova.create') }}" class="btn btn-dark">
            <i class="bi bi-plus-circle me-2"></i>Nova Prova
        </a>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
        @foreach ($data as $item)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm hover-shadow">
                    <div class="card-header bg-dark text-white py-3">
                        <h5 class="card-title mb-0 text-truncate" title="{{ $item->titulo }}">{{ $item->titulo }}</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text" style="height: 4.5em; overflow: hidden;">
                            {{ Str::limit($item->descricao, 120) }}
                        </p>
                        @if ($item->documento)
                            <div class="mt-3">
                                <span class="badge bg-success">
                                    <i class="bi bi-file-pdf me-1"></i>
                                    PDF Disponível
                                </span>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer bg-light border-0">
                        <div class="d-flex justify-content-end gap-2">
                            @if ($item->documento)
                                <a href="{{ route('admin.prova.viewPdf', $item->id) }}" class="btn btn-dark btn-sm" target="_blank">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.prova.download', $item->id) }}" class="btn btn-dark btn-sm">
                                    <i class="bi bi-download"></i>
                                </a>
                            @endif
                            <a href="{{ route('admin.prova.edit', $item->id) }}" class="btn btn-dark btn-sm">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('admin.prova.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" 
                                    onclick="return confirm('Tem certeza que deseja excluir esta prova?')">
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
            <i class="bi bi-file-x display-1 text-muted"></i>
            <p class="h4 text-muted mt-3">Nenhuma prova encontrada</p>
            <a href="{{ route('admin.prova.create') }}" class="btn btn-dark mt-3">
                <i class="bi bi-plus-circle me-2"></i>Criar Primeira Prova
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
</style>
@endpush