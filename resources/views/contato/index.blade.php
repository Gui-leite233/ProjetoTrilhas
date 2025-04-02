@extends('layouts.site')

@section('title', 'Contato - Projeto Trilhas')

@section('content')
<div class="container">
    <section class="intro-section">
        <h2>Entre em Contato</h2>
        <p>Estamos aqui para ajudar. Entre em contato conosco!</p>
    </section>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="contact-info">
        <div class="contact-item">
            <i class="fas fa-map-marker-alt"></i>
            <h3>Endereço</h3>
            <p>Av. Antônio Carlos Rodrigues, 453</p>
            <p>Porto Seguro, Paranaguá - PR</p>
            <p>CEP: 83215-750</p>
        </div>

        <div class="contact-item">
            <i class="fas fa-phone"></i>
            <h3>Telefone</h3>
            <p>(41) 3300-0134</p>
        </div>

        <div class="contact-item">
            <i class="fas fa-envelope"></i>
            <h3>E-mail</h3>
            <p>sepae.paranagua@ifpr.edu.br</p>
        </div>
    </div>

    <div class="contact-form-container">
        <form id="contactForm" class="contact-form" action="{{ route('contact.send') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="subject">Assunto</label>
                <input type="text" id="subject" name="subject" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="message">Mensagem</label>
                <textarea id="message" name="message" class="form-control" rows="5" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Enviar Mensagem</button>
        </form>
    </div>
</div>
@endsection

@section('additional_css')
<style>
    .contact-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        padding: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .contact-item {
        text-align: center;
        padding: 2rem;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .contact-item i {
        font-size: 2rem;
        color: #50a050;
        margin-bottom: 1rem;
    }

    .contact-item h3 {
        color: #333;
        margin-bottom: 1rem;
    }

    .contact-item p {
        color: #666;
        line-height: 1.5;
    }

    .intro-section {
        text-align: center;
        padding: 3rem 0;
    }

    .intro-section h2 {
        color: #50a050;
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    .intro-section p {
        color: #666;
        font-size: 1.1rem;
    }

    .contact-form-container {
        max-width: 800px;
        margin: 2rem auto;
        padding: 2rem;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .contact-form {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .form-group label {
        color: #333;
        font-weight: 500;
    }

    .form-control {
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1rem;
    }

    .form-control:focus {
        outline: none;
        border-color: #50a050;
        box-shadow: 0 0 0 2px rgba(80, 160, 80, 0.2);
    }

    .btn-primary {
        background: #50a050;
        color: white;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 4px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background: #408040;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }

    .alert {
        padding: 1rem;
        margin-bottom: 1rem;
        border-radius: 4px;
        text-align: center;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
</style>
@endsection
