<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Редактирование автора</title>
    <link rel="stylesheet" href="../../styles/style.css">
</head>
<body>
<a href="/admin/authors" id="back">Назад</a>
<form action="/admin/authors/<?=$author['id']?>/updateAuthor" method="post">
    <h1>Изменить автора</h1>
    <input type="text" name="name" value="<?=$author['name']?>"><br>
    <input type="submit" value="Редактировать" id="update">
</form>
</body>
</html>