@extends('templates.main', ['menu' => "admin", 'submenu' => "Novo Curso"])

@section('conteudo')

    <form action="{{ route('curso.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col">
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
    </form>

@endsection