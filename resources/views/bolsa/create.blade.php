@extends('templates.main', ['menu' => "admin", 'submenu' => "Nova bolsa"])

@section('conteudo')

<form action="{{ route('bolsa.store') }}" method="POST">
    @csrf

    <div class="row">
        <div class="col">
            <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control @if($errors->has('titulo')) is-invalid @endif"
                    name="titulo"
                    placeholder="Título"
                    value="{{ old('titulo') }}" />
                <label for="titulo">Título</label>
                @if($errors->has('titulo'))
                <div class='invalid-feedback'>
                    {{ $errors->first('titulo') }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-floating mb-3">
                <textarea
                    class="form-control @if($errors->has('descricao')) is-invalid @endif"
                    name="descricao"
                    placeholder="Descrição"
                    style="min-height: 100px">{{ old('descricao') }}</textarea>
                <label for="descricao">Descrição</label>
                @if($errors->has('descricao'))
                <div class='invalid-feedback'>
                    {{ $errors->first('descricao') }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Dropdown de Cursos -->
    <div class="row">
        <div class="col">
            <div class="form-floating mb-3">
                <select
                    class="form-control @if($errors->has('curso_id')) is-invalid @endif"
                    name="curso_id">
                    <option value="">Selecione o curso</option>
                    @foreach($cursos as $id => $nome)
                    <option value="{{ $id }}" {{ old('curso_id') == $id ? 'selected' : '' }}>
                        {{ $nome }}
                    </option>
                    @endforeach
                </select>
                <label for="curso_id">Curso</label>
                @if($errors->has('curso_id'))
                <div class="invalid-feedback">
                    {{ $errors->first('curso_id') }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-floating mb-3">
                <select
                    class="form-control @if($errors->has('ativo')) is-invalid @endif"
                    name="ativo">
                    <option value="1" {{ old('ativo') == "1" ? 'selected' : '' }}>Ativo</option>
                    <option value="0" {{ old('ativo') == "0" ? 'selected' : '' }}>Inativo</option>
                </select>
                <label for="ativo">Status</label>
                @if($errors->has('ativo'))
                <div class="invalid-feedback">
                    {{ $errors->first('ativo') }}
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a href="{{ route('bolsa.index') }}" class="btn btn-secondary">
                Voltar
            </a>
            <button type="submit" class="btn btn-success">
                Confirmar
            </button>
        </div>
    </div>

</form>

@endsection