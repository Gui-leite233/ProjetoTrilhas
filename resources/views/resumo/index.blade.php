@extends('layouts.site')

@section('title', 'Resumos - Projeto Trilhas')

@section('action_button')
    @auth
        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
            <a href="{{ route('resumo.create') }}" class="add-button">
                <i class="fas fa-plus"></i> Novo Resumo
            </a>
        @endif
    @endauth
@endsection

@section('content')
<div class="container">
    <section class="intro-section">
        <h2>Resumos</h2>
        <p>Explore os resumos compartilhados pela nossa comunidade acadêmica.</p>
    </section>

    <div class="card-container">
        @foreach ($data as $item)
            <div class="card">
                <div class="card-inner">
                    <div class="card-header">
                        <i class="fas fa-book-open fa-3x"></i>
                    </div>
                    <div class="card-content">
                        <div class="content-main">
                            <h3>{{ $item->titulo }}</h3>
                            <p class="description" data-full-text="{{ $item->descricao }}">
                                {{ Str::limit($item->descricao, 100) }}
                                @if (strlen($item->descricao) > 100)
                                    <button class="ver-mais-btn">Ver mais...</button>
                                @endif
                            </p>
                        </div>

                        <div class="content-footer">
                            <div class="action-row">
                                <div class="view-buttons">
                                    @if ($item->documento)
                                        <a href="{{ route('site.resumo.viewPdf', $item->id) }}" class="btn" target="_blank">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('site.resumo.download', $item->id) }}" class="btn">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    @endif
                                </div>
                                
                                @auth
                                    @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        <div class="admin-buttons">
                                            <a href="{{ route('resumo.edit', $item->id) }}" class="btn btn-edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('resumo.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-delete" onclick="return confirm('Tem certeza que deseja excluir este resumo?')">
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
                        <div class="documento-badge" style="margin-top: 25px; margin-left: 20px;">
                            <i class="fas fa-file-pdf"></i> PDF Disponível
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    @if($data->isEmpty())
        <div class="empty-state">
            <i class="fas fa-book-open fa-4x"></i>
            <p>Nenhum resumo disponível no momento.</p>
        </div>
    @endif
</div>
@endsection

@section('additional_css')
<style>
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        height: 100%;
    }

    .card-inner {
        display: flex;
        flex-direction: column;
        height: 100%;
        position: relative;
        padding: 1rem;
    }

    .card-header {
        margin-bottom: 1rem;
    }

    .card-content {
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .content-main {
        flex: 1;
    }

    .content-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 15px;
        border-top: 1px solid #eee;
        margin-bottom: 1rem;
    }

    .badges-row {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        min-width: fit-content;
    }

    .action-row {
        display: flex;
        gap: 12px;
        margin-left: auto;
        position: relative;
        z-index: 2;  /* Ensure buttons are above the badge */
    }

    .view-buttons, .admin-buttons {
        display: flex;
        gap: 8px;
    }

    .admin-buttons {
        border-left: 1px solid #eee;
        padding-left: 12px;
    }

    .documento-badge {
        width: 100%;
        text-align: center;
        background: linear-gradient(135deg, #50a050, #408040);
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        margin-top: auto;
        position: relative;
        z-index: 1;  /* Keep badge below the buttons */
    }

    .mt-auto {
        margin-top: auto;
    }

    .btn {
        transform: scale(1);
        transition: all 0.2s ease;
        position: relative;
        z-index: 2;  /* Ensure buttons are above the badge */
    }

    .btn:hover {
        transform: scale(1.05);
    }

    .card-container {
        gap: 1.5rem;
        padding: 1rem 0;
    }

    .intro-section {
        margin-bottom: 2rem;
        text-align: center;
        padding: 2rem 0;
    }

    .intro-section h2 {
        font-size: 2.5rem;
        color:rgb(24, 188, 90);
        margin-bottom: 1rem;
    }

    .intro-section p {
        color: #666;
        font-size: 1.1rem;
    }

    .empty-state {
        animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .card-actions {
        display: flex;
        gap: 10px;
        margin-top: 15px;
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

    .btn-edit, .btn-delete {
        padding: 0.15rem 0.3rem !important;
        font-size: 0.65rem !important;
    }

    .btn-edit {
        background-color: #ffc107;
    }

    .btn-delete {
        background-color: #dc3545;
        border: none;
        cursor: pointer;
    }

    .btn-edit:hover {
        background-color: #e0a800;
    }

    .btn-delete:hover {
        background-color: #c82333;
    }

    .card-actions {
        gap: 0.2rem;
    }

    .btn-actions {
        display: flex;
        gap: 0.3rem;
        margin-top: auto;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.25rem 0.5rem;
        font-size: 0.7rem;
        border-radius: 4px;
        color: white;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-primary {
        background-color: #50a050;
    }

    .btn-edit {
        background-color: #ffc107;
        padding: 0.25rem 0.5rem;
        font-size: 0.7rem;
    }

    .btn-delete {
        background-color: #dc3545;
        padding: 0.25rem 0.5rem;
        font-size: 0.7rem;
    }

    .card-actions {
        padding: 0.5rem;
        gap: 0.3rem;
    }

    .card-actions form {
        margin: 0;
    }

    .content-footer {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 15px 0;
        border-top: 1px solid #eee;
        gap: 15px;
    }

    .badges-row {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        order: 2;
    }

    .action-row {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        order: 1;
    }

    .content-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-top: 1px solid #eee;
        gap: 15px;
    }

    .badges-row {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        min-width: fit-content;
    }

    .action-row {
        display: flex;
        gap: 12px;
        margin-left: auto;
    }

    .view-buttons, .admin-buttons {
        display: flex;
        gap: 8px;
    }

    .admin-buttons {
        border-left: 1px solid #eee;
        padding-left: 12px;
    }

    .description {
        position: relative;
        transition: all 0.3s ease;
    }

    .description.expanded {
        white-space: normal;
    }

    .ver-mais-btn {
        background: none;
        border: none;
        color: #50a050;
        cursor: pointer;
        padding: 0;
        margin-left: 5px;
        font-size: 0.9em;
    }

    .ver-mais-btn:hover {
        text-decoration: underline;
    }
</style>
@endsection

@section('additional_js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.ver-mais-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            const descriptionElement = this.parentElement;
            const fullText = descriptionElement.dataset.fullText;
            
            if (descriptionElement.classList.contains('expanded')) {
                descriptionElement.textContent = fullText.substring(0, 100) + '...';
                descriptionElement.classList.remove('expanded');
                const newButton = document.createElement('button');
                newButton.className = 'ver-mais-btn';
                newButton.textContent = 'Ver mais...';
                descriptionElement.appendChild(newButton);
            } else {
                descriptionElement.textContent = fullText;
                descriptionElement.classList.add('expanded');
                const newButton = document.createElement('button');
                newButton.className = 'ver-mais-btn';
                newButton.textContent = 'Ver menos';
                descriptionElement.appendChild(newButton);
            }
        });
    });
});
</script>
@endsection
