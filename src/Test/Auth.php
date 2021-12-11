<?php

    namespace Test;

    class Auth {
        public $userId;
        public $name;

        public static function register ($name, $login, $age, $password, $repassword, $cityId): array {
            $error = false;
            $errors = [];

            /**
             * Проверить, а не занят ли логин
             */

            if (strlen($login) > 45) {
                $error = true;
                $errors[] = 'Логин не может быть больше 45 символов';
            }

            if ($age < 14) {
                $error = true;
                $errors[] = 'Вы должны быть старше 13';
            }

            if ($password != $repassword) {
                $error = true;
                $errors[] = 'Пароли не совпадают';
            }

            if ($error) {
                return [
                    'error'  => $error,
                    'errors' => $errors,
                ];
            }

            $password = md5($password);
            $config = require './config/config.php';
            $mysql = $config['mysql'];
            $query = "INSERT INTO users
                    (name, login, age, city_id, password)
                    VALUES('$name', '$login', '$age', '$cityId', '$password')";
            $mysql->query($query);

            if ($mysql->error) {
                $errors[] = $mysql->error;
                return [
                    'error'  => 1,
                    'errors' => $errors,
                ];
            }

            return [
                'error'  => $error,
                'errors' => $errors,
            ];

        }

        public static function Login ($login, $password): array {
            $password = md5($password);
            $config = require './config/config.php';
            $mysql = $config['mysql'];
            $query = "SELECT * FROM users WHERE login = :login and password = :password";
            $res = $mysql->prepare($query);
            $res->execute([
                ':login'    => $login,
                ':password' => $password,
            ]);
            if ($res->rowCount() == 1) {
                $user = $res->fetch();
                return [
                    'error'  => false,
                    'errors' => null,
                    'user'   => $user,
                ];
            }

            return [
                'error'  => true,
                'errors' => 'Вы ввели неверные данные',
            ];
        }
    }