@extends('templates.main', ['menu' => "admin", 'submenu' => "Novo TCC"])

@section('titulo') Novo TCC @endsection

@section('conteudo')
<div class="container py-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h4 class="card-title mb-0 d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-file-text me-2" viewBox="0 0 16 16">
                            <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z"/>
                            <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                        </svg>
                        Novo TCC
                    </h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('tcc.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">TÍTULO DO TCC</label>
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
                            <select name="user_ids[]" class="form-select @if($errors->has('user_ids')) is-invalid @endif" 
                                multiple required>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->nome }} 
                                        ({{ optional($user->curso)->nome ?? 'Sem curso' }})
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Pressione CTRL para selecionar múltiplos alunos</small>
                            @if($errors->has('user_ids'))
                                <div class="invalid-feedback">{{ $errors->first('user_ids') }}</div>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">DOCUMENTO PDF</label>
                            <input type="file" class="form-control @if($errors->has('documento')) is-invalid @endif" 
                                name="documento" accept=".pdf" required>
                            @if($errors->has('documento'))
                                <div class="invalid-feedback">{{ $errors->first('documento') }}</div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('tcc.index') }}" class="btn btn-secondary px-4">
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