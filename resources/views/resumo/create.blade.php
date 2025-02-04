@extends('layouts.site')

@section('title', 'Novo Resumo - Projeto Trilhas')

@section('content')
<div class="container">
    <section class="intro-section">
        <h2>Novo Resumo</h2>
        <p>Crie um novo resumo para compartilhar com a comunidade.</p>
    </section>

    <div class="form-card">
        <form action="{{ route('resumo.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Título do Resumo</label>
                <input type="text" class="form-input @if($errors->has('titulo')) is-invalid @endif" 
                    name="titulo" value="{{ old('titulo') }}" required>
                @if($errors->has('titulo'))
                    <div class="error-message">{{ $errors->first('titulo') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label>Descrição</label>
                <textarea class="form-input @if($errors->has('descricao')) is-invalid @endif"
                    name="descricao" rows="4" required>{{ old('descricao') }}</textarea>
                @if($errors->has('descricao'))
                    <div class="error-message">{{ $errors->first('descricao') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label>Participantes</label>
                <select name="user_ids[]" class="form-input @if($errors->has('user_ids')) is-invalid @endif" 
                    multiple required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->nome }}
                            @if($user->curso)
                                ({{ $user->curso->nome }})
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
                @if($errors->has('user_ids'))
                    <div class="error-message">{{ $errors->first('user_ids') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label>Documento PDF</label>
                <input type="file" class="form-input @if($errors->has('documento')) is-invalid @endif" 
                    name="documento" accept=".pdf" required>
                @if($errors->has('documento'))
                    <div class="error-message">{{ $errors->first('documento') }}</div>
                @endif
            </div>

            <div class="form-actions">
                <a href="{{ route('resumo.index') }}" class="btn btn-secondary">
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
        box-shadow: 0 2px 4px rgb(0, 255, 60);
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
        position: relative;
        padding-left: 20px;
    }

    .form-hint i {
        position: absolute;
        left: 0;
        top: 2px;
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
        color:rgb(53, 164, 79);
        margin-bottom: 1rem;
    }

    .intro-section p {
        color: #666;
        font-size: 1.1rem;
    }

    select[multiple] {
        min-height: 120px;
    }
</style>
@endsection
