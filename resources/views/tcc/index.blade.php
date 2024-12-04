@extends('templates.main', ['menu' => "admin", 'submenu' => "tccs", 'rota' => "tcc.create"])

@section('titulo')
Gerenciamento de TCCs
@endsection

@section('conteudo')
<div class="row">
    <div class="col">
        <table class="table align-middle caption-top table-striped" style="table-layout: fixed; width: 100%;">
            <caption>Tabela de <b>TCCs</b></caption>
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col" style="word-wrap: break-word; word-break: break-word; width: 20%;">Título</th>
                    <th scope="col" style="word-wrap: break-word; word-break: break-word; width: 35%;">Descrição</th>
                    <th scope="col" style="word-wrap: break-word; word-break: break-word; width: 20%;">Aluno</th>
                    <th scope="col">Documento</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tccs as $tcc)
                <tr>
                    <td>{{ $tcc->id }}</td>
                    <td style="word-wrap: break-word; word-break: break-word;">{{ $tcc->titulo }}</td>
                    <td style="word-wrap: break-word; word-break: break-word;">{{ $tcc->descricao }}</td>
                    <td style="word-wrap: break-word; word-break: break-word;">{{ $tcc->aluno->nome ?? 'Não informado' }}</td>
                    <td>
                        @if ($tcc->documento)
                        <a href="{{ asset('storage/' . $tcc->documento) }}" target="_blank" class="btn btn-info">Visualizar</a>
                        @else
                        <span class="text-muted">Sem Documento</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('tcc.edit', $tcc->id) }}" class="btn btn-success">Editar</a>
                        <form action="{{ route('tcc.destroy', $tcc->id) }}" method="POST" style="display:inline;">
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
            <a href="{{ route('tcc.create') }}" class="btn btn-primary">Adicionar Novo TCC</a>
        </div>
    </div>
</div>
@endsection
