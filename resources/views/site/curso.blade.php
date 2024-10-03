@extends('templates.main', ['menu' => "home", "submenu" => "Cursos"])

@section('titulo') Desenvolvimento Web @endsection

@section('conteudo')

<div class="row mb-3">
    <div class="col">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            @foreach ($data as $item)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                    <span class="text-success fs-10">Curso: {{ $item->nome }}</span>
                    </h2>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection