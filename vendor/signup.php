<?php

    session_start();
    require_once 'connect.php';

    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $registered_at = gmdate("Y-m-d\TH:i:s", time());

    $check_login = mysqli_query($connect, 'SELECT `login`FROM `Users` WHERE `login` = "'.$login.'"');
    $check_email = mysqli_query($connect, 'SELECT `email`FROM `Users` WHERE `email` = "'.$email.'"');
    $login_row = mysqli_fetch_assoc($check_login);
    $email_row = mysqli_fetch_assoc($check_email);


    if($login == $login_row['login']){
        $_SESSION['message'] = 'Логин уже существует';
        header('Location: ../register.php');
    }
    if($email == $email_row['email']){
        $_SESSION['message'] = 'Email уже существует';
        header('Location: ../register.php');
    }

    if (filter_var($email, FILTER_VALIDATE_EMAIL)){
    if ($password === $password_confirm) {

        $path = 'uploads/' . time() . $_FILES['avatar']['name'];
        if (!move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $path)) {
            $_SESSION['message'] = 'Ошибка при загрузке сообщения';
            header('Location: ../register.php');
        }

        $password = md5($password);

        mysqli_query($connect, "INSERT INTO `Users`(`id`, `url_pict`, `login`, `email`, `password`, `registered_at`) VALUES (NULL, '$path', '$login', '$email', '$password', '$registered_at')");

        $_SESSION['message'] = $login_row['login'];
        header('Location: ../index.php');


        } else {
            $_SESSION['message'] = 'Пароли не совпадают';
            header('Location: ../register.php');
        }
    }else{
        $_SESSION['message'] = 'Неправильный email';
        header('Location: ../register.php');
    }
?>
