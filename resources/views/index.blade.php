@extends('templates.main', ['menu' => "Home ", "submenu" => "Principal"])

@section('titulo') Desenvolvimento Web @endsection

@section('conteudo')
<div class="row">
    <div class="col">
        <div class="card text-center border-success card-bg-success">
            <div class="card-header text-white" style="background-color: #198754;">
                Cursos
            </div>
            <div class="card-body">
                <a href="{{route('site.curso')}}" class="dropdown-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" fill="#198754"
                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path
                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd"
                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card text-center border-success card-bg-success">
            <div class="card-header text-white" style="background-color: #198754;">
                Provas
            </div>
            <div class="card-body">
                <a href="{{route('site.prova')}}" class="dropdown-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" fill="#198754"
                        class="bi bi-people-fill" viewBox="0 0 16 16">
                        <path
                            d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card text-center border-success card-bg-success">
            <div class="card-header text-white" style="background-color: #198754;">
                Tcc's
            </div>
            <div class="card-body">
                <a href="{{route('site.tcc')}}" class="dropdown-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" fill="#198754"
                        class="bi bi-people-fill" viewBox="0 0 16 16">
                        <path
                            d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
    @endsection