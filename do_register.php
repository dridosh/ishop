<?php
    session_start();
    include 'autoloader.php';

    use Test\Auth;

    $name = $_POST['name'];
    $login = $_POST['login'];
    $age = $_POST['age'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $cityId = $_POST['city_id'];

    $res = Auth::register($name, $login, $age, $password, $repassword, $cityId);
    $_SESSION['register'] = $res;

    if ($res['error']) {
        header('Location: register.php');
    } else {
        header('Location: login.php');
    }