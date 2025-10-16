<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Добавить запись</title>
    <link rel="stylesheet" href="../../styles/style.css">
</head>
<body>
<a href="/admin/<?=$book_id?>/history" id="back">Назад</a>
<form action="/admin/createHistory" method="post">
    <h1>Создание записи в таблице</h1>
    <input type="hidden" name="book_id" value="<?=$book_id?>">
    <input type="text" name="user" placeholder="user">
    <br>
    <input type="date" name="date_end">
    <br>
    <input type="submit" value="Добавить +" id="create">
</form>
</body>
</html>