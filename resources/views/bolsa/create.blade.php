@extends('templates.main', ['menu' => "admin", 'submenu' => "Nova Bolsa"])

@section('titulo') Nova Bolsa @endsection

@section('conteudo')
<div class="container py-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h4 class="card-title mb-0 d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-wallet2 me-2" viewBox="0 0 16 16">
                            <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"/>
                        </svg>
                        Nova Bolsa
                    </h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.bolsa.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">TÍTULO</label>
                            <input type="text" class="form-control @if($errors->has('titulo')) is-invalid @endif" name="titulo"
                                placeholder="Título" value="{{ old('titulo') }}" />
                            @if ($errors->has('titulo'))
                                <div class='invalid-feedback'>
                                    {{ $errors->first('titulo') }}
                                </div>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">DESCRIÇÃO</label>
                            <textarea type="text" class="form-control @if($errors->has('descricao')) is-invalid @endif"
                                name="descricao" placeholder="Descrição" style="min-height: 100px">{{ old('descricao') }}</textarea>
                            @if ($errors->has('descricao'))
                                <div class='invalid-feedback'>
                                    {{ $errors->first('descricao') }}
                                </div>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">CURSO</label>
                            <select class="form-control @if($errors->has('curso_id')) is-invalid @endif" name="curso_id">
                                <option value="">Selecione o curso</option>
                                @foreach($cursos as $id => $nome)
                                    <option value="{{ $id }}" {{ old('curso_id') == $id ? 'selected' : '' }}>
                                        {{ $nome }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('curso_id'))
                                <div class='invalid-feedback'>
                                    {{ $errors->first('curso_id') }}
                                </div>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">STATUS</label>
                            <select class="form-control @if($errors->has('ativo')) is-invalid @endif" name="ativo">
                                <option value="1" {{ old('ativo', '1') == '1' ? 'selected' : '' }}>Ativo</option>
                                <option value="0" {{ old('ativo') == '0' ? 'selected' : '' }}>Inativo</option>
                            </select>
                            @if ($errors->has('ativo'))
                                <div class='invalid-feedback'>
                                    {{ $errors->first('ativo') }}
                                </div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.bolsa.index') }}" class="btn btn-secondary btn-block align-content-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z" />
                                </svg>
                                &nbsp; Voltar
                            </a>
                            <button type="submit" class="btn btn-success btn-block align-content-center">
                                Confirmar &nbsp;
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection