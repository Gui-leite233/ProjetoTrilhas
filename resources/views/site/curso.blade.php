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
    :root {
        --primary-color: #2d5faf;
        --primary-hover: #224b8f;
        --secondary-color: #6c757d;
        --success-color: #198754;
        --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        --card-hover-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .hover-card {
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        background: #ffffff;
        overflow: hidden;
    }

    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--card-hover-shadow);
    }

    .progress-indicator {
        height: 4px;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        transition: all 0.3s ease;
    }

    .progress-indicator.available {
        background: var(--primary-color);
    }

    .progress-indicator.unavailable {
        background: var(--secondary-color);
    }

    .card-title {
        font-weight: 600;
        color: var(--primary-color);
    }

    .btn {
        padding: 0.6rem 1.2rem;
        font-weight: 500;
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-primary:hover {
        background-color: var(--primary-hover);
        border-color: var(--primary-hover);
        transform: translateY(-1px);
    }

    .text-primary {
        color: var(--primary-color) !important;
    }

    .display-5 {
        font-weight: 700;
        color: var(--primary-color);
    }

    .card {
        border-radius: 10px;
    }

    .bi {
        transition: transform 0.3s ease;
    }

    .hover-card:hover .bi {
        transform: scale(1.1);
    }
</style>
@endsection