@extends('templates.main')

@section('conteudo')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="card col-md-6 text-center">
            <div class="card-body">
                <i class="bi bi-shield-lock text-danger" style="font-size: 4rem;"></i>
                <h3 class="mt-4 text-danger">Acesso Negado</h3>
                
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @else
                    <p class="text-muted">Você não tem permissão para acessar esta página.</p>
                @endif
                
                <a href="{{ route('index') }}" class="btn btn-primary">Voltar ao Início</a>
            </div>
        </div>
    </div>
</div>
@endsection