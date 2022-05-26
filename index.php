<html lang="ru">

<head>
    <title>Аутентификация</title>
    <style>
        <?php include 'style.css'; ?>
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container bg-light text-dark rounded" id="form">
        <a href="#" class="navbar-brand">Авторизация</a>
        <hr>
        <form action="auth.php" method="post">
            <div class="form-group">
                <label for="exampleInputPassword1">E-mail:</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="E-mail">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Пароль:</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <br>
            <div style="text-align: center;">
                <button class="button rounded">Войти</button>
            </div>
        </form>
    </div>
</body>

</html>
