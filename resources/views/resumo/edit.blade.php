@extends('templates.main', ['menu' => "admin", 'submenu' => "Editar Resumo"])

@section('titulo') Resumos @endsection

@section('conteudo')
<div class="container py-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h4 class="card-title mb-0 d-flex align-items-center">
                        <i class="bi bi-file-text me-2"></i>
                        Editar Resumo
                    </h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.resumo.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">TÍTULO DO RESUMO</label>
                            <input type="text" class="form-control @if($errors->has('titulo')) is-invalid @endif" 
                                name="titulo" value="{{ old('titulo', $data->titulo) }}" required>
                            @if($errors->has('titulo'))
                                <div class="invalid-feedback">{{ $errors->first('titulo') }}</div>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">DESCRIÇÃO</label>
                            <textarea class="form-control @if($errors->has('descricao')) is-invalid @endif"
                                name="descricao" rows="4" required>{{ old('descricao', $data->descricao) }}</textarea>
                            @if($errors->has('descricao'))
                                <div class="invalid-feedback">{{ $errors->first('descricao') }}</div>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">PARTICIPANTES</label>
                            <select name="user_ids[]" class="form-select @if($errors->has('user_ids')) is-invalid @endif" 
                                multiple required>
                                @foreach($alunos as $aluno)
                                    <option value="{{ $aluno->id }}" 
                                        {{ in_array($aluno->id, $data->users->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $aluno->nome }} {{-- Changed from $aluno->name to $aluno->nome --}}
                                        @if($aluno->curso)
                                            ({{ $aluno->curso->nome }})
                                        @else
                                            (Sem curso)
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text">
                                <i class="bi bi-info-circle me-1"></i>
                                Pressione CTRL para selecionar múltiplos participantes
                            </div>
                            @if($errors->has('user_ids'))
                                <div class="invalid-feedback">{{ $errors->first('user_ids') }}</div>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">DOCUMENTO PDF</label>
                            <input type="file" class="form-control @if($errors->has('documento')) is-invalid @endif" 
                                name="documento" accept=".pdf">
                            @if($errors->has('documento'))
                                <div class="invalid-feedback">{{ $errors->first('documento') }}</div>
                            @endif
                        </div>

                        @if ($data->documento)
                            <div class="alert alert-info mb-4">
                                <h5 class="alert-heading">Documento Atual</h5>
                                <p class="mb-2">Um documento já foi enviado anteriormente. Enviar um novo documento substituirá o anterior.</p>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.resumo.viewPdf', $data->id) }}" class="btn btn-primary btn-sm" target="_blank">
                                        <i class="bi bi-eye me-1"></i>Visualizar PDF
                                    </a>
                                    <a href="{{ route('admin.resumo.download', $data->id) }}" class="btn btn-secondary btn-sm">
                                        <i class="bi bi-download me-1"></i>Download
                                    </a>
                                </div>
                            </div>
                        @endif

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.resumo.index') }}" class="btn btn-secondary px-4">
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
