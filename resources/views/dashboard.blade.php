@extends('templates.main', ['menu' => "Dashboard", "submenu" => "Principal"])

@section('titulo') Dashboard @endsection

@section('conteudo')
<div class="container py-4">
    <div class="row g-4">
        <div class="col-md-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-header text-white bg-dark py-3">
                    <h5 class="card-title mb-0 text-center">Profile</h5>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <a href="{{ route('profile.edit') }}" class="text-decoration-none">
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor"
                                class="bi bi-person mb-3 text-dark transition-transform hover-scale"
                                viewBox="0 0 16 16">
                                <path
                                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                            </svg>
                            <p class="text-dark mb-0">Editar Perfil</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-header text-white bg-dark py-3">
                    <h5 class="card-title mb-0 text-center">Logout</h5>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-decoration-none btn btn-link">
                            <div class="text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor"
                                    class="bi bi-box-arrow-right mb-3 text-dark transition-transform hover-scale"
                                    viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M6.5 3.5a.5.5 0 0 1 .5.5v2h5a.5.5 0 0 1 0 1h-5v2a.5.5 0 0 1-1 0v-2H1.5a.5.5 0 0 1 0-1H5V4a.5.5 0 0 1 .5-.5zM10 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h6zm0 1H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z" />
                                </svg>
                                <p class="text-dark mb-0">Logout</p>
                            </div>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

