@extends('templates.main', ['menu' => "admin", 'submenu' => "Cursos",  'rota'=>"curso.create"])

@section('conteudo')

<div class="row">
    <div class="col">
        <table class="table align-middle caption-top table-striped">
            <caption>Tabela de <b>Cursos</b></caption>
            <thead>
            <tr>
                <th scope="col" class="d-none d-md-table-cell">ID</th>
                <th scope="col">NOME</th>
                <th scope="col" class="d-none d-md-table-cell">DESCRIÇÃO</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td d-none d-md-table-cell>{{ $item->id }}</td>
                        <td>{{ $item->nome }}</td>
                        <td class="d-none d-md-table-cell">{{ $item->descricao }}</td>
                        
                        <td>
                            <a href= "{{ route('curso.edit', $item->id) }}" class="btn btn-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z"/>
                                    <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z"/>
                                </svg>
                            </a>
                            
                        </td>
                        <form action="{{ route('curso.destroy', $item->id) }}" method="POST" id="form_{{$item->id}}">
                            @csrf
                            @method('DELETE')
                        </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>