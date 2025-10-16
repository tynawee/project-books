<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Главная страница</title>
    <link rel="stylesheet" href="../../styles/style.css">
</head>
<body>
<a href="/login" id="login">Войти</a>
<h1>Все книги:</h1>
<?php foreach ($books as $book):?>
    <h2><?=$book['name']?></h2>
<?php endforeach; ?>
<br>
</body>
</html>