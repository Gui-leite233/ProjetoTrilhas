<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="{{ asset('css/site.css') }}" rel="stylesheet">
    @stack('styles')
    <title>ProjetoTrilhas</title>
    
    <style>
        :root {
            --primary-color: #212529;
            --secondary-color: #6c757d;
            --transition-speed: 0.3s;
        }

        /* Smooth scrolling and better font rendering */
        html {
            scroll-behavior: smooth;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Enhanced card animations */
        .card {
            transition: all var(--transition-speed) cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-shadow {
            transition: all var(--transition-speed) cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-shadow:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12) !important;
        }

        /* Better button styles */
        .btn {
            transition: all var(--transition-speed) ease;
            position: relative;
            overflow: hidden;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        /* Loading animation */
        .loading {
            opacity: 0;
            animation: fadeIn var(--transition-speed) ease forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Page transitions */
        .page-enter {
            opacity: 0;
        }

        .page-enter-active {
            opacity: 1;
            transition: opacity var(--transition-speed) ease;
        }

        /* Improved scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--secondary-color);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-color);
        }

        #pdfViewerContainer {
            background-color: #525659;
        }
        #pdfViewer {
            display: block;
            margin: 0 auto;
            background-color: white;
        }
        .modal-fullscreen-lg-down {
            max-width: none;
            max-height: none;
        }
        @media (max-width: 992px) {
            .modal-fullscreen-lg-down {
                width: 100vw;
                height: 100vh;
                margin: 0;
            }
        }
        .navbar {
            padding: 0.8rem 1rem;
            box-shadow: 0 2px 10px rgba(0,0,0,.1);
            transition: all 0.3s ease;
            position: relative;
            z-index: 1030;
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 600;
            color: #fff !important;
            transition: transform 0.2s ease;
        }
        .navbar-brand:hover {
            transform: scale(1.05);
        }
        .nav-link {
            padding: 0.5rem 1rem;
            margin: 0 0.2rem;
            border-radius: 6px;
            transition: all 0.2s ease;
        }
        .nav-link:hover {
            background: rgba(255,255,255,0.1);
            transform: translateY(-1px);
        }
        .dropdown-menu {
            margin-top: 0.5rem !important;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,.15);
            animation: dropdownFade 0.2s ease;
            padding: 0.8rem;
            z-index: 1031;
        }
        @keyframes dropdownFade {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .dropdown-item {
            border-radius: 8px;
            padding: 0.8rem 1rem;
            margin-bottom: 0.2rem;
            transition: all 0.2s ease;
            position: relative;
        }
        .dropdown-item:hover {
            background-color: rgba(0,0,0,.04);
            transform: translateX(5px);
        }
        .dropdown-item svg {
            transition: transform 0.2s ease;
        }
        .dropdown-item:hover svg {
            transform: scale(1.1) rotate(-5deg);
        }
        .nav-link.active {
            background: rgba(255,255,255,0.15);
            font-weight: 500;
        }
        @media (max-width: 992px) {
            .navbar-collapse {
                padding: 1rem 0;
            }
            .navbar-nav.mx-auto {
                margin: 1rem 0 !important;
            }
            .dropdown-menu {
                margin-top: 0 !important;
                background: rgba(0,0,0,.05);
                box-shadow: none;
            }
        }
        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
        }
        .dropdown-divider {
            margin: 0.5rem 0;
            opacity: 0.1;
        }
        .dropdown-item button:hover {
            background: rgba(220,53,69,.1);
        }

        /* Ensure dropdowns don't go off-screen */
        .navbar-nav.ms-auto .dropdown-menu {
            right: 0;
            left: auto !important;
            transform: none !important;
        }

        /* Center admin dropdown properly */
        .navbar .position-absolute.start-50 {
            position: static !important;
            transform: none !important;
        }

        /* Center the admin nav item */
        .navbar-nav.mx-auto {
            display: flex;
            justify-content: center;
            width: 100%;
            position: relative;
        }

        /* Center the admin dropdown */
        .navbar .position-absolute.start-50 .dropdown-menu {
            left: 50% !important;
            right: auto !important;
            transform: translateX(-50%) !important;
            position: absolute;
        }

        /* Ensure dropdown stays visible */
        .navbar .position-absolute.start-50 .nav-item.dropdown {
            position: static;
        }

        /* Mobile adjustments */
        @media (max-width: 992px) {
            .navbar-nav.mx-auto {
                justify-content: flex-start;
            }
            
            .navbar .position-absolute.start-50 .dropdown-menu {
                left: 0 !important;
                transform: none !important;
                width: 100%;
                position: relative;
            }
        }

        /* Center admin menu and its contents */
        .navbar-nav.mx-auto {
            display: flex;
            justify-content: center;
            width: 100%;
            margin: 0 auto;
        }

        /* Center the admin nav item and its contents */
        .navbar .position-absolute.start-50 {
            position: static !important;
            left: auto !important;
            transform: none !important;
            display: flex;
            justify-content: center;
            width: 100%;
        }

        /* Center the dropdown trigger content */
        .navbar .position-absolute.start-50 .nav-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            padding: 0.5rem 1.2rem;
        }

        /* Ensure dropdown menu is centered */
        .navbar .position-absolute.start-50 .dropdown-menu {
            left: 50% !important;
            transform: translateX(-50%) !important;
            min-width: 220px;
        }

        @media (max-width: 992px) {
            .navbar .position-absolute.start-50,
            .navbar .position-absolute.start-50 .nav-link {
                width: 100%;
                justify-content: flex-start;
            }

            .navbar .position-absolute.start-50 .dropdown-menu {
                left: 0 !important;
                transform: none !important;
                width: 100%;
                position: relative;
            }
        }

        /* Reset and clean up existing centering styles */
        .navbar .position-absolute.start-50,
        .navbar-nav.mx-auto {
            position: static !important;
            transform: none !important;
            left: auto !important;
        }

        /* New centering approach */
        .navbar .navbar-collapse {
            display: flex;
            justify-content: space-between;
        }

        .admin-nav-container {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
        }

        .admin-nav-link {
            display: flex !important;
            align-items: center;
            white-space: nowrap;
            padding: 0.5rem 1rem !important;
        }

        @media (max-width: 992px) {
            .admin-nav-container {
                position: static;
                transform: none;
                width: 100%;
                margin: 1rem 0;
            }
        }

        /* Enhanced Navbar Styles */
        .navbar {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            background-color: rgba(33, 37, 41, 0.95) !important;
            transition: all 0.3s ease;
        }

        /* Improved dropdown animations */
        .dropdown-menu {
            animation: dropdownFade 0.25s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            transform-origin: top;
        }

        @keyframes dropdownFade {
            from {
                opacity: 0;
                transform: translateY(-20px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Enhanced hover effects */
        .nav-link, .dropdown-item {
            position: relative;
            transition: all 0.2s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .nav-link:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px; /* Updated from 0 to -2px */
            left: 50%;
            background-color: #fff;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        /* Special handling for user dropdown */
        .navbar-nav.ms-auto .nav-link:after {
            bottom: -4px; /* Adjusted for user dropdown specifically */
            height: 2px;
            background-color: rgba(255,255,255,0.7);
        }

        .nav-link:hover:after {
            width: 80%;
        }

        /* Active state enhancement */
        .nav-link.active:after {
            width: 80%;
            background-color: #0d6efd;
        }

        /* Improved dropdown items */
        .dropdown-item {
            border-radius: 8px;
            margin: 4px 0;
        }

        .dropdown-item:hover {
            background: rgba(13, 110, 253, 0.1);
            transform: translateX(8px);
        }

        /* Icon animations */
        .dropdown-item svg {
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .dropdown-item:hover svg {
            transform: scale(1.2) rotate(-10deg);
            color: #0d6efd;
        }

        /* Navbar brand enhancement */
        .navbar-brand {
            position: relative;
            overflow: hidden;
        }

        .navbar-brand:after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(255,255,255,0.1);
            left: -100%;
            top: 0;
            transform: skewX(-45deg);
            transition: all 0.5s ease;
        }

        .navbar-brand:hover:after {
            left: 100%;
        }

        /* Mobile optimizations */
        @media (max-width: 992px) {
            .navbar {
                background-color: rgb(33, 37, 41) !important;
                backdrop-filter: none;
            }

            .dropdown-menu {
                background: rgba(255,255,255,0.05);
                border: 1px solid rgba(255,255,255,0.1);
            }

            .dropdown-item {
                color: rgba(255,255,255,0.8);
            }

            .dropdown-item:hover {
                color: #fff;
                background: rgba(255,255,255,0.1);
            }
        }

        /* Notification badge for future use */
        .nav-link .badge {
            position: absolute;
            top: 0;
            right: 0;
            transform: translate(25%, -25%);
            transition: all 0.2s ease;
        }

        /* Smooth shadow for dropdowns */
        .dropdown-menu {
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        }

        /* User dropdown specific styles */
        .navbar-nav.ms-auto .nav-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            position: relative;
            gap: 0.75rem;
            min-width: 100%;
        }

        .navbar-nav.ms-auto .nav-link svg {
            width: 24px;
            height: 24px;
            flex-shrink: 0;
            margin-left: 0.25rem;
        }

        /* Remove underline effect for user dropdown */
        .navbar-nav.ms-auto .nav-link:after {
            display: none;
        }

        /* Container for icon and text */
        .navbar-nav.ms-auto .nav-link > * {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 1;
        }

        /* Override Bootstrap margins */
        .navbar-nav.ms-auto .nav-link .me-2 {
            margin: 0 !important;
        }

        /* Enhanced Admin Nav Styles */
        .admin-nav-link {
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex !important;
            align-items: center;
            justify-content: center;
            padding: 0 !important;
            transition: all 0.3s ease;
        }

        .admin-nav-link:hover {
            background: rgba(255,255,255,0.2);
            transform: rotate(45deg);
        }

        .admin-nav-link:hover svg {
            transform: rotate(-45deg);
        }

        .admin-nav-link::after {
            display: none !important;
        }

        .admin-nav-container .dropdown-menu {
            margin-top: 0.5rem;
            border-radius: 12px;
            min-width: 220px;
            padding: 0.5rem;
            border: 1px solid rgba(255,255,255,0.1);
            background: rgba(33, 37, 41, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .admin-nav-container .dropdown-item {
            color: rgba(255,255,255,0.8);
            border-radius: 8px;
            padding: 0.7rem 1rem;
            margin: 2px 0;
            transition: all 0.2s ease;
        }

        .admin-nav-container .dropdown-item:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            transform: translateX(5px);
        }

        .admin-nav-container .dropdown-item svg {
            transition: all 0.3s ease;
        }

        .admin-nav-container .dropdown-item:hover svg {
            transform: scale(1.2);
            color: #0d6efd;
        }

        @media (max-width: 992px) {
            .admin-nav-link {
                width: 36px;
                height: 36px;
            }
            
            .admin-nav-container .dropdown-menu {
                background: rgba(33, 37, 41, 0.98);
                border: none;
            }
        }

        /* Enhanced User Dropdown Styles */
        .navbar-nav.ms-auto .nav-item.dropdown > .nav-link {
            background: rgba(255,255,255,0.1);
            border-radius: 25px;
            padding: 0.5rem 1.2rem !important;
            transition: all 0.3s ease;
        }

        .navbar-nav.ms-auto .nav-item.dropdown > .nav-link:hover {
            background: rgba(255,255,255,0.2);
            transform: translateY(-2px);
        }

        .navbar-nav.ms-auto .dropdown-menu {
            margin-top: 0.5rem;
            border-radius: 12px;
            min-width: 240px;
            padding: 0.8rem;
            border: 1px solid rgba(255,255,255,0.1);
            background: rgba(33, 37, 41, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .navbar-nav.ms-auto .dropdown-menu .px-3.py-2 {
            background: rgba(255,255,255,0.05);
            border-radius: 8px;
            margin-bottom: 0.5rem;
        }

        .navbar-nav.ms-auto .dropdown-menu .dropdown-item {
            color: rgba(255,255,255,0.8);
            border-radius: 8px;
            padding: 0.8rem 1rem;
            margin: 4px 0;
            transition: all 0.3s ease;
        }

        .navbar-nav.ms-auto .dropdown-menu .dropdown-item:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            transform: translateX(5px);
        }

        .navbar-nav.ms-auto .dropdown-menu .dropdown-item svg {
            transition: all 0.3s ease;
        }

        .navbar-nav.ms-auto .dropdown-menu .dropdown-item:hover svg {
            transform: scale(1.2) rotate(-5deg);
            color: #0d6efd;
        }

        .navbar-nav.ms-auto .dropdown-menu .text-danger:hover svg {
            color: #dc3545;
        }

        .navbar-nav.ms-auto .dropdown-menu .dropdown-divider {
            border-color: rgba(255,255,255,0.1);
            margin: 0.5rem 0;
        }

        .navbar-nav.ms-auto .dropdown-menu button.dropdown-item {
            width: 100%;
            text-align: left;
            background: none;
            border: none;
        }

        @media (max-width: 992px) {
            .navbar-nav.ms-auto .nav-item.dropdown > .nav-link {
                border-radius: 8px;
            }
            
            .navbar-nav.ms-auto .dropdown-menu {
                background: rgba(33, 37, 41, 0.98);
                border: none;
            }
        }

        /* Remove existing conflicting styles */
        .navbar-nav.ms-auto .nav-link:after {
            display: none;
        }

        .navbar-nav.ms-auto .nav-link > * {
            gap: 0.5rem;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="navbar-brand" href="{{ route('index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-mortarboard-fill me-2" viewBox="0 0 16 16">
                    <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5Z"/>
                    <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Z"/>
                </svg>
                ProjetoTrilhas
            </a>
            
            <!-- Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Content -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @auth {{-- Show gear dropdown for all authenticated users --}}
                    <div class="admin-nav-container">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle admin-nav-link p-2" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                                        <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                                    </svg>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    {{-- Show Resumos for all users --}}
                                    <li>
                                        <a href="{{route('admin.resumo.index')}}" class="dropdown-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-text me-2" viewBox="0 0 16 16">
                                                <path d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                                                <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                                            </svg>
                                            <span>Resumos</span>
                                        </a>
                                    </li>

                                    {{-- Show TCC for Admin and Coordenador --}}
                                    @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    <li>
                                        <a href="{{route('admin.tcc.index')}}" class="dropdown-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-text me-2" viewBox="0 0 16 16">
                                                <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z"/>
                                                <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                                            </svg>
                                            <span>TCC's</span>
                                        </a>
                                    </li>

                                    {{-- Show Admin items only for role_id = 1 --}}
                                    @if(Auth::user()->role_id == 1)
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <a href="{{route('admin.curso.index')}}" class="dropdown-item">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book me-2" viewBox="0 0 16 16">
                                                    <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                                                </svg>
                                                <span>Cursos</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('admin.prova.index')}}" class="dropdown-item">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-check me-2" viewBox="0 0 16 16">
                                                    <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                                    <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                                                </svg>
                                                <span>Provas</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('admin.bolsa.index')}}" class="dropdown-item">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet2 me-2" viewBox="0 0 16 16">
                                                    <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"/>
                                                </svg>
                                                <span>Bolsas</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('admin.projeto.index')}}" class="dropdown-item">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-kanban me-2" viewBox="0 0 16 16">
                                                    <path d="M13.5 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-11a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h11zm-11-1a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2h-11z"/>
                                                    <path d="M6.5 3a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3zm-4 0a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3zm8 0a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3z"/>
                                                </svg>
                                                <span>Projetos</span>
                                            </a>
                                        </li>
                                    @endif
                                    @endif
                                </ul>
                            </li>
                        </ul>
                    </div>
                @endauth

                <!-- Right aligned user menu -->
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-circle me-2" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                </svg>
                                
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end shadow border-0">
                                <li class="px-3 py-2 text-center text-muted">
                                    <small>Acesse sua conta</small>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('login') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-box-arrow-in-right me-2" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                                            <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                        </svg>
                                        <div>
                                            <span class="fw-500">Entrar</span>
                                            <small class="d-block text-muted">Acesse sua conta</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('register') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-plus me-2" viewBox="0 0 16 16">
                                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                                        </svg>
                                        <div>
                                            <span class="fw-500">Criar Conta</span>
                                            <small class="d-block text-muted">Registre-se gratuitamente</small>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-circle me-2" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                </svg>
                                <span>{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end shadow border-0">
                                <li class="px-3 py-2 text-center">
                                    <small class="text-muted">Logado como</small>
                                    <div class="fw-500">{{ Auth::user()->email }}</div>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('password.request') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-key me-2" viewBox="0 0 16 16">
                                            <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
                                            <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                        </svg>
                                        <div>
                                            <span class="fw-500">Alterar Senha</span>
                                            <small class="d-block text-muted">Atualize sua senha</small>
                                        </div>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item d-flex align-items-center text-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-box-arrow-right me-2" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                                                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                            </svg>
                                            <div>
                                                <span class="fw-500">Sair</span>
                                                <small class="d-block text-muted">Encerrar sessão</small>
                                            </div>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('header')
        @yield('conteudo')
    </div>

    <div class="modal fade" tabindex="-1" id="removeModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Operação de Remoção</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="removeModal" onclick="closeRemoveModal()"
                        aria-label="Close"></button>
                </div>
                <input type="hidden" id="id_remove">
                <div class="modal-body text-secondary">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-block align-content-center"
                        onclick="closeRemoveModal()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                            <path
                                d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z" />
                        </svg>
                        &nbsp; Não
                    </button>
                    <button type="button" class="btn btn-danger" onclick="remove()">
                        Sim &nbsp;
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" defer></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.4.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js" defer></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
    </script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <script type="text/javascript">
        function showRemoveModal(id, nome) {
            $('#id_remove').val(id);
            $('#removeModal').modal().show();
            $('.modal-body').html("Deseja remover o curso '" + nome + "'?");
        }

        function remove() {
            let id = $('#id_remove').val();
            let form = "form_" + id;
            document.getElementById(form).submit();
        }

        function closeRemoveModal() {
            $('#removeModal').modal('hide');
        }

        // Smooth navbar background change on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.background = 'rgb(33, 37, 41)';
                navbar.style.boxShadow = '0 2px 10px rgba(0,0,0,0.3)';
            } else {
                navbar.style.background = 'rgba(33, 37, 41, 0.95)';
                navbar.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
            }
        });

        // Add ripple effect to buttons
        document.querySelectorAll('.dropdown-item').forEach(item => {
            item.addEventListener('click', function(e) {
                let ripple = document.createElement('div');
                ripple.className = 'ripple';
                this.appendChild(ripple);

                let rect = this.getBoundingClientRect();
                let x = e.clientX - rect.left;
                let y = e.clientY - rect.top;

                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';

                setTimeout(() => ripple.remove(), 600);
            });
        });

        // Add loading animation script
        document.addEventListener('DOMContentLoaded', function() {
            document.body.classList.add('loading');
        });

        window.addEventListener('load', function() {
            document.body.classList.remove('loading');
        });
    </script>
</body>

</html>