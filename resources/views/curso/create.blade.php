@extends('templates.main', ['menu' => "admin", 'submenu' => "Novo Curso"])

@section('titulo') Novo Curso @endsection

@section('conteudo')
<div class="container py-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h4 class="card-title mb-0 d-flex align-items-center">
                        <i class="bi bi-mortarboard-fill me-2"></i>
                        Novo Curso
                    </h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('curso.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">NOME DO CURSO</label>
                            <input type="text" class="form-control @if($errors->has('nome')) is-invalid @endif" 
                                name="nome" value="{{ old('nome') }}" required>
                            @if($errors->has('nome'))
                                <div class="invalid-feedback">{{ $errors->first('nome') }}</div>
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
                            <label class="form-label text-muted small fw-bold">LINK DO CURSO</label>
                            <input type="url" class="form-control @if($errors->has('link')) is-invalid @endif"
                                name="link" value="{{ old('link') }}" placeholder="https://" required>
                            @if($errors->has('link'))
                                <div class="invalid-feedback">{{ $errors->first('link') }}</div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('curso.index') }}" class="btn btn-secondary px-4">
                                <i class="bi bi-arrow-left-short"></i>
                                Voltar
                            </a>
                            <button type="submit" class="btn btn-success px-4">
                                Salvar
                                <i class="bi bi-check-lg ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection