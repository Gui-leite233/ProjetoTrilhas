@extends('templates.main', ['menu' => "home", "submenu" => "Cursos"])

@section('titulo') Desenvolvimento Web @endsection

@section('conteudo')
<div class="container py-5">
    <div class="row">
        <div class="col-12 mb-4">
            <h2 class="display-5 fw-bold text-center text-primary mb-3">Cursos Disponíveis</h2>
            <p class="text-muted text-center mb-5">Explore nossos cursos e comece sua jornada de aprendizado</p>
        </div>

        <div class="col">
            <div class="row g-4">
                @foreach ($data as $item)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm hover-card">
                            <div class="card-body d-flex flex-column">
                                <div class="progress-indicator {{ $item->link ? 'available' : 'unavailable' }}"></div>
                                
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-book text-primary h4 mb-0 me-2"></i>
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-1 text-primary text-truncate">{{ $item->nome }}</h5>
                                        
                                    </div>
                                </div>

                                <div class="flex-grow-1">
                                    <p class="card-text text-secondary mb-4">{{ Str::limit($item->descricao, 120) }}</p>
                                </div>

                                <div class="mt-auto">
                                    @if($item->link)
                                        <a href="{{ $item->link }}" class="btn btn-primary w-100 d-flex align-items-center justify-content-center" target="_blank">
                                            <i class="bi bi-play-circle me-2"></i> Acessar Curso
                                        </a>
                                    @else
                                        <button class="btn btn-secondary w-100" disabled>
                                            <i class="bi bi-lock me-2"></i> Em breve
                                        </button>
                                    @endif
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
    .progress-indicator {
        height: 3px;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
    }
    .progress-indicator.available {
        background: var(--bs-primary);
    }
    .progress-indicator.unavailable {
        background: var(--bs-secondary);
    }
    .icon-box {
        transition: transform 0.3s ease;
    }
    .hover-card:hover .icon-box {
        transform: scale(1.1);
    }
    .btn {
        transition: all 0.3s ease;
        font-weight: 500;
        padding: 0.6rem 1rem;
    }
    .card-title {
        font-weight: 600;
        line-height: 1.3;
    }
    .text-primary {
        color: var(--bs-primary) !important;
    }
    .btn-primary {
        background-color: var(--bs-primary);
        border-color: var(--bs-primary);
    }
    .btn-secondary {
        background-color: var(--bs-secondary);
        border-color: var(--bs-secondary);
    }
</style>
@endsection