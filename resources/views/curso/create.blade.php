@extends('templates.main', ['menu' => "admin", 'submenu' => "Novo Curso"])

@section('titulo') Novo Curso @endsection

@section('conteudo')
<div class="container py-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h4 class="card-title mb-0 d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-mortarboard-fill me-2" viewBox="0 0 16 16">
                            <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5Z"/>
                            <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Z"/>
                        </svg>
                        Novo Curso
                    </h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.curso.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">NOME DO CURSO</label>
                            <input type="text" class="form-control form-control-lg @if($errors->has('nome')) is-invalid @endif" 
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
                                name="link" value="{{ old('link') }}" required>
                            @if($errors->has('link'))
                                <div class="invalid-feedback">{{ $errors->first('link') }}</div>
                            @endif
                            <div class="form-text">Insira um link válido começando com http:// ou https://</div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.curso.index') }}" class="btn btn-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z" />
                                </svg>
                                &nbsp; Voltar
                            </a>
                            <button type="submit" class="btn btn-success">
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