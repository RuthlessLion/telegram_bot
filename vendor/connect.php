<?php

    $connect = new mysqli("codercat.ru", "rootya", "********", "telegram_mess");
    $connect->set_charset("utf8");

    if (!$connect) {
        die('Error connect to DataBase');
    }