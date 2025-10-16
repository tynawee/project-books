<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>История книги</title>
    <link rel="stylesheet" href="../../styles/style.css">
</head>
<body>
<a href="/admin/books" id="back">Назад</a>
<h1>История:</h1>
<hr>
<table>
    <thead>
    <tr>
        <th>Выдал</th>
        <th>Книга</th>
        <th>Взял</th>
        <th>Дата выдачи</th>
        <th>Дата возврата</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($history as $hist): ?>
        <tr>
            <td><?=$hist['owner_id']?></td>
            <td><?=$hist['book_id']?></td>
            <td><?=$hist['user']?></td>
            <td><?=$hist['date_begin']?></td>
            <td><?=$hist['date_end']?></td>
            <td><a href="/admin/<?=$hist['id']?>/deleteHistory" id="delete">Удалить запись</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<a href="/admin/<?=$book_id?>/createHistory" id="create">Добавить запись в таблицу +</a>
<br>
</body>
</html>