<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verificado - Trilhas</title>
    <link href="/styles/style.css" rel="stylesheet">
    <link href="/styles/fonts.css" rel="stylesheet">
    <link href="/styles/media.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    <main>
        <aside>
            <h2><span>Email verificado</span></h2>
            <h2>com sucesso!</h2>
            <div class="verification-content">
                <i class="fas fa-check-circle fa-4x" style="color: #4CAF50; margin-bottom: 20px;"></i>
                <p></p>
                    Sua conta foi ativada e você já pode acessar todos os recursos do Trilhas. 
                    Estamos felizes em ter você conosco!
                </p>
                <button onclick="window.location.href='{{ route('home') }}'">
                    Ir para a página inicial
                </button>
            </div>
        </aside>

        <article></article>
            <img src="{{ asset('img/Design sem nome (2).png') }}" alt="trilhas-img">
        </article>
    </main>

    <style>
        .verification-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-top: 2rem;
        }

        .verification-content p {
            margin: 1rem 0;
            font-size: 1.1rem;
            line-height: 1.6;
            color: #666;
            max-width: 80%;
        }

        button {
            width: 280px;
            height: 50px;
            background: #004AAD;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 2rem;
            font-size: 0.9rem;
        }

        button:hover {
            background: #003580;
            transform: scale(1.02);
            box-shadow: 0 2px 15px rgba(0, 74, 173, 0.2);
        }
    </style>
</body>
</html>
