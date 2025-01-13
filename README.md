<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Projeto Trilhas

## 📋 Descrição

Este projeto foi uma iniciativa do projeto Trilhas, onde o objetivo é diminuir a evasão mostrando tudo que a instituição, no qual o Trilhas pertence, tem a oferecer. Desenvolvido por dois estudantes e programadores.

## 🚀 Funcionalidades

- Autenticação de usuários
- CRUD completo
- Validação de dados
- Interface responsiva
- Sistema de mensagens de feedback

## 💻 Tecnologias Utilizadas

- Laravel
- PHP
- MySQL
- HTML/CSS
- Bootstrap
- JavaScript
- Docker



## 🛠️ Instalação com Docker

1. **Clone o repositório**:
    
    git clone https://github.com/Gui-leite233/ProjetoTrilhas.git
    
2. **Configure o arquivo de ambiente**:  

    Renomeie `.env.docker.example` para `.env`.
    
3. **Inicie os containers**:  

    Caso esteja no Linux, execute no terminal: export PWD=$(pwd)
    Caso esteja no Windows, execute no terminal: $env:PWD = (Get-Location).Path
    Execute no terminal: docker-compose up -d 
    
4. **Verifique o container**:

    Verifique se o container está em execução com o comando no terminal(todas as plataformas): docker ps

    Certifique-se de que o container `projetotrilhas-laravel_app-1` está em execução no aplicativo Docker Desktop(Windows ou Mac).

5. **Acesse a aplicação**:  

    A aplicação estará disponível na porta `13500`. Abra o navegador e acesse:
    
    http://localhost:13500

## 🛠️ Instalação via Composer (XAMPP ou semelhantes)

1. **Clone o repositório**:

    git clone https://github.com/Gui-leite233/ProjetoTrilhas.git
    
2. **Configure o arquivo de ambiente**:  

    Renomeie `.env.example` para `.env`.
    
3. **Instale as dependências**:

    composer install
    
4. **Gere a chave da aplicação**:
    
    php artisan key:generate
    
5. **Execute as migrações do banco de dados**:
    
    php artisan migrate
    
6. **Crie o link para o armazenamento**:

    php artisan storage:link
    
7. **Inicie o servidor local**:

    php artisan serve
    
8. **Acesse a aplicação**:  

    Abra o navegador e acesse o endereço exibido no terminal.


!!! ATENÇÃO !!!
A aplicação não pode ser utilizada simultaneamente em ambas as formas de instalação.


## Sobre o Laravel

Laravel é um framework de aplicações web com uma sintaxe expressiva e elegante. Acreditamos que o desenvolvimento deve ser uma experiência agradável e criativa para ser verdadeiramente satisfatória. Laravel elimina as dores do desenvolvimento, simplificando tarefas comuns em muitos projetos web, como:

- [Motor de roteamento simples e rápido](https://laravel.com/docs/routing).
- [Container poderoso para injeção de dependências](https://laravel.com/docs/container).
- Suporte a múltiplos back-ends para [sessão](https://laravel.com/docs/session) e [armazenamento de cache](https://laravel.com/docs/cache).
- [ORM de banco de dados](https://laravel.com/docs/eloquent) expressivo e intuitivo.
- [Migrações de esquema](https://laravel.com/docs/migrations) independentes de banco de dados.
- [Processamento robusto de tarefas em background](https://laravel.com/docs/queues).
- [Transmissão de eventos em tempo real](https://laravel.com/docs/broadcasting).

Laravel é acessível, poderoso e fornece as ferramentas necessárias para grandes aplicações robustas.

## Aprendendo Laravel

Laravel tem a mais extensa e completa [documentação](https://laravel.com/docs) e biblioteca de tutoriais em vídeo entre todos os frameworks modernos para aplicações web, facilitando o aprendizado do framework.

Você também pode experimentar o [Laravel Bootcamp](https://bootcamp.laravel.com), onde será guiado na construção de uma aplicação Laravel moderna do zero.

Se você não gosta de ler, o [Laracasts](https://laracasts.com) pode ajudar. O Laracasts contém milhares de tutoriais em vídeo sobre uma variedade de tópicos, incluindo Laravel, PHP moderno, testes unitários e JavaScript. Melhore suas habilidades explorando nossa biblioteca de vídeos abrangente.

## Contribuindo
Os desenvolvedores são o Guilherme Leite que desenvolveu o backkend e a Isabelle Alves que desenvolveu o frontend. 
Ambos desenvolveram a documentação(Diagramas e prototipação) do projeto e o README.md.

