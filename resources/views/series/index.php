<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Controle  de Séries</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container">
<div class="jumbotron">
    <h1>Séries</h1>
</div>

    <a href="/series/criar" class="btn btn-dark mb-2">Adicionar</a>
<ul class="list-group">
    <?php foreach ($series as $serie)
    {
        echo "<li class='list-group-item'>$serie</li>";
    }?>
</div>
</ul>
</body>
</html>
