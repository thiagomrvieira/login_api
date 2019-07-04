<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirmação de E-mail</title>
</head>
<body>
    <h4>Seja bem vindo(a), {{$nome}}</h4>
    <p>Você acessou o sistema com o email: {{$email}}</p>
    <p>Data/Hora de acesso: {{$datahora}}</p>
    <p>Clique <a href="{{$link}}">aqui</a> para confirmar o seu e-mail</p>

</body>
</html>