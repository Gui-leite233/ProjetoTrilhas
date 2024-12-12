@extends('templates.main', ['menu' => "admin", 'submenu' => "Editar Curso"])

@section('titulo') Editar Curso @endsection

@section('conteudo')
    <form action="{{ route('curso.update', $dados->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input 
                                type="text" 
                                class="form-control @if($errors->has('nome')) is-invalid @endif" 
                                name="nome" 
                                placeholder="Nome do Curso"
                                value="{{old('nome', $dados->nome)}}"
                            />
                            <label for="nome">Nome do Curso</label>
                            @if($errors->has('nome'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nome') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <textarea 
                                class="form-control @if($errors->has('descricao')) is-invalid @endif" 
                                name="descricao" 
                                placeholder="Descrição do Curso"
                                style="min-height: 120px"
                            >{{old('descricao', $dados->descricao)}}</textarea>
                            <label for="descricao">Descrição do Curso</label>
                            @if($errors->has('descricao'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('descricao') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input 
                                type="url" 
                                class="form-control @if($errors->has('link')) is-invalid @endif" 
                                name="link" 
                                placeholder="Link do Curso"
                                value="{{old('link', $dados->link)}}"
                            />
                            <label for="link">Link do Curso</label>
                            @if($errors->has('link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white">
                <div class="row">
                    <div class="col text-end">
                        <a href="{{route('curso.index')}}" class="btn btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                                <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
                            </svg>
                            &nbsp; Voltar
                        </a>
                        <button type="submit" class="btn btn-success">
                            Confirmar &nbsp;
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection