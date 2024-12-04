@extends('templates.main', ['menu' => "home", "submenu" => "Bolsas"])

@section('titulo') Gestão de Bolsas @endsection

@section('conteudo')

<div class="row mb-3">
    <div class="col">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            @foreach ($data as $item)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <span class="text-primary fs-10">Título: {{ $item->titulo }}</span>
                    </h2>
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <span class="text-secondary fs-10">Descrição: {{ $item->descricao }}</span>
                    </h2>
                    <h2 class="accordion-header" id="flush-headingThree">
                        <span class="text-success fs-10">Status: {{ $item->ativo ? 'Ativo' : 'Inativo' }}</span>
                    </h2>
                    
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
