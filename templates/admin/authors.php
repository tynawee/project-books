<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Все авторы</title>
    <link rel="stylesheet" href="../../styles/style.css">
</head>
<body>
<a href="/admin/books" id="back">Назад</a>
<h1>Авторы:</h1>
<hr>
<a href="/admin/createAuthor" id="create">Добавить автора +</a>
<?php foreach ($authors as $author): ?>
    <h2><?=$author['name']?></h2>
    <a href="/admin/authors/<?= $author['id'] ?>" id="update">Редактировать</a>
    <a href="/admin/<?=$author['id']?>/deleteAuthor" id="delete">Удалить</a>
<?php endforeach; ?>
</body>
</html>