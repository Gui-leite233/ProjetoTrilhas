@extends('templates.main', ['menu' => "home", "submenu" => "Tccs"])

@section('titulo') Trabalhos de Conclusão de Curso @endsection

@section('conteudo')
<div class="container py-5">
    <div class="row">
        <div class="col-12 mb-4">
            <h2 class="display-5 fw-bold text-center text-primary mb-3">Trabalhos de Conclusão de Curso</h2>
            <p class="text-muted text-center mb-5">Explore os TCCs desenvolvidos pelos nossos alunos</p>
        </div>

        <div class="col">
            <div class="row g-4">
                @foreach ($data as $item)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm hover-card">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-journal-text text-primary h4 mb-0 me-2"></i>
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
                                                            {{ $user->curso->nome }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach

                                        <div class="d-flex gap-2 mt-3">
                                            <a href="{{ route('site.tcc.viewPdf', $item->id) }}" class="btn btn-primary w-100" target="_blank">
                                                <i class="bi bi-eye me-2"></i> Visualizar
                                            </a>
                                            <a href="{{ route('site.tcc.downloadPdf', $item->id) }}" class="btn btn-outline-primary w-100">
                                                <i class="bi bi-download me-2"></i> Download
                                            </a>
                                        </div>
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
