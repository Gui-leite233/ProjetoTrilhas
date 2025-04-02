@extends('Layouts.main', ['titulo' => "Resumos"])

@section('titulo') Resumos @endsection

@section('conteudo')
    <div class="row">
        <div class="col">
            <x-datalist
                :title="'Resumos'"
                :header="['TÍTULO', 'AUTORES', 'AÇÕES']" 
                :data="$data"
                :hide="[true, true, false]" 
                :info="['titulo', 'users']"
                :crud="'resumo'"
                :create="Auth::user()->role_id == 1 || Auth::user()->role_id == 3"
            />
        </div>
    </div>
@endsection
