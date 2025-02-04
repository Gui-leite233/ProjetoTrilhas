@extends('layouts.site')

@section('title', 'Provas - Projeto Trilhas')

@section('action_button')
    @auth
        @if(Auth::user()->role_id == 1)
            <a href="{{ route('prova.create') }}" class="add-button">
                <i class="fas fa-plus"></i> Nova Prova
            </a>
        @endif
    @endauth
@endsection

@section('content')
<div class="container">
    <section class="intro-section">
        <h2>Provas Anteriores</h2>
        <p>Estude com provas aplicadas anteriormente e prepare-se melhor.</p>
    </section>

    <div class="card-container">
        @foreach ($data as $item)
            <div class="card">
                <i class="fas fa-file-alt fa-3x"></i>
                <div class="card-content">
                    <div class="content-wrapper">
                        <div class="content-main">
                            <h3>{{ $item->titulo }}</h3>
                            <p>{{ Str::limit($item->descricao, 100) }}</p>
                        </div>

                        <div class="action-bar">
                            <div class="buttons-row">
                                <div class="view-buttons">
                                    @if ($item->documento)
                                        <a href="{{ route('site.prova.viewPdf', $item->id) }}" class="btn btn-view" target="_blank" title="Visualizar">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('site.prova.download', $item->id) }}" class="btn btn-download" title="Download">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    @endif
                                </div>
                                
                                @auth
                                    @if(Auth::user()->role_id == 1)
                                        <div class="admin-buttons">
                                            <a href="{{ route('prova.edit', $item->id) }}" class="btn btn-edit" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('prova.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-delete" title="Excluir" 
                                                        onclick="return confirm('Tem certeza que deseja excluir esta prova?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>

                    @if ($item->documento)
                        <div class="badge-bar">
                            <div class="documento-badge">
                                <i class="fas fa-file-pdf"></i> PDF Disponível
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    @if($data->isEmpty())
        <div class="empty-state">
            <i class="fas fa-file-alt fa-4x"></i>
            <p>Nenhuma prova disponível no momento.</p>
        </div>
    @endif
</div>
@endsection

@section('additional_css')
<style>
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }

    .card-content {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .content-wrapper {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .content-main {
        flex: 1;
        margin-bottom: 15px;
    }

    .action-bar {
        padding: 15px 0;
        border-top: 1px solid #eee;
    }

    .badge-bar {
        padding-top: 15px;
        border-top: 1px solid #eee;
        margin-top: auto;
    }

    .all-actions {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .action-bar {
        display: flex;
        justify-content: flex-end;
    }

    .badge-bar {
        display: flex;
        justify-content: flex-start;
        border-top: 1px solid #eee;
        padding-top: 15px;
    }

    .buttons-row {
        display: flex;
        gap: 12px;
    }

    .badges-row {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .view-buttons, .admin-buttons {
        display: flex;
        gap: 8px;
    }

    .admin-buttons {
        border-left: 1px solid #eee;
        padding-left: 12px;
    }

    .admin-buttons form {
        margin: 0;
    }

    .documento-badge {
        background-color: #50a050;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .btn {
        padding: 6px 12px;
        border-radius: 4px;
        color: white;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .btn-view {
        background-color: #4a90e2;
    }

    .btn-download {
        background-color: #50a050;
    }

    .btn-edit {
        background-color: #ffc107;
    }

    .btn-delete {
        background-color: #dc3545;
        border: none;
        cursor: pointer;
    }

    .empty-state {
        text-align: center;
        padding: 50px 0;
        color: #666;
    }

    .empty-state i {
        margin-bottom: 20px;
        color: #50a050;
    }
</style>
@endsection