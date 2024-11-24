@extends('templates.main', ['menu' => "home", "submenu" => "Provas"])

@section('titulo') Desenvolvimento Web @endsection

@section('conteudo')

<div class="row mb-3">
    <div class="col">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            @foreach ($data as $item)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <span class="text-success fs-10">Prova: {{ $item->titulo }}</span>
                    </h2>
                    <h2 class="accordion-header" id="flush-headingOne">
                        <span class="text-success fs-10">Descrição: {{ $item->descricao }}</span>
                    </h2>
                    <div class="accordion-body">
                        <a href="{{ asset("storage/$item->documento.pdf") }}" class="btn btn-info" download="Prova_{{ $item->titulo }}.pdf">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
                                <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h4.5L14 4.5zm-2.5-.5a.5.5 0 0 1-.5-.5V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4h-2.5z"/>
                                <path d="M5.5 4.5A1.5 1.5 0 1 1 7 6a1.5 1.5 0 0 1-1.5-1.5zM2.5 8H1a1 1 0 1 1 2 0v.5a.5.5 0 0 1-.5.5h-.5A1 1 0 1 1 3 9H2.5V8zM14 10.5a1.5 1.5 0 1 1-2-1.415V9h-.5a1 1 0 1 1 0-2H11a1 1 0 0 1 2 0v.085a1.5 1.5 0 0 1 1 1.415zM9.5 14a1.5 1.5 0 0 1-3 0v-1.5a.5.5 0 0 1 1 0V14a.5.5 0 0 1-1 0z"/>
                            </svg>
                            Download PDF
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
