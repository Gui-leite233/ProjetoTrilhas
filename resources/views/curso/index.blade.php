@extends('templates.main')

@section('conteudo')

<h3> Conteudo </h3>
<form action="{{ route('curso.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Add your form fields here -->
    <button type="submit" class="btn btn-primary">Salvar Curso</button>
</form>
@endsection