@extends('templates.main', ['menu' => "home", "submenu" => "Provas"])

@section('titulo') Provas e Avaliações @endsection

@section('conteudo')
<div class="container py-5">
    <div class="row">
        <div class="col-12 mb-4">
            <h2 class="display-5 fw-bold text-center text-primary mb-3">Provas e Avaliações</h2>
            <p class="text-muted text-center mb-5">Acesse as provas e avaliações disponíveis</p>
        </div>

        <div class="col">
            <div class="row g-4">
                @foreach ($data as $item)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm hover-card">
                            <div class="card-body d-flex flex-column">
                                <div class="ribbon-wrapper">
                                    <div class="ribbon bg-primary">{{ $item->curso->nome ?? 'Geral' }}</div>
                                </div>

                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-file-text text-primary h4 mb-0 me-2"></i>
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-1 text-primary text-truncate">{{ $item->titulo }}</h5>
                                        <div class="text-muted small">ID: {{ $item->id }}</div>
                                    </div>
                                </div>

                                <div class="flex-grow-1">
                                    <p class="card-text text-secondary mb-4">{{ Str::limit($item->descricao, 120) }}</p>
                                </div>

                                <div class="mt-auto">
                                    <div class="d-flex gap-2 mt-auto">
                                        <a href="{{ route('prova.viewPdf', $item->id) }}" class="btn btn-primary w-100 d-flex align-items-center justify-content-center" target="_blank">
                                            <i class="bi bi-eye me-2"></i> Visualizar
                                        </a>
                                        <a href="{{ asset('storage/' . $item->documento) }}" download class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center">
                                            <i class="bi bi-download me-2"></i> Download
                                        </a>
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

<style>
    .hover-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
    }
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .ribbon-wrapper {
        position: absolute;
        top: 0;
        right: 0;
    }
    .ribbon {
        padding: 0.5rem 2rem;
        color: white;
        font-size: 0.8rem;
        transform: rotate(45deg) translate(2rem, -2rem);
        background-color: var(--bs-primary) !important;
    }
    .icon-box {
        transition: transform 0.3s ease;
    }
    .hover-card:hover .icon-box {
        transform: scale(1.1);
    }
    .text-primary {
        color: var(--bs-primary) !important;
    }
    .btn-primary {
        background-color: var(--bs-primary);
        border-color: var(--bs-primary);
    }
    .btn-outline-primary {
        border-color: var(--bs-primary);
        color: var(--bs-primary);
    }
    .btn-outline-primary:hover {
        background-color: var(--bs-primary);
        color: #fff;
    }
</style>
@endsection
