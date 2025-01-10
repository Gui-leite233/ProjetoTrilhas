@extends('templates.main', ['menu' => "home", "submenu" => "Provas"])

@section('titulo') Provas e Avaliações @endsection

@section('conteudo')

<div class="container py-4">
    <div class="row">
        <div class="col">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-dark text-white py-3">
                    <h5 class="mb-0">Provas</h5>
                </div>
                <div class="card-body">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        @foreach ($data as $item)
                            <div class="col">
                                <div class="card h-100 border-0 shadow-sm hover-shadow">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-journal-text text-primary" viewBox="0 0 16 16">
                                                    <path d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                                                    <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                                                    <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <h5 class="card-title mb-0 text-primary">{{ $item->titulo }}</h5>
                                                <small class="text-muted">ID: {{ $item->id }}</small>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <p class="card-text text-secondary">{{ $item->descricao }}</p>
                                        </div>

                                        <div class="d-flex align-items-center mb-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-mortarboard text-success me-2" viewBox="0 0 16 16">
                                                <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5Z"/>
                                                <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Z"/>
                                            </svg>
                                            <span class="text-success">{{ $item->curso->nome ?? 'Curso não informado' }}</span>
                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('prova.viewPdf', $item->id) }}" class="btn btn-dark btn-sm" title="Visualizar PDF" target="_blank">
                                                Ver PDF
                                            </a>
                                            <a href="{{ asset('storage/' . $item->documento) }}" download class="btn btn-dark btn-sm" title="Baixar PDF">
                                                Download PDF
                                            </a>
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
