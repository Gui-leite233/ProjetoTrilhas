@extends('templates.main', ['menu' => "admin", 'submenu' => "bolsas", 'rota' => "bolsa.create"])

@section('titulo')
Bolsa de Estudos
@endsection

@section('conteudo')
<div class="row">
    <div class="col">
        <table class="table align-middle caption-top table-striped" style="table-layout: fixed; width: 100%;">
            <caption>Tabela de <b>Bolsas</b></caption>
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Título</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Curso</th> <!-- Nova coluna -->
                    <th scope="col">Status</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->titulo }}</td>
                    <td>{{ $item->descricao }}</td>
                    <td>{{ $item->curso->nome ?? 'Não informado' }}</td> 
                    <td>{{ $item->ativo ? 'Ativo' : 'Inativo' }}</td>
                    <td>
                        <a href="{{ route('bolsa.edit', $item->id) }}" class="btn btn-success">Editar</a>
                        <form action="{{ route('bolsa.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            <a href="{{ route('bolsa.create') }}" class="btn btn-primary">Adicionar Nova Bolsa</a>
        </div>
    </div>
</div>
@endsection
