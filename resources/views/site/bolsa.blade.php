@extends('templates.main', ['menu' => "home", "submenu" => "Bolsas"])

@section('titulo') Gestão de Bolsas @endsection

@section('conteudo')
<div class="container py-5">
    <div class="row">
        <div class="col-12 mb-4">
            <h2 class="display-5 fw-bold text-center text-primary mb-3">Bolsas Disponíveis</h2>
            <p class="text-muted text-center mb-5">Confira as oportunidades de bolsas</p>
        </div>

        <div class="col">
            <div class="row g-4">
                @foreach ($data as $item)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm hover-card">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-bookmark-star text-primary h4 mb-0 me-2"></i>
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-1 text-primary text-truncate">{{ $item->titulo }}</h5>
                                    </div>
                                </div>

                                <div class="flex-grow-1">
                                    <p class="card-text text-secondary mb-4">{{ Str::limit($item->descricao, 120) }}</p>
                                </div>

                                <div class="mt-auto">
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
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@include('site.shared.styles')
@endsection
