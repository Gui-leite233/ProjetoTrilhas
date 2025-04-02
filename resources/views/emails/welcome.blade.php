<!DOCTYPE html>
<html>
<head>
    <title>Bem-vindo ao {{ config('app.name') }}</title>
</head>
<body>
    <h1>Bem-vindo, {{ $user->nome }}!</h1>
    <p>Sua conta foi criada com sucesso.</p>
    <p>Obrigado por se registrar em nossa plataforma!</p>
</body>
</html>
