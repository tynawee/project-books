<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Редактирование книги</title>
    <link rel="stylesheet" href="../../styles/style.css">
</head>
<body>
<a href="/admin/books" id="back">Назад</a>
<form action="/admin/<?=$book['id']?>/update" method="post">
    <h1>Изменить книгу</h1>
    <input type="text" name="name" value="<?=$book['name']?>"><br>
    <input type="number" name="available" value="<?=$book['available']?>" minlength="0" maxlength="1"><br>
    <input type="submit" value="Редактировать" id="update">
</form>
</body>
</html>