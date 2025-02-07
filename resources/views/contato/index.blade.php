@extends('layouts.site')

@section('title', 'Contato - Projeto Trilhas')

@section('content')
<div class="container">
    <section class="intro-section">
        <h2>Entre em Contato</h2>
        <p>Estamos aqui para ajudar. Entre em contato conosco!</p>
    </section>

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
</style>
@endsection
