@extends('templates.main', ['menu' => "admin", 'submenu' => "Novo Projeto"])

@section('titulo') Novo Projeto @endsection

@section('conteudo')
<div class="container py-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h4 class="card-title mb-0 d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-folder-plus me-2" viewBox="0 0 16 16">
                            <path d="M.5 3l.04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.684.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z"/>
                            <path d="M13.5 10a.5.5 0 0 1 .5.5V12h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V13h-1.5a.5.5 0 0 1 0-1H13v-1.5a.5.5 0 0 1 .5-.5z"/>
                        </svg>
                        Novo Projeto
                    </h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('projeto.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">TÍTULO DO PROJETO</label>
                            <input type="text" class="form-control form-control-lg @if($errors->has('titulo')) is-invalid @endif" 
                                name="titulo" value="{{ old('titulo') }}" required>
                            @if($errors->has('titulo'))
                                <div class="invalid-feedback">{{ $errors->first('titulo') }}</div>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">DESCRIÇÃO</label>
                            <textarea class="form-control @if($errors->has('descricao')) is-invalid @endif"
                                name="descricao" rows="4" required>{{ old('descricao') }}</textarea>
                            @if($errors->has('descricao'))
                                <div class="invalid-feedback">{{ $errors->first('descricao') }}</div>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">ALUNOS</label>
                            <select name="user_ids[]" class="form-select" multiple required>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->nome }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">Pressione CTRL para selecionar múltiplos alunos</small>
                            @if($errors->has('user_ids'))
                                <div class="invalid-feedback">{{ $errors->first('user_ids') }}</div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('projeto.index') }}" class="btn btn-secondary px-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                                </svg>
                                Voltar
                            </a>
                            <button type="submit" class="btn btn-success px-4">
                                Salvar
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-lg ms-2" viewBox="0 0 16 16">
                                    <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
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
