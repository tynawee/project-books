<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
    <link rel="stylesheet" href="../../styles/style.css">
</head>
<body>
<form action="/auth/login" method="post">
    <h1>Вход</h1>
    <input type="text" name="login" placeholder="login">
    <br>
    <input type="text" name="password" placeholder="password">
    <br>
    <input type="submit" id="form-log" value="Войти">
    <p>У вас нет аккаунта? <a href="/auth/register" id="link-reg">Зарегистрироваться</a></p>
</form>
</body>
</html>
