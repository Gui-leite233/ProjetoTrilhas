@extends('templates.main', ['menu' => "admin", 'submenu' => "Editar TCC"])

@section('titulo') TCCs @endsection

@section('conteudo')

<form action="{{ route('admin.tcc.update', $data->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col">
            <div class="form-floating mb-3">
                <input type="text" class="form-control @if($errors->has('titulo')) is-invalid @endif" name="titulo"
                    placeholder="Título" value="{{ old('titulo', $data->titulo) }}" />
                <label for="titulo">Título</label>
                @if ($errors->has('titulo'))
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
                <textarea type="text" class="form-control @if($errors->has('descricao')) is-invalid @endif"
                    name="descricao" placeholder="Descrição" style="min-height: 100px">{{ old('descricao', $data->descricao) }}</textarea>
                <label for="descricao">Descrição</label>
                @if ($errors->has('descricao'))
                    <div class='invalid-feedback'>
                        {{ $errors->first('descricao') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-floating mb-3">
                <select name="aluno_id" class="form-select @if($errors->has('aluno_id')) is-invalid @endif">
                    <option value="">Selecione o Aluno</option>
                    @foreach ($alunos as $item)
                        <option value="{{ $item->id }}" @if($item->id == $data->aluno_id) selected="true" @endif>
                            {{ $item->usuario->name }}
                        </option>
                    @endforeach
                </select>
                <label for="aluno_id">Aluno</label>
                @if ($errors->has('aluno_id'))
                    <div class='invalid-feedback'>
                        {{ $errors->first('aluno_id') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="input-group mb-3">
                <label class="input-group-text" for="documento">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-pdf" viewBox="0 0 16 16">
                        <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
                        <path d="M4.603 12.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.701 19.701 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.187-.012.395-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.065.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.716 5.716 0 0 1-.911-.95 11.642 11.642 0 0 0-1.997.406 11.311 11.311 0 0 1-1.021 1.51c-.29.35-.608.655-.926.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.27.27 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.647 12.647 0 0 1 1.01-.193 11.666 11.666 0 0 1-.51-.858 20.741 20.741 0 0 1-.5 1.05zm2.446.45c.15.162.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.881 3.881 0 0 0-.612-.053zM8.078 5.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/>
                    </svg>
                    &nbsp; Documento PDF
                </label>
                <input type="file" class="form-control @if($errors->has('documento')) is-invalid @endif" name="documento" accept=".pdf" />
                @if ($errors->has('documento'))
                    <div class='invalid-feedback'>
                        {{ $errors->first('documento') }}
                    </div>
                @endif
            </div>
            @if ($data->documento)
                <div class="alert alert-info mb-3" role="alert">
                    <h4 class="alert-heading">Documento Atual</h4>
                    <p class="mb-0">Um documento já foi enviado anteriormente. Enviar um novo documento substituirá o anterior.</p>
                    <hr>
                    <a href="{{ asset('storage/' . $data->documento) }}" target="_blank" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-pdf" viewBox="0 0 16 16">
                            <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
                            <path d="M4.603 12.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.701 19.701 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.187-.012.395-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.065.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.716 5.716 0 0 1-.911-.95 11.642 11.642 0 0 0-1.997.406 11.311 11.311 0 0 1-1.021 1.51c-.29.35-.608.655-.926.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.27.27 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.647 12.647 0 0 1 1.01-.193 11.666 11.666 0 0 1-.51-.858 20.741 20.741 0 0 1-.5 1.05zm2.446.45c.15.162.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.881 3.881 0 0 0-.612-.053zM8.078 5.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/>
                        </svg>
                        &nbsp; Visualizar Documento Atual
                    </a>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a href="{{ route('admin.tcc.index') }}" class="btn btn-secondary btn-block align-content-center">
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
    </div>
</form>
@endsection