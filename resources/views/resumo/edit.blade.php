@extends('layouts.site')

@section('title', 'Editar Resumo - Projeto Trilhas')

@section('content')
<div class="container">
    <section class="intro-section">
        <h2>Editar Resumo</h2>
        <p>Atualize as informações do resumo existente.</p>
    </section>

    <div class="form-card">
        <form action="{{ route('admin.resumo.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Título do Resumo</label>
                <input type="text" class="form-input @if($errors->has('titulo')) is-invalid @endif" 
                    name="titulo" value="{{ old('titulo', $data->titulo) }}" required>
                @if($errors->has('titulo'))
                    <div class="error-message">{{ $errors->first('titulo') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label>Descrição</label>
                <textarea class="form-input @if($errors->has('descricao')) is-invalid @endif"
                    name="descricao" rows="4" required>{{ old('descricao', $data->descricao) }}</textarea>
                @if($errors->has('descricao'))
                    <div class="error-message">{{ $errors->first('descricao') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label>Participantes</label>
                <select name="user_ids[]" class="form-input @if($errors->has('user_ids')) is-invalid @endif" 
                    multiple required>
                    @foreach($alunos as $aluno)
                        <option value="{{ $aluno->id }}" 
                            {{ in_array($aluno->id, $data->users->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $aluno->nome }}
                            @if($aluno->curso)
                                ({{ $aluno->curso->nome }})
                            @else
                                (Sem curso)
                            @endif
                        </option>
                    @endforeach
                </select>
                <small class="form-hint">
                    <i class="fas fa-info-circle"></i>
                    Pressione CTRL para selecionar múltiplos participantes
                </small>
            </div>

            <div class="form-group">
                <label>Documento PDF</label>
                <input type="file" class="form-input @if($errors->has('documento')) is-invalid @endif" 
                    name="documento" accept=".pdf">
                @if($errors->has('documento'))
                    <div class="error-message">{{ $errors->first('documento') }}</div>
                @endif
            </div>

            @if ($data->documento)
                <div class="current-document">
                    <h4>Documento Atual</h4>
                    <p>Um documento já foi enviado anteriormente. Enviar um novo documento substituirá o anterior.</p>
                    <div class="document-actions">
                        <a href="{{ route('admin.resumo.viewPdf', $data->id) }}" class="btn btn-primary" target="_blank">
                            <i class="fas fa-eye"></i> Visualizar PDF
                        </a>
                        <a href="{{ route('admin.resumo.download', $data->id) }}" class="btn btn-secondary">
                            <i class="fas fa-download"></i> Download
                        </a>
                    </div>
                </div>
            @endif

            <div class="form-actions">
                <a href="{{ route('admin.resumo.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Voltar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check"></i> Salvar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('additional_css')
<style>
    .form-card {
        background: white;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
        animation: slideIn 0.3s ease;
        max-width: 800px;
        margin: 0 auto 2rem;
    }

    @keyframes slideIn {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: bold;
        color: #333;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.75rem;
    }

    .form-input {
        width: 100%;
        padding: 0.5rem;
        border: 1px solid #ddd;
        border-radius: 4px;
        margin-bottom: 0.5rem;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .form-input.is-invalid {
        border-color: #dc3545;
    }

    .form-input:focus {
        border-color: #50a050;
        box-shadow: 0 0 0 2px rgba(80, 160, 80, 0.1);
        outline: none;
    }

    .error-message {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .form-hint {
        display: block;
        color: #666;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .current-document {
        background: #f8f9fa;
        padding: 1rem;
        border-radius: 4px;
        margin-bottom: 1.5rem;
        border-left: 4px solid #50a050;
        transition: transform 0.2s ease;
    }

    .current-document:hover {
        transform: translateX(5px);
    }

    .current-document h4 {
        color: #50a050;
        margin-bottom: 0.5rem;
    }

    .document-actions {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 2rem;
    }

    .btn {
        padding: 0.5rem 1rem;
        border-radius: 4px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: background-color 0.2s;
        font-weight: 500;
        letter-spacing: 0.5px;
        transition: all 0.2s ease;
    }

    .btn-primary {
        background-color: #50a050;
        color: white;
        border: none;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
    }

    .btn-primary:hover {
        background-color: #408040;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .intro-section {
        text-align: center;
        padding: 2rem 0;
        margin-bottom: 2rem;
    }

    .intro-section h2 {
        font-size: 2.5rem;
        color: #2c3e50;
        margin-bottom: 1rem;
    }

    .intro-section p {
        color: #666;
        font-size: 1.1rem;
    }
</style>
@endsection
