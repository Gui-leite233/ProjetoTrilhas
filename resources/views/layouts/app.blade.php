<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Add these new stylesheets and scripts -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

        <!-- Scripts -->
        <style>
            .card {
                transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
                border-radius: 0.5rem;
            }
            .card:hover {
                transform: translateY(-5px);
                box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
            }
            .form-control, .btn {
                transition: all 0.2s ease-in-out;
                border-radius: 0.375rem;
            }
            .form-control:focus {
                box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
                border-color: #80bdff;
            }
            .btn:hover {
                transform: translateY(-1px);
            }
            .loading {
                opacity: 0;
                transition: opacity 0.3s;
            }
            .loading.active {
                opacity: 1;
            }
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .fade-in {
                animation: fadeIn 0.5s ease-out forwards;
            }
            .btn-dark {
                background-color: #212529;
                border-color: #212529;
            }
            .btn-dark:hover {
                background-color: #1a1e21;
                border-color: #1a1e21;
            }
            .card-header {
                border-top-left-radius: 0.5rem;
                border-top-right-radius: 0.5rem;
            }
        </style>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
