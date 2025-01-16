@extends('templates.main')

@section('title', 'Profile')

@section('conteudo')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-4">
                    <i class="fas fa-user-circle me-2"></i>{{ __('Profile') }}
                </h2>

                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <i class="fas fa-user-edit me-2"></i>{{ __('Profile Information') }}
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <i class="fas fa-lock me-2"></i>{{ __('Security') }}
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <i class="fas fa-exclamation-triangle me-2 text-danger"></i>{{ __('Danger Zone') }}
                    </div>
                    <div class="card-body">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection