@extends('templates.main', ['menu' => "home", "submenu" => "Projetos"])

@section('titulo') Projetos @endsection

@section('conteudo')
<div class="container py-5">
    <div class="row">
        <div class="col-12 mb-4">
            <h2 class="display-5 fw-bold text-center text-primary mb-3">Projetos</h2>
            <p class="text-muted text-center mb-5">Explore os projetos em desenvolvimento</p>
        </div>

        <div class="col">
            <div class="row g-4">
                @foreach ($data as $item)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm hover-card">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-code-square text-primary h4 mb-0 me-2"></i>
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-1 text-primary text-truncate">{{ $item->titulo }}</h5>
                                    </div>
                                </div>

                                <div class="flex-grow-1">
                                    <p class="card-text text-secondary mb-4">{{ Str::limit($item->descricao, 120) }}</p>
                                </div>

                                @if($item->users->isNotEmpty())
                                    <div class="mt-auto">
                                        <h6 class="text-primary mb-3">Participantes:</h6>
                                        @foreach($item->users as $user)
                                            <div class="d-flex flex-column mb-3">
                                                <div class="d-flex align-items-center mb-1">
                                                    <i class="bi bi-person-badge text-primary me-2"></i>
                                                    <span class="text-primary">{{ $user->nome }}</span>
                                                </div>
                                                @if($user->curso)
                                                    <div class="d-flex align-items-center ps-4">
                                                        <i class="bi bi-mortarboard text-secondary me-2"></i>
                                                        <span class="text-secondary">
                                                            {{ $user->curso->nome }} - {{ $user->ano }}º Ano
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
