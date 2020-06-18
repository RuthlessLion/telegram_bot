<?php
    session_start();
    if ($_SESSION['user']) {
        header('Location: profile.php');
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>регистрация</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

    <!-- Форма регистрации -->

    <form action="vendor/signup.php" method="post" enctype="multipart/form-data" class="form">
        <label>Логин</label>
        <input type="text" name="login" placeholder="Логин" class="input">
        <label>Почта</label>
        <input type="email" name="email" placeholder="e-mail" class="input">
        <label>Изображение профиля</label>
        <input type="file" name="avatar" class="input">
        <label>Пароль</label>
        <input type="password" name="password" placeholder="Пароль" class="input">
        <label>Подтверждение пароля</label>
        <input type="password" name="password_confirm" placeholder="Повторите пароль" class="input">
        <button type="submit">Зарегистрироваться</button>
        <p>
            У вас уже есть аккаунт? - <a href="/">авторизируйтесь</a>!
        </p>
        <?php
            if ($_SESSION['message']) {
                echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
            }
            unset($_SESSION['message']);
        ?>
    </form>

</body>
</html>