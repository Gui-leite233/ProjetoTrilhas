@extends('layouts.site')

@section('title', 'Editar Curso - Projeto Trilhas')

@section('content')
<div class="container">
    <section class="intro-section">
        <h2>Editar Curso</h2>
        <p>Atualize as informações do curso usando o formulário abaixo.</p>
    </section>

    <div class="form-container">
        <form action="{{ route('curso.update', $dados->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nome">Nome do Curso</label>
                <input type="text" class="form-control @if($errors->has('nome')) is-invalid @endif" 
                    name="nome" value="{{old('nome', $dados->nome)}}" required>
                @if($errors->has('nome'))
                    <div class="invalid-feedback">{{ $errors->first('nome') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea class="form-control @if($errors->has('descricao')) is-invalid @endif"
                    name="descricao" rows="4" required>{{old('descricao', $dados->descricao)}}</textarea>
                @if($errors->has('descricao'))
                    <div class="invalid-feedback">{{ $errors->first('descricao') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="link">Link do Curso</label>
                <input type="url" class="form-control @if($errors->has('link')) is-invalid @endif"
                    name="link" value="{{old('link', $dados->link)}}" placeholder="https://" required>
                @if($errors->has('link'))
                    <div class="invalid-feedback">{{ $errors->first('link') }}</div>
                @endif
            </div>

            <div class="button-row">
                <a href="{{ route('curso.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Voltar
                </a>
                <button type="submit" class="btn">
                    <i class="fas fa-save"></i> Salvar Alterações
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('additional_css')
<style>
    .intro-section {
        text-align: center;
        margin-bottom: 2rem;
        color: #e0e0e0;
    }

    .intro-section h2 {
        color: #50a050;
        margin-bottom: 1rem;
    }

    .form-container {
        max-width: 800px;
        margin: 0 auto;
        background-color: #444;
        border-radius: 6px;
        padding: 2rem;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        color: #e0e0e0;
        font-weight: 500;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 4px;
        background-color: #333;
        color: #fff;
        transition: border-color 0.2s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: #50a050;
        box-shadow: 0 0 0 2px rgba(80, 160, 80, 0.25);
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .button-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 2rem;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 4px;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
    }

    .btn-secondary {
        background-color: #666;
        color: white;
    }

    .btn {
        background-color: #50a050;
        color: white;
    }

    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    @media (max-width: 768px) {
        .form-container {
            padding: 1.5rem;
            margin: 0 1rem;
        }

        .button-row {
            flex-direction: column;
            gap: 1rem;
        }

        .button-row .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection