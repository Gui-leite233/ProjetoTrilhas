@extends('templates.main', ['menu' => "admin", 'submenu' => "Novo curso"])

@section('conteudo')

<form action="{{ route('curso.store') }}" method="POST" enctype="multipart/form-data">
    @csrf  
    <div class="row">
        <div class="col" >
            <div class="form-floating mb-3">
                <input 
                    type="text" 
                    class="form-control @if($errors->has('nome')) is-invalid @endif" 
                    name="nome" 
                    placeholder="Nome"
                    value="{{old('nome')}}"
                />
                <label for="nome">Nome</label>
                @if($errors->has('nome'))
                    <div class='invalid-feedback'>
                        {{ $errors->first('nome') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-floating mb-3">
                <textarea
                    type="text"
                    class="form-control @if($errors->has('descricao')) is-invalid @endif"
                    name="descricao"
                    placeholder="Descrição"
                    style="min-height: 100px"
                >{{old('descricao')}}</textarea>
                <label for="descricao">Descrição</label>
                @if($errors->has('descricao'))
                    <div class='invalid-feedback'>
                        {{ $errors->first('descricao') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!--<div class="row">
        <div class="col">
            <div class="form-floating mb-3">
                <input
                    type="date"
                    class="form-control @if($errors->has('data')) is-invalid @endif"
                    name="data"
                    placeholder="Data"
                    value="{{old('data')}}"
                />
                <label for="data">Data</label>
                @if($errors->has('data'))
                    <div class='invalid-feedback'>
                        {{ $errors->first('data') }}
                    </div>
                @endif
            </div>
        </div>
    </div>-->
    <div class="row">
        <div class="col">
            <a href="{{route('curso.index')}}" class="btn btn-secondary btn-block align-content-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                    <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
                </svg>
                &nbsp; Voltar
            </a>
            <button type="submit" class="btn btn-success btn-block align-content-center">
                Confirmar &nbsp;
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </svg>
            </button>
        </div>
    </div>
</form>

@endsection