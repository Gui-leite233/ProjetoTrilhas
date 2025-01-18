@extends('templates.main', ['menu' => "home", "submenu" => "Projetos"])

@section('titulo') Projetos @endsection

@section('conteudo')

<div class="container py-4">
    <div class="row">
        <div class="col">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-dark text-white py-3">
                    <h5 class="mb-0">Projetos Disponíveis</h5>
                </div>
                <div class="card-body">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        @foreach ($data as $item)
                            <div class="col">
                                <div class="card h-100 border-0 shadow-sm hover-shadow">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="bi bi-code-square text-primary h4 mb-0 me-2"></i>
                                            <div class="flex-grow-1">
                                                <h5 class="card-title mb-0 text-primary">{{ $item->titulo }}</h5>
                                                <small class="text-muted">ID: {{ $item->id }}</small>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <p class="card-text text-secondary">{{ $item->descricao }}</p>
                                        </div>

                                        <div class="d-flex align-items-center mb-3">
                                            <i class="bi bi-person-circle text-success me-2"></i>
                                            <span class="text-success">{{ optional($item->aluno)->usuario->name ?? 'Aluno não informado' }}</span>
                                        </div>

                                        <div class="d-flex align-items-center mb-3">
                                            <i class="bi bi-mortarboard text-primary me-2"></i>
                                            <span class="text-primary">{{ optional($item->user->aluno)->curso->nome ?? 'Curso não informado' }}</span>
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
.hover-shadow {
    transition: all 0.3s ease;
}
.hover-shadow:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}
</style>

@endsection
