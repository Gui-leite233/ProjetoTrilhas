@extends('templates.main', ['menu' => "home", "submenu" => "Alunos"])

@section('titulo') Lista de Alunos @endsection

@section('conteudo')

<div class="row mb-3">
    <div class="col">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            @foreach ($data as $aluno)
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <span class="text-primary fs-6">Ano: {{ $aluno->ano }}</span>
                    </h2>
                    <h2 class="accordion-header">
                        <span class="text-success fs-6">Usuário: {{ $aluno->usuario->name ?? 'Não informado' }}</span>
                    </h2>
                    <h2 class="accordion-header">
                        <span class="text-secondary fs-6">Curso: {{ $aluno->curso->nome ?? 'Não informado' }}</span>
                    </h2>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection