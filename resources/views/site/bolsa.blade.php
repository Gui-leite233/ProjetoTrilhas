@extends('templates.main', ['menu' => "home", "submenu" => "Bolsas"])

@section('titulo') Gestão de Bolsas @endsection

@section('conteudo')

<div class="container py-4">
    <div class="row">
        <div class="col">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-dark text-white py-3">
                    <h5 class="mb-0">Bolsas Disponíveis</h5>
                </div>
                <div class="card-body">
                    <div class="accordion accordion-flush" id="accordionBolsas">
                        @foreach ($data as $item)
                            <div class="accordion-item border mb-3 rounded shadow-sm">
                                <div class="accordion-header p-3">
                                    <div class="d-flex flex-column gap-2">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-bookmark-star text-primary me-2"></i>
                                            <span class="text-primary fw-bold">{{ $item->titulo }}</span>
                                        </div>
                                        <div class="d-flex align-items-start">
                                            <i class="bi bi-file-text text-secondary me-2 mt-1"></i>
                                            <span class="text-secondary">{{ $item->descricao }}</span>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="bi bi-mortarboard text-primary me-2"></i>
                                            <span class="text-primary">{{ $item->curso->nome }}</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-circle-fill me-2 {{ $item->ativo ? 'text-success' : 'text-danger' }}"></i>
                                            <span class="{{ $item->ativo ? 'text-success' : 'text-danger' }}">
                                                {{ $item->ativo ? 'Ativo' : 'Inativo' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .accordion-item {
        border-color: rgba(0,0,0,.125);
    }
    .text-primary {
        color: var(--bs-primary) !important;
    }
    .text-secondary {
        color: var(--bs-secondary) !important;
    }
    .text-success {
        color: #198754 !important;
    }
    .text-danger {
        color: #dc3545 !important;
    }
    .bg-dark {
        background-color: #212529 !important;
    }
</style>

@endsection
