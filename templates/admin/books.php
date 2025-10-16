<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Админ панель</title>
    <link rel="stylesheet" href="../../styles/style.css">
</head>
<body>
<a href="/auth/logout" id="logout">Выйти</a>
<h1>Все книги:</h1>
<hr>
<a href="/admin/create" id="create">Добавить книгу +</a>
<a href="/admin/authors" class="authors">Авторы книг</a>
<?php foreach ($books as $book): ?>
    <h2><?=$book['name']?></h2>
    <?php if (isset($bookAuthors[$book['id']])): ?>
        <?php foreach ($bookAuthors[$book['id']] as $author): ?>
            <p><?=$author['name']?></p>
        <?php endforeach; ?>
    <?php endif; ?>

    <form action="/admin/<?=$book['id']?>/addAuthor" method="post">
        <label for="author">Выберите автора:</label>
        <select name="author_id" id="author">
            <?php foreach ($authors as $author): ?>
                <option value="<?=$author['id']?>"><?=$author['name']?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" id="create">Добавить автора +</button>
    </form>

    <a href="/admin/<?= $book['id'] ?>" id="update">Редактировать</a>
    <a href="/admin/<?= $book['id'] ?>/delete" id="delete">Удалить</a>
    <a href="/admin/<?= $book['id'] ?>/history" id="history">История по книге</a>
<?php endforeach; ?>
</body>
</html>