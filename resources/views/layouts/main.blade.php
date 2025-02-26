<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Projeto Trilhas IFPR')</title>
    <link rel="stylesheet" href="{{asset('css/telaPrincipal.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script defer src="{{asset('js/navbar.js')}}"></script>
    @yield('head')
</head>

<body>
    <header>
        @include('components.navbar')
    </header>

    <main>
        <div class="container">
            <div class="action-button-container">
                @yield('action_button')
            </div>
            @yield('content')
        </div>
    </main>

    @include('components.footer')

    @yield('scripts')
</body>

</html>