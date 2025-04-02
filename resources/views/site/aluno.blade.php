@extends('templates.main', ['menu' => "home", "submenu" => "Alunos"])

@section('titulo') Lista de Alunos @endsection

@section('conteudo')

<div class="container py-4">
    <div class="row">
        <div class="col">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-dark text-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Alunos Cadastrados</h5>
                    <a href="{{ route('aluno.create') }}" class="btn btn-light">
                        <i class="bi bi-plus-circle"></i> Novo Aluno
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Curso</th>
                                    <th>Ano</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-2">
                                                    <i class="bi bi-person-fill text-primary"></i>
                                                </div>
                                                {{ $item->usuario->name }}
                                            </div>
                                        </td>
                                        <td>{{ $item->usuario->email }}</td>
                                        <td>
                                            <span class="badge bg-info">
                                                {{ $item->curso->nome ?? 'Não informado' }}
                                            </span>
                                        </td>
                                        <td>{{ $item->ano }}</td>
                                        <td>
                                            @if($item->ativo)
                                                <span class="badge bg-success">Ativo</span>
                                            @else
                                                <span class="badge bg-danger">Inativo</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('aluno.edit', $item->id) }}" 
                                                   class="btn btn-sm btn-primary">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="{{ route('aluno.show', $item->id) }}" 
                                                   class="btn btn-sm btn-info">
                                                    <i class="bi bi-info-circle"></i>
                                                </a>
                                                <button type="button" 
                                                        class="btn btn-sm btn-danger"
                                                        onclick="showRemoveModal({{ $item->id }}, '{{ $item->usuario->name }}')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .table th {
        background-color: #f8f9fa;
    }
    .table td {
        vertical-align: middle;
    }
    .btn-group {
        gap: 5px;
    }
    .badge {
        font-size: 0.875rem;
    }
</style>

@endsection