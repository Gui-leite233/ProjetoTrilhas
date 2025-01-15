@extends('templates.main')

@section('title', 'Profile')

@section('conteudo')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-4">
                    {{ __('Profile') }}
                </h2>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
