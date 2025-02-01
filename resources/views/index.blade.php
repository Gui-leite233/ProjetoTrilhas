@extends('templates.main', ['menu' => "Home ", "submenu" => "Principal"])

@section('title') Desenvolvimento Web @endsection

@section('conteudo')
<div class="container py-5">
    <div class="row g-4">
        <div class="col-md-6 col-lg-3">
            <div class="feature-card">
                <div class="card h-100 border-0 shadow-hover">
                    <div class="card-header text-white bg-gradient py-3">
                        <h5 class="card-title mb-0 text-center">Cursos</h5>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <a href="{{route('site.curso')}}" class="text-decoration-none">
                            <div class="text-center feature-content">
                                <div class="feature-icon">
                                    <i class="bi bi-book-half"></i>
                                </div>
                                <p class="text-dark mb-0 mt-3">Cursos</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="feature-card">
                <div class="card h-100 border-0 shadow-hover">
                    <div class="card-header text-white bg-gradient py-3">
                        <h5 class="card-title mb-0 text-center">Provas</h5>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <a href="{{route('site.prova')}}" class="text-decoration-none">
                            <div class="text-center feature-content">
                                <div class="feature-icon">
                                    <i class="bi bi-file-text"></i>
                                </div>
                                <p class="text-dark mb-0 mt-3">Provas</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="feature-card">
                <div class="card h-100 border-0 shadow-hover">
                    <div class="card-header text-white bg-gradient py-3">
                        <h5 class="card-title mb-0 text-center">TCCs</h5>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <a href="{{route('site.tcc')}}" class="text-decoration-none">
                            <div class="text-center feature-content">
                                <div class="feature-icon">
                                    <i class="bi bi-journal-text"></i>
                                </div>
                                <p class="text-dark mb-0 mt-3">TCCs</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="feature-card">
                <div class="card h-100 border-0 shadow-hover">
                    <div class="card-header text-white bg-gradient py-3">
                        <h5 class="card-title mb-0 text-center">Resumos</h5>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <a href="{{route('site.resumo')}}" class="text-decoration-none">
                            <div class="text-center feature-content">
                                <div class="feature-icon">
                                    <i class="bi bi-journal-text"></i>
                                </div>
                                <p class="text-dark mb-0 mt-3">Resumos</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="feature-card">
                <div class="card h-100 border-0 shadow-hover">
                    <div class="card-header text-white bg-gradient py-3">
                        <h5 class="card-title mb-0 text-center">Bolsas</h5>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <a href="{{route('site.bolsa')}}" class="text-decoration-none">
                            <div class="text-center feature-content">
                                <div class="feature-icon">
                                    <i class="bi bi-wallet2"></i>
                                </div>
                                <p class="text-dark mb-0 mt-3">Bolsas</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="feature-card">
                <div class="card h-100 border-0 shadow-hover">
                    <div class="card-header text-white bg-gradient py-3">
                        <h5 class="card-title mb-0 text-center">Projetos</h5>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <a href="{{route('site.projeto')}}" class="text-decoration-none">
                            <div class="text-center feature-content">
                                <div class="feature-icon">
                                    <i class="bi bi-kanban"></i>
                                </div>
                                <p class="text-dark mb-0 mt-3">Projetos</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<style>
    /* Enhanced Card Styles */
    .feature-card {
        perspective: 1000px;
        transition: all 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-10px);
    }

    .shadow-hover {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .shadow-hover:hover {
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }

    /* Gradient Background */
    .bg-gradient {
        background: linear-gradient(45deg, #212529, #343a40);
    }

    /* Feature Icon Styles */
    .feature-icon {
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: linear-gradient(45deg, rgba(33, 37, 41, 0.05), rgba(33, 37, 41, 0.1));
        margin: 0 auto;
        transition: all 0.3s ease;
    }

    .feature-icon i {
        font-size: 2.5rem;
        color: #212529;
        transition: all 0.3s ease;
    }

    .feature-card:hover .feature-icon {
        transform: scale(1.1) rotate(5deg);
        background: linear-gradient(45deg, rgba(33, 37, 41, 0.1), rgba(33, 37, 41, 0.15));
    }

    .feature-card:hover .feature-icon i {
        transform: scale(1.1);
        color: #0d6efd;
    }

    /* Content Animation */
    .feature-content {
        transition: all 0.3s ease;
    }

    .feature-content p {
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .feature-card:hover .feature-content p {
        color: #0d6efd !important;
    }

    /* Card Header Enhancement */
    .card-header {
        border: none;
        padding: 1.2rem;
    }

    .card-title {
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .feature-card {
            margin-bottom: 1rem;
        }
        
        .feature-icon {
            width: 60px;
            height: 60px;
        }

        .feature-icon i {
            font-size: 2rem;
        }
    }

    /* Hover State Animation */
    @keyframes cardFloat {
        0% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
        100% { transform: translateY(0); }
    }

    .feature-card:hover {
        animation: cardFloat 2s ease-in-out infinite;
    }
</style>
@endpush
@endsection