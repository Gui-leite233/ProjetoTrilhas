@extends('templates.main', ['menu' => "admin", 'submenu' => "Provas", 'rota' => "Provas.create"])

@section('titulo') Desenvolvimento Web @endsection

@section('conteudo')

<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-dark py-3">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-6">
                <h4 class="text-white mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-file-earmark-text-fill" viewBox="0 0 16 16">
                        <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM4.5 9a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 1 0-1h4a.5.5 0 0 1 0 1h-4z"/>
                    </svg>
                    &nbsp;Cadastrar Nova Prova
                </h4>
            </div>
        </div>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('prova.store') }}" method="POST" enctype="multipart/form-data">
            @csrf  
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="form-floating mb-3">
                        <input 
                            type="text" 
                            class="form-control {{ $errors->has('titulo') ? 'is-invalid' : '' }}" 
                            name="titulo" 
                            placeholder="Título"
                            value="{{ old('titulo') }}"
                        />
                        <label for="titulo">
                            <span class="text-danger">*</span> Título
                        </label>
                        @if($errors->has('titulo'))
                            <div class='invalid-feedback'>
                                {{ $errors->first('titulo') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <textarea
                            class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }}"
                            name="descricao"
                            placeholder="Descrição"
                            style="min-height: 120px"
                        >{{ old('descricao') }}</textarea>
                        <label for="descricao">
                            <span class="text-danger">*</span> Descrição
                        </label>
                        @if($errors->has('descricao'))
                            <div class='invalid-feedback'>
                                {{ $errors->first('descricao') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label class="form-label">
                            <span class="text-danger">*</span> Documento (PDF)
                        </label>
                        <div class="input-group">
                            <input 
                                type="file" 
                                class="form-control @if($errors->has('documento')) is-invalid @endif" 
                                name="documento" 
                                accept=".pdf"
                            />
                            <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                    <path d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029z"/>
                                </svg>
                            </span>
                        </div>
                        @if($errors->has('documento'))
                            <div class='invalid-feedback d-block'>
                                {{ $errors->first('documento') }}
                            </div>
                        @endif
                        <div class="form-text">Apenas arquivos PDF são aceitos</div>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex gap-2">
                        <a href="{{ route('prova.index') }}" class="btn btn-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                                <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
                            </svg>
                            &nbsp; Voltar
                        </a>
                        <button type="submit" class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                            </svg>
                            &nbsp; Confirmar
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection