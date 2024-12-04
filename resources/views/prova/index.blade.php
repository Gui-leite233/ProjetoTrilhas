@extends('templates.main', ['menu' => "admin", 'submenu' => "Provass", 'rota' => "Provas.create"])

@section('titulo')
Desenvolvimento Web
@endsection

@section('conteudo')
<div class="row">
    <!-- Tabela de Provas -->
    <div class="col">
        <table class="table align-middle caption-top table-striped" style="table-layout: fixed; width: 100%;">
            <caption>Tabela de <b>Provass</b></caption>
            <thead>
                <tr>
                    <th scope="col" class="d-none d-md-table-cell" style="min-width: 100px;">ID</th>
                    <th scope="col" style="min-width: 150px;">NOME</th>
                    <th scope="col" class="d-none d-md-table-cell" style="min-width: 200px;">DESCRIÇÃO</th>
                    <th scope="col" style="min-width: 100px;">DOCUMENTO</th>
                    <th scope="col" style="min-width: 150px;">AÇÃO</th>
                </tr>
                <div class="d-flex justify-content-end mb-2">
                    <a href="{{ route('prova.create') }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path
                                d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM7.5 4.5a.5.5 0 0 1 1 0v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3z" />
                        </svg> Adicionar
                    </a>
                </div>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td class="d-none d-md-table-cell" style="word-wrap: break-word; min-width: 100px;">{{ $item->id }}</td>
                    <td style="word-wrap: break-word; min-width: 150px;">{{ $item->titulo }}</td>

                    <td class="d-none d-md-table-cell" style="word-wrap: break-word; min-width: 200px;">
                        <span>{{ $item->descricao }}</span>
                    </td>

                    <td style="min-width: 100px;">
                        @if ($item->documento) 
                        <a href="{{ asset('storage/' . $item->documento) }}" target="_blank" class="btn btn-info">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF"
                                class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
                                <path
                                    d="M5.5 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H1a.5.5 0 0 1-.5-.5V.5A.5.5 0 0 1 1 0h4.5zM1 3V1h4.5v2H1z" />
                                <path d="M4 1h10a.5.5 0 0 1 .5.5v13a.5.5 0 0 1-.5.5H4a.5.5 0 0 1-.5-.5V1z" />
                            </svg>
                            Visualizar PDF
                        </a>
                        @else
                        <span class="text-muted">Sem Documento</span>
                        @endif
                    </td>

                    <td style="min-width: 150px;">
                        <a href="{{ route('prova.edit', $item->id) }}" class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF"
                                class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z" />
                                <path
                                    d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z" />
                            </svg>
                        </a>
                        <a nohref style="cursor:pointer"
                            onclick="document.getElementById('form_{{$item->id}}').submit()" class="btn btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF"
                                class="bi bi-trash-fill" viewBox="0 0 16 16">
                                <path
                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                            </svg>
                        </a>
                    </td>
                </tr>
                <form action="{{ route('prova.destroy', $item->id) }}" method="POST" id="form_{{$item->id}}">
                    @csrf
                    @method('DELETE')
                </form>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
