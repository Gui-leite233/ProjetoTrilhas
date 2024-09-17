@extends('templates.main', ['menu' => "admin", 'submenu' => "Novo Curso"])

@section('conteudo')

    <form action="{{ route('curso.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                <input 
                    type="text" 
                    class="form-control @if($errors->has('email')) is-invalid @endif" 
                    name="email" 
                    placeholder="email"
                    value="{{old('email')}}"
                />
                <label for="email">Email</label>
                @if($errors->has('email'))
                    <div class='invalid-feedback'>
                        {{ $errors->first('email') }}
                    </div>
                @endif
                </div>
            </div>
        </div>
    </form>

@endsection