<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Добавление автора</title>
    <link rel="stylesheet" href="../../styles/style.css">
</head>
<body>
<a href="/admin/authors" id="back">Назад</a>
<form action="/admin/createAuthor" method="post">
    <h1>Добавить автора</h1>
    <input type="text" name="name" placeholder="name">
    <br>
    <input type="submit" id="create" value="Добавить +">
</form>
</body>
</html>