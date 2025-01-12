@extends('templates.main', ['menu' => "admin", 'submenu' => "projetos", 'rota' => "projeto.create"])

@section('titulo') Projetos @endsection

@section('conteudo')

<div class="container py-4">
    <div class="row">
        <div class="col">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-dark text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Projetos</h5>
                        <a href="{{ route('projeto.create') }}" class="btn btn-light">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-plus-circle me-1" viewBox="0 16 16">
                                <path d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM7.5 4.5a.5.5 0 0 1 1 0v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3z" />
                            </svg>
                            Adicionar Projeto
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="d-none d-md-table-cell px-4">ID</th>
                                    <th scope="col" class="px-4">TÍTULO</th>
                                    <th scope="col" class="d-none d-md-table-cell px-4">DESCRIÇÃO</th>
                                    <th scope="col" class="d-none d-md-table-cell px-4">ALUNO</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projeto as $item)
                                    <tr>
                                        <td class="d-none d-md-table-cell px-4">{{ $item->id }}</td>
                                        <td class="px-4">{{ $item->titulo }}</td>
                                        <td class="d-none d-md-table-cell px-4">{{ $item->descricao }}</td>
                                        <td class="d-none d-md-table-cell px-4">{{ $item->aluno ? $item->aluno->nome : 'Aluno não informado' }}</td>
                                        <td class="px-4">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ route('projeto.edit', $item->id) }}" class="btn btn-dark btn-sm"
                                                    title="Editar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                    </svg>
                                                </a>
                                                <form action="{{ route('projeto.destroy', $item->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm"
                                                        onclick="return confirm('Tem certeza que deseja excluir este projeto?')">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-trash-fill"
                                                            viewBox="0 0 16 16">
                                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                        </svg>
                                                    </button>
                                                </form>
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



@endsection

@section('script')
@endsection
