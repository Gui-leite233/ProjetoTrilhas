-- Active: 1721426480344@@127.0.0.1@3306@laravel
@extends('templates.main')

@section('conteudo')

    <h3> Conteudo </h3>
    <form action="{{ route('curso.store') }}" method="GET" enctype="multipart/form-data">
        @csrf
        <!-- Add your form fields here -->
        <button type="submit" class="btn btn-primary">Salvar Curso</button>
    </form>
@endsection