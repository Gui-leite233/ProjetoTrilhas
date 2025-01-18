@extends('templates.main', ['menu' => "admin", 'submenu' => "Novo TCC"])

@section('titulo') Novo TCC @endsection

@section('conteudo')
<div class="container py-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h4 class="card-title mb-0 d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-file-earmark-text me-2" viewBox="0 0 16 16">
                            <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z"/>
                            <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                        </svg>
                        Novo TCC
                    </h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('tcc.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Display any errors at the top -->
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">TÍTULO DO TCC</label>
                            <input type="text" class="form-control form-control-lg @if($errors->has('titulo')) is-invalid @endif" 
                                name="titulo" value="{{ old('titulo') }}" required>
                            @if ($errors->has('titulo'))
                                <div class='invalid-feedback'>{{ $errors->first('titulo') }}</div>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">DESCRIÇÃO</label>
                            <textarea class="form-control @if($errors->has('descricao')) is-invalid @endif"
                                name="descricao" rows="4" required>{{ old('descricao') }}</textarea>
                            @if ($errors->has('descricao'))
                                <div class='invalid-feedback'>{{ $errors->first('descricao') }}</div>
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
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">DOCUMENTO</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-pdf" viewBox="0 0 16 16">
                                        <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
                                        <path d="M4.603 12.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.701 19.701 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.187-.012.395-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.065.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.716 5.716 0 0 1-.911-.95 11.642 11.642 0 0 0-1.997.406 11.311 11.311 0 0 1-1.021 1.51c-.29.35-.608.655-.926.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.27.27 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.647 12.647 0 0 1 1.01-.193 11.666 11.666 0 0 1-.51-.858 20.741 20.741 0 0 1-.5 1.05zm2.446.45c.15.162.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.881 3.881 0 0 0-.612-.053zM8.078 5.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/>
                                    </svg>
                                </span>
                                <input type="file" class="form-control @if($errors->has('documento')) is-invalid @endif"
                                    name="documento" accept=".pdf">
                                @if ($errors->has('documento'))
                                    <div class='invalid-feedback'>{{ $errors->first('documento') }}</div>
                                @endif
                            </div>
                            <small class="text-muted">Aceita apenas arquivos PDF. Tamanho máximo: 2MB</small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('tcc.index') }}" class="btn btn-secondary px-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16"></svg></svg>
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

<style>
.input-group .form-select {
    padding-left: 0.5rem;
}
.form-select:focus {
    box-shadow: none;
    border-color: #ced4da;
}
.input-group .form-select:focus + .input-group-text {
    border-color: #ced4da;
}

.form-select {
    background-color: #fff;
    border: 1px solid #ced4da;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-select:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.form-select option {
    padding: 10px;
    font-size: 1rem;
}

.form-select option:hover {
    background-color: #f8f9fa;
}

.input-group .form-select {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}

.form-select[required]:invalid {
    color: #6c757d;
}

.form-select option[value=""][disabled] {
    display: none;
}

.form-select[multiple] {
    padding-right: 0.75rem;
    background-image: none;
    height: auto;
    min-height: 120px;
}

.form-select[multiple] option {
    padding: 0.5rem;
    margin-bottom: 1px;
    border-radius: 0.25rem;
}

.form-select[multiple] option:checked {
    background-color: #0d6efd;
    color: white;
}
</style>
@endsection