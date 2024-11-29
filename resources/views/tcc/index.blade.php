@extends('templates.main', ['menu' => "admin", 'submenu' => "Tccs", 'rota' => "Tccs.create"])

@section('titulo') 
Desenvolvimento Web
@endsection

@section('conteudo')
<div class="row">
    <!-- Tabela de Tccs -->
    <div class="col">
        <table class="table align-middle caption-top table-striped" style="table-layout: fixed; width: 100%;">
            <caption>Tabela de <b>Tccs</b></caption>
            <thead>
                <!-- Cabeçalho da Tabela -->
                <tr>
                    <th scope="col" class="d-none d-md-table-cell" style="min-width: 100px;">ID</th>
                    <th scope="col" style="min-width: 150px;">NOME</th>
                    <th scope="col" class="d-none d-md-table-cell" style="min-width: 200px;">DESCRIÇÃO</th>
                    <th scope="col" style="min-width: 100px;">DOCUMENTO</th>
                </tr>
                <!-- Ação para Adicionar Novo Tcc -->
                <div class="d-flex justify-content-end mb-2">
                    <a href="{{ route('tcc.create') }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path
                                d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM7.5 4.5a.5.5 0 0 1 1 0v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3z" />
                        </svg> Adicionar
                    </a>
                </div>
            </thead>
            <tbody>
                <!-- Loop através dos itens para exibir os tccs -->
                @foreach ($data as $item)
                    <tr>
                        <!-- Exibindo dados da prova -->
                        <td class="d-none d-md-table-cell" style="word-wrap: break-word;">{{ $item->id }}</td>
                        <td style="word-wrap: break-word;">{{ $item->titulo }}</td>

                        <!-- Descrição com "Ver mais" -->
                        <td class="d-none d-md-table-cell">
                            <div class="description-summary" id="desc_{{$item->id}}">
                                {{ \Str::limit($item->descricao, 100) }} <!-- Exibe os primeiros 100 caracteres -->
                                @if (strlen($item->descricao) > 100)
                                    <a href="javascript:void(0)" onclick="toggleDescription({{ $item->id }})"
                                        class="btn btn-link">Ver mais</a>
                                @endif
                            </div>
                            <div class="description-full d-none" id="desc_full_{{$item->id}}">
                                {{ $item->descricao }}
                                <a href="javascript:void(0)" onclick="toggleDescription({{ $item->id }})"
                                    class="btn btn-link">Ver menos</a>
                            </div>
                        </td>

                        <td>
                            <!-- Link para o Documento PDF -->
                            @if ($item->documento) <!-- Verifica se há um documento -->
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
                        <!-- Botões de Ação -->
                        <td>
                            <a href="{{ route('tcc.edit', $item->id) }}" class="btn btn-success">
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
                <div class="row">
                    <div class="col">
                        <a href="{{route('index')}}" class="btn btn-secondary btn-block align-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                                <path
                                    d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z" />
                            </svg>
                            &nbsp; Voltar
                        </a>
                    </div>
                </div>
            </tbody>
        </table>
    </div>
</div>

<!-- Script para alternar entre "Ver mais" e "Ver menos" -->
<script>
    function toggleDescription(id) {
        var summary = document.getElementById('desc_' + id);
        var full = document.getElementById('desc_full_' + id);

        if (summary.style.display === "none") {
            summary.style.display = "block";
            full.style.display = "none";
        }
    }
    @endsection